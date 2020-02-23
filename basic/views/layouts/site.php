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
<!--    TODO: добавить fav icon-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Главная',
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
            ['label' => 'Республика Тыва',
            'url' => ['site/index','region' => 2]],
            ]
        ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            '<li>'
            . Html::beginForm(['/site/index'], 'get', ['class' => 'navbar-form navbar-left'])
            . Html::input('text', 'search', Yii::$app->request->get('search'), ['class' => 'form-control', 'placeholder' => 'Поиск'])
            . ' '
            . Html::submitButton(
                'Поиск',
                ['class' => 'btn']
            )
            . Html::endForm()
            . '</li>',
            !Yii::$app->user->isGuest ? (
                    ['label' => 'Режим редактирования', 'url' => ['/bird']]
                ) : '',
            Yii::$app->user->isGuest ? (
                    ['label' => 'Войти', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]
    );
    NavBar::end();
    ?>
    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => ['label' => 'Главная', 'url' => ['site/index']]
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
</body>
</html>
<?php $this->endPage() ?>
