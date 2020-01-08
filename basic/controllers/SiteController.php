<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Bird;
use yii\data\Pagination;
use app\models\Coords;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\models\SignupForm;

class SiteController extends Controller
{

    public $layout = 'site';

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
     * @param string $sort
     * @param int $region
     * @param string $search
     * @return string
     */
    public function actionIndex($sort = 'bird_name', $region = 1, $search = '')
    {
        $query = Bird::find()->where(['region' => $region]);
        $search = trim($search);

        if ($search) {
            $query->AndWhere(['like','bird_name', $search]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);
        $birds = $query->orderBy($sort)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'birds' => $birds,
            'pagination' => $pagination,
            'region' => $region,
        ]);
    }

    public function actionAboutUs()
    {
         return $this->render('aboutUs');
    }

    public function actionAboutProject()
    {
        return $this->render('aboutProject');
    }

    public function actionViewsDetails($id)
    {
        if(($bird = Bird::findOne($id)) !== null)
           return $this->render('birdViews', ['bird' => $bird]);
        else
            throw new NotFoundHttpException('Вид не найден!');
    }
    // TODO: перенести в закрытую часть
    public function actionSignup(){
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionGetCoord(){ // TODO: переделать или убрать вообще
        $session = Yii::$app->session;
        $session->open();
        $id =isset($_SESSION['bird_id']) ? $_SESSION['bird_id'] : null;
        if($id){
            $coords = Coords::find()->where(['bird_id'=>$id])->orderBy('polygon_number')->all();
            $data = array();
            if (!$coords) {
                return json_encode(false);
            }
            foreach ($coords as $coord) {
                $data[$coord['polygon_number']][] = ['lat' => $coord->lat, 'lng' => $coord->lng];
            }

            return json_encode($data);
        }
    }
}