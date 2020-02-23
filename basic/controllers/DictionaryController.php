<?php

    namespace app\controllers;

    use Yii;
    use yii\web\Response;

    class DictionaryController extends AdminController
    {

        private $modelsWithLatName = ['Squad', 'Family', 'Kind'];
        private $models = ['Status', 'Place'];

        /**
         * @param null $modelName
         * @return string|Response
         */
        public function actionDictionaryList($modelName = null)
        {
            if($modelName && in_array($modelName, array_merge($this->models, $this->modelsWithLatName)))
            {
                $model = '\app\models\\'.$modelName;
                $list = $model::find()->orderBy('name')->all();
                return $this->render('/admin/dictionary/dictionary-list', [
                    'list' => $list,
                    'modelName' => $modelName,
                    'withLatName' => in_array($modelName, $this->modelsWithLatName),
                    'title' => $model::getTitle()
                ]);
            }
            return $this->redirect(['index']);
        }

        /**
         * @param null $modelName
         * @return string|Response
         */
        public function actionCreateDictionary($modelName = null)
        {
            if($modelName && in_array($modelName, array_merge($this->models, $this->modelsWithLatName)))
            {
                $fullModelName = '\app\models\\'.$modelName;
                $model = new $fullModelName();
                $model->author = Yii::$app->user->id;

                if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()))
                {
                    $model->save();
                    return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
                }
                return $this->render('/admin/dictionary/create-dictionary', [
                    'model' => $model,
                    'withLatName' => in_array($modelName, $this->modelsWithLatName),
                    'title' => $model::getTitle()
                ]);
            }
            else
                return $this->redirect(['index']);
        }

        /**
         * @param $id
         * @param $modelName
         * @return Response
         */
        public function actionDeleteDictionary($id, $modelName = null)
        {
            $model = $this->findDictionaryModel($id,$modelName);
            if ($model)
                $model->delete();
            return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
        }

        /**
         * @param $id
         * @param null $modelName
         * @return string|Response
         */
        public function actionUpdateDictionary($id, $modelName= null)
        {
            $model = $this->findDictionaryModel($id, $modelName);

            if (!$model)
                return $this->redirect(['dictionary-list', 'modelName' => $modelName]);

            if ($model->load(Yii::$app->request->post()))
            {
                $model->save();
                return $this->redirect(['dictionary-list', 'modelName' => $modelName]);
            }

            return $this->render('/admin/dictionary/create-dictionary', [
                'model' => $model,
                'withLatName' => in_array($modelName, $this->modelsWithLatName),
                'title' => $model::getTitle()
            ]);
        }

        /**
         * @param $id
         * @param $modelName
         * @return null |null
         */
        protected function findDictionaryModel($id, $modelName)
        {
            $fullName='\app\models\\'.$modelName;
            if (
                $modelName &&
                in_array($modelName, array_merge($this->models, $this->modelsWithLatName)) &&
                ($model = $fullName::findOne($id)) !== null
            )
                return $model;

            return null;
        }
    }