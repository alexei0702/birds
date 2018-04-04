    <?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/grids-responsive-min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/bttn.min.css">
    <link rel="stylesheet" href="css/btnToTop.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="fa fa-twitter" aria-hidden="true"></i> Птички',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'О проекте',
            'url' => ['site/about-project']],
            ['label' => 'О нас',
            'url' => ['site/about-us']],
            ]
        ]);
    if(!Yii::$app->user->isGuest)
    {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
        '<li>'
                . Html::beginForm(['/site/search'], 'post', ['class' => 'navbar-form navbar-left'])
                . Html::input('text', 'query', Yii::$app->request->post('query'), ['class' => 'form-control input1', 'placeholder' => 'Поиск'])
                . ' '
                . Html::submitButton(
                    'Поиск',
                    ['class' => 'btn']
                )
                . Html::endForm()
                . '</li>',
        ['label' => 'Режим редактирования', 'url' => ['/birds']],
        Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/birds/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/birds/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    }
    else 
    {
       echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
        '<li>'
                . Html::beginForm(['/site/search'], 'post', ['class' => 'navbar-form navbar-left'])
                . Html::input('text', 'query', Yii::$app->request->post('query'), ['class' => 'form-control','placeholder' => 'Поиск'])
                .' '
                . Html::submitButton(
                    'Поиск',
                    ['class' => 'btn']
                )
                . Html::endForm()
                . '</li>',
        Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/birds/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/birds/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]); 
    }
    NavBar::end();
    ?>
    
    <div class="container">
    <button class="bttn-material-circle bttn-lg bttn-primary" id = "toTop" ><span class="glyphicon glyphicon-chevron-up"></span></button>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right"> &copy; <?= date('Y') ?> <a href="http://www.bsu.ru/university/departments/faculties/bgf/">БГФ</a> <a href="http://imi.bsu.ru/">ИМИ</a></p>
    </div>
</footer>
<?php $this->endBody() ?>
<script src="js/menu.js" defer></script> 
<script src="js/btnToTop.js" defer></script>
<script src="js/sweetalert2.min.js" defer></script>
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3jZ1PHeLxCwShhwrvsC_rIvE3LfF-Es8&callback=initMap">
    </script>
</body>
</html>
<?php $this->endPage() ?>
