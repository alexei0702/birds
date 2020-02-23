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
    public function actionIndex($sort = 'name', $region = 1, $search = '')
    {
        $query = Bird::find()->where(['region' => $region]);
        $search = trim($search);

        if ($search) {
            $query->AndWhere(['like','name', $search]);
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

    /**
     * @return string
     */
    public function actionAboutUs()
    {
         return $this->render('about-us');
    }

    /**
     * @return string
     */
    public function actionAboutProject()
    {
        return $this->render('about-project');
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewsDetails($id)
    {
        if (($bird = Bird::findOne($id)) !== null) {
            $coords = [];

            foreach ($bird->coords as $coord) {
                $coords[$coord['polygon_number']][] = ['lat' => $coord->lat, 'lng' => $coord->lng];
            }

            return $this->render('bird-view', [
                'bird' => $bird,
                'coords' => json_encode($coords)
            ]);
        }
        else
            throw new NotFoundHttpException('Вид не найден!');
    }
    // TODO: перенести в закрытую часть
    public function actionSignUp(){
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signUp()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
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
}