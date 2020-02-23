<?php

    namespace app\controllers;

    use app\models\dataHelpers\DictionaryData;
    use Yii;
    use yii\db\Exception;
    use app\models\Bird;
    use app\models\Coords;
    use app\models\PopulationBirdPlace;
    use app\models\StatusBird;
    use yii\web\Response;
    use yii\web\UploadedFile;

    class BirdController extends AdminController
    {
        private $errorSaveDateMsg = 'Произошла ошибка при сохранении данных, попробуйте ещё раз!';
        private $errorSaveFilesMsg = 'Произошла ошибка при сохранении фото, попробуйте ещё раз!';
        private $errorDeleteMsg = 'Произошла ошибка при удалении, попробуйте ещё раз!';
        private $successDelete = 'Запись успешно удалена!';
        private $errorNotFoundBird = 'Данный вид не был найден!';
        private $successSave = 'Данные успешно сохранены!';

        /**
         * @return string
         */
        public function actionIndex()
        {
            $birds = Bird::find()->orderBy('name')->all();

            return $this->render('/admin/bird/index', ['birds' => $birds]);
        }

        /**
         * @return string|Response
         * @throws Exception
         */
        public function actionCreateBird()
        {
            $bird = new Bird();
            $population_bird_place = new PopulationBirdPlace();
            $status_bird = new StatusBird();

            if (
                Yii::$app->request->isPost &&
                $status_bird->load(Yii::$app->request->post()) &&
                $population_bird_place->load(Yii::$app->request->post()) &&
                $bird->load(Yii::$app->request->post())
            )
            {
                $bird->author = Yii::$app->user->id;
                $bird->link = UploadedFile::getInstance($bird, 'link');
                $bird->area = UploadedFile::getInstance($bird, 'area');

                if ($bird->saveFiles()) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $bird->saveOrThrow();

                        $population_bird_place->bird_id = $bird->id;
                        $population_bird_place->saveOrThrow();

                        $status_bird->saveAll($bird->id);

                        $path = json_decode(Yii::$app->request->post('coords'));
                        if($path && !empty($path) && !empty($path[0])){
                            Coords::saveCoords($path,$bird->id);
                        }

                        $transaction->commit();

                        Yii::$app->session->setFlash('success', $this->successSave);

                        return $this->redirect(['index']);
                    } catch(\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
                    }
                    catch(\Throwable $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
                    }
                } else
                    Yii::$app->session->setFlash('error', $this->errorSaveFilesMsg);
            }

            return $this->render('/admin/bird/bird-create', array_merge(
                [
                    'bird' => $bird,
                    'population_bird_place' => $population_bird_place,
                    'status_bird' => $status_bird,
                    'coords' => json_encode([])
                ],
                DictionaryData::getBirdDictionary()
            ));
        }

        public function actionBirdDetails ($id = 0)
        {
            $bird = Bird::findOne($id);

            if($bird)
                return $this->render('/admin/bird/bird-details', ['bird' => $bird]);

            Yii::$app->session->setFlash('error', $this->errorNotFoundBird);
            return $this->redirect(['index']);
        }

        /**
         * @param $id
         * @return Response
         * @throws Exception
         */
        public function actionDeleteBird($id)
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $bird = Bird::findOne($id);

                if (!$bird)
                    throw new Exception('Model not found!');

                PopulationBirdPlace::deleteAll(['bird_id' => $bird->id]);
                StatusBird::deleteAll(['bird_id' => $bird->id]);
                Coords::deleteAll(['bird_id' => $bird->id]);

                $bird->deleteFiles();
                $bird->deleteOrThrow();

                $transaction->commit();

                Yii::$app->session->setFlash('success', $this->successDelete);
            } catch(\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $this->errorDeleteMsg);
            }
            catch(\Throwable $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $this->errorDeleteMsg);
            }

            return $this->redirect(['index']);
        }

        /**
         * @param $id
         * @return string|Response
         * @throws Exception
         */
        public function actionUpdateBird ($id)
        {
            $bird = Bird::findOne($id);

            if ($bird) {

                $population_bird_place = PopulationBirdPlace::find()->where(['bird_id' => $id])->one();
                $status_bird = new StatusBird();
                $status_bird->status_id = array_map(function ($item) {
                    return $item->status_id;
                }, StatusBird::find()->where(['bird_id' => $id])->all());
                if (
                    $status_bird->load(Yii::$app->request->post()) &&
                    $population_bird_place->load(Yii::$app->request->post()) &&
                    $bird->load(Yii::$app->request->post())
                ) {
                    $bird->link = UploadedFile::getInstance($bird, 'link');
                    $bird->area = UploadedFile::getInstance($bird, 'area');

                    if ($bird->saveFiles()) {
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                            StatusBird::deleteAll(['bird_id' => $bird->id]);

                            $population_bird_place->saveOrThrow();

                            $status_bird->saveAll($bird->id);

                            $path = json_decode(Yii::$app->request->post('coords'));
                            if ($path && !empty($path) && !empty($path[0])) {
                                Coords::deleteAll(['bird_id' => $bird->id]);
                                Coords::saveCoords($path, $bird->id);
                            }

                            $bird->saveOrThrow();

                            $transaction->commit();

                            Yii::$app->session->setFlash('success', $this->successSave);

                            return $this->redirect(['index']);
                        } catch (\Exception $e) {
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
                        } catch (\Throwable $e) {
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
                        }
                    } else
                        Yii::$app->session->setFlash('error', $this->errorSaveFilesMsg);
                }

                $coords = [];

                foreach ($bird->coords as $coord) {
                    $coords[$coord['polygon_number']][] = ['lat' => $coord->lat, 'lng' => $coord->lng];
                }

                return $this->render('/admin/bird/bird-create', array_merge(
                    [
                        'bird' => $bird,
                        'population_bird_place' => $population_bird_place,
                        'status_bird' => $status_bird,
                        'coords' => json_encode($coords)
                    ],
                    DictionaryData::getBirdDictionary()
                ));
            }

            Yii::$app->session->setFlash('error', $this->errorNotFoundBird);
            return $this->redirect(['index']);
        }
    }