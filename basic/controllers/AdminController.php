<?php

namespace app\controllers;

use app\models\dataHelpers\DictionaryData;
use Yii;
use yii\base\Action;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Bird;
use app\models\Coords;
use app\models\PopulationBirdPlace;
use app\models\StatusBird;
use app\models\User;
use yii\web\Response;
use yii\web\UploadedFile;

class AdminController extends Controller
{

    public $layout = 'admin';

    private $modelsWithLatName = ['Squad', 'Family', 'Kind'];
    private $models = ['Status', 'Place'];

    private $errorSaveDateMsg = 'Произошла ошибка при сохранении данных, попробуйте ещё раз!';
    private $errorSaveFilesMsg = 'Произошла ошибка при сохранении фото, попробуйте ещё раз!';
    private $accessForbiddenMsg = 'У вас нет прав для выполнения данной операции!';
    private $errorDeleteMsg = 'Произошла ошибка при удалении, попробуйте ещё раз!';
    private $successDelete = 'Запись успешно удалена!';
    private $errorNotFoundBird = 'Данный вид не был найден!';
    private $successSave = 'Данные успешно сохранены!';

    /**
     * @return array
     */
    public function behaviors() {
        return
        [ 
            'access' =>
                [
                    'class' => AccessControl::className(),
                    'rules' =>
                        [
                            [
                                'actions' => [
                                    'index', 'create-dictionary', 'create-bird', 'dictionary-list', 'bird-details'
                                ],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                            [
                                'actions' => [
                                    'update-dictionary', 'delete-dictionary'
                                ],
                                'allow' => true,
                                'roles' => ['@'],
                                'matchCallback' => function ($rule, $action) {
                                        $user_status = Yii::$app->user->identity->status;

                                        if( $user_status === User::STATUS_ADMIN)
                                            return true;
                                        else {
                                            $user_id = Yii::$app->user->id;
                                            $modelName = Yii::$app->request->get('modelName');
                                            $fullName = '\app\models\\'.$modelName;
                                            $model = $fullName::findOne(Yii::$app->request->get('id'));
                                            if($model && $model->author === $user_id)
                                                return true;
                                            else
                                                return false;
                                        }
                                    }
                            ],
                            [
                                'actions' => [
                                    'update-bird','delete-bird'
                                ],
                                'allow' => true,
                                'roles' => ['@'],
                                'matchCallback' => function ($rule, $action) {
                                    $user_status = Yii::$app->user->identity->status;

                                    if( $user_status === User::STATUS_ADMIN)
                                        return true;
                                    else {
                                        $user_id = Yii::$app->user->id;
                                        $model = Bird::findOne(Yii::$app->request->get('id'));
                                        if($model && $model->author === $user_id)
                                            return true;
                                        else
                                            return false;
                                    }
                                }
                            ],
                            [
                                'actions' => ['generate-users'],
                                'allow' => true,
                                'roles' => ['@'],
                                'matchCallback' => function ($rule, $action) {
                                        $user_status = Yii::$app->user->identity->status;

                                        if($user_status === User::STATUS_ADMIN)
                                            return true;
                                        else
                                            return false;
                                    }
                            ],
                        ],
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->session->setFlash('error', $this->accessForbiddenMsg);
                        $this->goBack();
                    }
                ],
        ]; 
    }

