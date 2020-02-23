<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\CoordsImages;
use app\models\Bird;
use app\models\User;
use yii\web\UploadedFile;
use yii\web\HttpException;

class AppController extends Controller
{

    public function behaviors() { 
        return 
        [ 
        'access' => [ 'class' => AccessControl::className(), 
        'rules' => 
        [ 
        
        [ 'allow' => true, 
         'actions' => ['get-bird','auth','coords-from-app'], 
         'roles' => ['?'], 
        ],

        [ 'actions' => ['get-bird','auth','coords-from-app'], 
        'allow' => true, 
        'roles' => ['@'], 
        ], 
                ], 
        ], 
        ]; 
    }
    /*  
        API для приложений. Список птиц.
    */

    public function actionGetBird(){
        // if(Yii::$app->request->post()){
        //     $str = Yii::$app->request->post('str');
        //     if(mb_strlen($str) < 3 || mb_strlen($str) > 256){
        //         return;
        //     }
        //     $query = Bird::find()->where(['like','bird_name',$str])->all();
        //     $arr = array();
        //     foreach ($query as $value) {
        //         $arr[]=$value->bird_name;
        //     }
        //     if(count($arr) > 0){
        //         return json_encode($arr);
        //     }
        // }
        // return;
        $query = Bird::find()->all();
        $arr = array();
        foreach ($query as $value) {
            $arr['birds'][]=$value->bird_name;
        }
        return json_encode($arr);
    }
    /*
        Авторизация.
    */

    public function actionAuth(){
        if (Yii::$app->request->isPost) {
            $user = User::find()->where(['username' => Yii::$app->request->post('username'),'password' => Yii::$app->request->post('password')])->one();
            if($user)
                return json_encode($user->id);
            else
                return json_encode(false);
        }
        return json_encode(false);
    }
    /*
        Получение JSON.
    */
    public function actionCoordsFromApp(){
        $model = new CoordsImages();
        if (Yii::$app->request->isPost /*&& $model->load(Yii::$app->request->post())*/) {
            if(Yii::$app->request->post('user_id') !== null && Yii::$app->request->post('x') !== null && Yii::$app->request->post('y') !== null && Yii::$app->request->post('bird_name') !== null ){
                $model->user_id = Yii::$app->request->post('user_id');
                $model->x = Yii::$app->request->post('x');
                $model->y = Yii::$app->request->post('y');
                $model->bird_name = Yii::$app->request->post('bird_name');
                $model->text = Yii::$app->request->post('description') !== null ? Yii::$app->request->post('description') : '';
                if(isset($_FILES)){
                    $images = [];
                    foreach($_FILES as $key => $value){
                        $images[] = UploadedFile::getInstanceByName($key);
                    }
                    $model->image = $images;
                }
                else
                    $model->image = null;
                if($model->create()){
                    $model->save();
                    return json_encode(true);
                }
                else
                    throw new HttpException(500);
            }
            else
                throw new HttpException(500);
        }
        throw new HttpException(500);
    }

    public function beforeAction($action) {
        if($action->id == 'auth' || $action->id == 'coords-from-app'){
            $this->enableCsrfValidation = false; 
        }
        return parent::beforeAction($action);
    }
}
?>