<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Bird;
use yii\data\Pagination;
use app\models\Squad;
use app\models\Family;
use app\models\Kind;
use app\models\Status;
use app\models\Place;
use app\models\PopulationConnect;
use app\models\StatusConnect;
use app\models\Population;
use app\models\Coords;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($sort='bird_name')
    {
         $query = Bird::find();
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);
        $birds = $query->orderBy($sort)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $display = 1;
        return $this->render('index', [
            'birds' => $birds,
            'pagination' => $pagination,
            'display' => $display,
        ]);
    }
    /**********************
    ***********************
    *********************/
    public function actionAllBirds($sort='bird_name')
    {
        $query = Bird::find();
        $birds = $query->orderBy($sort)
            ->all();
        $display = 0;
        return $this->render('index', [
            'birds' => $birds,
            'display' => $display,
        ]);
    }

    public function actionBuklet(){
        return $this->render('buklet');
    }
    /**********************
    ***********************
    *********************/
    public function actionAboutUs()
    {
         return $this->render('aboutUs');
    }
    /**********************
    ***********************
    *********************/
    public function actionAboutProject()
    {
         return $this->render('aboutProject');
    }
    /*********************/
    public function actionViewsDetails($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $_SESSION['bird_id']=$id;
        if($id!=0)
        {
            $bird = Bird::find()->where(['bird_id' => $id])->one();
            if($bird)
            {
                $_SESSION['bird_id']=$id;
                $squad = Squad::find()->where(['squad_id' => $bird->squad_id])->one();
                if($squad===null){
                    $squad = new Squad();
                    $squad->squad_name = "Отряд";
                    $squad->squad_name_lat = "удален!";
                }
                $family = Family::find()->where(['family_id' => $bird->family_id])->one();
                if($family===null){
                    $family = new Family();
                    $family->family_name = "Семейство";
                    $family->family_name_lat = "удалено!";
                }
                $kind = Kind::find()->where(['kind_id' => $bird->kind_id])->one();
                if($kind===null){
                    $kind = new Kind();
                    $kind->kind_name = "Род";
                    $kind->kind_name_lat = "удален!";
                }
                $statusCon = StatusConnect::find()->where(['bird_id' => $bird->bird_id])->all();
                $popul_con = PopulationConnect::find()->where(['bird_id' => $bird->bird_id])->all();
                return $this->render('birdViews', ['bird' => $bird,'squad' => $squad, 'family' => $family, 'kind' => $kind, 'statusCon' => $statusCon, 'popul_con' => $popul_con]);
            }
            else
            {
                echo "Bird not found";
                die;
            }
        }
        else
        {
            echo "Missing argument";
            die;
        }
    }
    public function actionSearch()
    {
        if (!empty($_POST['query'])) 
        {
            $query = Yii::$app->request->post('query');  
            $query = trim($query); 
            //$query = htmlspecialchars($query);
            if (strlen($query) < 3) {
                throw new NotFoundHttpException('Слишком короткий поисковый запрос.');
             } 
             else 
            if (strlen($query) > 128) {
                    throw new NotFoundHttpException('Слишком длинный поисковый запрос.');
             } 
             else { 
                $q = Bird::find()->orWhere(['like','bird_name', $query])->orWhere(['like','bird_name_lat',$query]);
                $num = $q->count();
                if ($num>0) { 
                        $pagination = new Pagination([
                            'defaultPageSize' => 6,
                            'totalCount' => $num,
                            ]);
                        $birds = $q->orderBy('bird_name')
                            ->offset($pagination->offset)
                            ->limit($pagination->limit)
                            ->all();
                        return $this->render('search', [
                            'birds' => $birds,
                            'pagination' => $pagination,
                            'query' => $query,
                            'num' => $num,
                            ]);
                    }
                else
                {
                    throw new NotFoundHttpException('Нету.');
                }
               }
            }
            else
            {
                return $this->redirect(['index']);
            }
      }
      public function actionGetCoord(){
        $session = Yii::$app->session;
        $session->open();
        $id =isset($_SESSION['bird_id']) ? $_SESSION['bird_id'] : null;
        if($id){
            $coords = Coords::find()->where(['bird_id'=>$id])->all();
            //$data=array('lat' => $coords->lat, 'lng' => $coords->lng);
            $data = array();
            $lat=0;
            $lng=0;
            $i=0;
            foreach ($coords as $coord) {
                array_push($data,array('lat' => $coord->lat, 'lng' => $coord->lng));
                $lat+=$coord->lat;
                $lng+=$coord->lng;
                $i++;
            }
            $lat=$lat/$i;
            $lng=$lng/$i;
            $center=array('lat' => $lat, 'lng' => $lng);
            array_push($data, $center);
            echo json_encode($data);
        }
      }
}