    /**
     * @param Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        Yii::$app->getUser()->setReturnUrl(Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }

//    /**
//     * @return string
//     */
//    public function actionIndex()
//    {
//        $birds = Bird::find()->orderBy('name')->all();
//
//        return $this->render('index', ['birds' => $birds]);
//    }

//    /**
//     * @param null $modelName
//     * @return string|Response
//     */
//    public function actionDictionaryList($modelName = null)
//    {
//        if($modelName && in_array($modelName, array_merge($this->models, $this->modelsWithLatName)))
//        {
//            $model = '\app\models\\'.$modelName;
//            $list = $model::find()->orderBy('name')->all();
//            return $this->render('dictionary-list', [
//                'list' => $list,
//                'modelName' => $modelName,
//                'withLatName' => in_array($modelName, $this->modelsWithLatName),
//                'title' => $model::getTitle()
//            ]);
//        }
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * @param null $modelName
//     * @return string|Response
//     */
//    public function actionCreateDictionary($modelName = null)
//    {
//        if($modelName && in_array($modelName, array_merge($this->models, $this->modelsWithLatName)))
//        {
//            $fullModelName = '\app\models\\'.$modelName;
//            $model = new $fullModelName();
//            $model->author = Yii::$app->user->id;
//
//            if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()))
//            {
//                $model->save();
//                return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
//            }
//            return $this->render('create-dictionary', [
//                'model' => $model,
//                'withLatName' => in_array($modelName, $this->modelsWithLatName),
//                'title' => $model::getTitle()
//            ]);
//        }
//        else
//            return $this->redirect(['index']);
//    }
//
//    /**
//     * @param $id
//     * @param $modelName
//     * @return Response
//     */
//    public function actionDeleteDictionary($id, $modelName = null)
//    {
//        $model = $this->findDictionaryModel($id,$modelName);
//        if ($model)
//            $model->delete();
//        return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
//    }
//
//    /**
//     * @param $id
//     * @param null $modelName
//     * @return string|Response
//     */
//    public function actionUpdateDictionary($id, $modelName= null)
//    {
//        $model = $this->findDictionaryModel($id, $modelName);
//
//        if (!$model)
//            return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
//
//        if ($model->load(Yii::$app->request->post()))
//        {
//            $model->save();
//            return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
//        }
//
//        return $this->render('create-dictionary', [
//            'model' => $model,
//            'withLatName' => in_array($modelName, $this->modelsWithLatName),
//            'title' => $model::getTitle()
//        ]);
//    }
//
//    /**
//     * @param $id
//     * @param $modelName
//     * @return null |null
//     */
//    protected function findDictionaryModel($id, $modelName)
//    {
//        $fullName='\app\models\\'.$modelName;
//        if (
//            $modelName &&
//            in_array($modelName, array_merge($this->models, $this->modelsWithLatName)) &&
//            ($model = $fullName::findOne($id)) !== null
//        )
//            return $model;
//
//        return null;
//    }

//    /**
//     * @return string|Response
//     * @throws Exception
//     */
//    public function actionCreateBird()
//    {
//        $bird = new Bird();
//        $population_bird_place = new PopulationBirdPlace();
//        $status_bird = new StatusBird();
//
//        if (
//            Yii::$app->request->isPost &&
//            $status_bird->load(Yii::$app->request->post()) &&
//            $population_bird_place->load(Yii::$app->request->post()) &&
//            $bird->load(Yii::$app->request->post())
//        )
//        {
//            $bird->author = Yii::$app->user->id;
//            $bird->link = UploadedFile::getInstance($bird, 'link');
//            $bird->area = UploadedFile::getInstance($bird, 'area');
//
//            if ($bird->saveFiles()) {
//                $transaction = Yii::$app->db->beginTransaction();
//                try {
//                    $bird->saveOrThrow();
//
//                    $population_bird_place->bird_id = $bird->id;
//                    $population_bird_place->saveOrThrow();
//
//                    $status_bird->saveAll($bird->id);
//
//                    $path = Yii::$app->request->post('coords');
//                    if($path && !empty($path) && !empty($path[0])){
//                        Coords::saveCoords($path,$bird->id);
//                    }
//
//                    $transaction->commit();
//
//                    Yii::$app->session->setFlash('success', $this->successSave);
//
//                    return $this->redirect(['index']);
//                } catch(\Exception $e) {
//                    $transaction->rollBack();
//                    Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
//                }
//                catch(\Throwable $e) {
//                    $transaction->rollBack();
//                    Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
//                }
//            } else
//                Yii::$app->session->setFlash('error', $this->errorSaveFilesMsg);
//        }
//
//        return $this->render('bird-create', array_merge(
//            [
//                'bird' => $bird,
//                'population_bird_place' => $population_bird_place,
//                'status_bird' => $status_bird
//            ],
//            DictionaryData::getBirdDictionary()
//        ));
//    }
//
//    public function actionBirdDetails ($id = 0)
//    {
//        $bird = Bird::findOne($id);
//
//        if($bird)
//            return $this->render('bird-details', ['bird' => $bird]);
//
//        Yii::$app->session->setFlash('error', $this->errorNotFoundBird);
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * @param $id
//     * @return Response
//     * @throws Exception
//     */
//    public function actionDeleteBird($id)
//    {
//        $transaction = Yii::$app->db->beginTransaction();
//        try {
//            $bird = Bird::findOne($id);
//
//            if (!$bird)
//                throw new Exception('Model not found!');
//
//            PopulationBirdPlace::deleteAll(['bird_id' => $bird->id]);
//            StatusBird::deleteAll(['bird_id' => $bird->id]);
//            Coords::deleteAll(['bird_id' => $bird->id]);
//
//            $bird->deleteFiles();
//            $bird->deleteOrThrow();
//
//            $transaction->commit();
//
//            Yii::$app->session->setFlash('success', $this->successDelete);
//        } catch(\Exception $e) {
//            $transaction->rollBack();
//            Yii::$app->session->setFlash('error', $this->errorDeleteMsg);
//        }
//        catch(\Throwable $e) {
//            $transaction->rollBack();
//            Yii::$app->session->setFlash('error', $this->errorDeleteMsg);
//        }
//
//        return $this->redirect(['index']);
//    }
//
//    /**
//     * @param $id
//     * @return string|Response
//     * @throws Exception
//     */
//    public function actionUpdateBird ($id)
//    {
//        $bird = Bird::findOne($id);
//
//        if ($bird) {
//
//            $population_bird_place = PopulationBirdPlace::find()->where(['bird_id' => $id])->one();
//            $status_bird = new StatusBird();
//            $status_bird->status_id = array_map(function ($item) {
//                return $item->status_id;
//            }, StatusBird::find()->where(['bird_id' => $id])->all());
//            if (
//                $status_bird->load(Yii::$app->request->post()) &&
//                $population_bird_place->load(Yii::$app->request->post()) &&
//                $bird->load(Yii::$app->request->post())
//            ) {
//                $bird->link = UploadedFile::getInstance($bird, 'link');
//                $bird->area = UploadedFile::getInstance($bird, 'area');
//
//                if ($bird->saveFiles()) {
//                    $transaction = Yii::$app->db->beginTransaction();
//                    try {
//                        StatusBird::deleteAll(['bird_id' => $bird->id]);
//
//                        $population_bird_place->saveOrThrow();
//
//                        $status_bird->saveAll($bird->id);
//
//                        $path = Yii::$app->request->post('coords');
//
//                        if ($path && !empty($path) && !empty($path[0])) {
//                            Coords::deleteAll(['bird_id' => $bird->id]);
//                            Coords::saveCoords($path, $bird->id);
//                        }
//
//                        $bird->saveOrThrow();
//
//                        $transaction->commit();
//
//                        Yii::$app->session->setFlash('success', $this->successSave);
//
//                        return $this->redirect(['index']);
//                    } catch (\Exception $e) {
//                        $transaction->rollBack();
//                        Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
//                    } catch (\Throwable $e) {
//                        $transaction->rollBack();
//                        Yii::$app->session->setFlash('error', $this->errorSaveDateMsg);
//                    }
//                } else
//                    Yii::$app->session->setFlash('error', $this->errorSaveFilesMsg);
//            }
//
//            return $this->render('bird-create', array_merge(
//                [
//                    'bird' => $bird,
//                    'population_bird_place' => $population_bird_place,
//                    'status_bird' => $status_bird
//                ],
//                DictionaryData::getBirdDictionary()
//            ));
//        }
//
//        Yii::$app->session->setFlash('error', $this->errorNotFoundBird);
//        return $this->redirect(['index']);
//    }

    // TODO: сделать норм форму для генерации
//    public function actionGenerateUsers()
//    {
//        $id = User::find()->max('id');
//        $countUser = 17;
//        $id++;
//        $n = $id + $countUser;
//        for(; $id < $n; $id++){
//            $user = new User();
//            $user->username = 'user_'.$id;
//            $user->password = $this->GenPassword(7);
//            $user->status = 1;
//            $user->description = 'ПРАКТИКА';
//            $user->groups = 'БГФ';
//            $user->save();
//            echo $user->username.' '.$user->password.'<br>';
//        }
//    }
//
//    function GenPassword ($length=10) {
//        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
//        $length = intval($length);
//        $size=strlen($chars)-1;
//        $password = "";
//        while($length--) $password.=$chars[rand(0,$size)];
//        return $password;
//    }
}