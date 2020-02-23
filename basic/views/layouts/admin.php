<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\assets\AdminAsset;
    AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .help-block {
            color: red;
        }
    </style>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="page-top">
<?php $this->beginBody() ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=Url::toRoute(['site/index'])?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dove"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Главная</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item -->
            <li
                class="nav-item
                    <?=
                        Yii::$app->request->get('modelName') === null ?
                            'active'
                            : ''
                    ?>"
            >
                <a class="nav-link" href="<?=Url::toRoute(['bird/index'])?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Список видов</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Справочники
            </div>

            <!-- Nav Item -->
            <li
                class="nav-item
                    <?=
                        Yii::$app->request->get('modelName') === 'Squad' ?
                            'active'
                            : ''
                    ?>"
            >
                <a class="nav-link" href="<?=Url::toRoute(['dictionary/dictionary-list', 'modelName' => 'Squad'])?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Отряды</span></a>
            </li>

            <!-- Nav Item -->
            <li
                class="nav-item
                    <?=
                        Yii::$app->request->get('modelName') === 'Family' ?
                            'active'
                            : ''
                    ?>"
            >
                <a class="nav-link" href="<?=Url::toRoute(['dictionary/dictionary-list', 'modelName' => 'Family'])?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Семейства</span></a>
            </li>

            <!-- Nav Item -->
            <li
                class="nav-item
                    <?=
                        Yii::$app->request->get('modelName') === 'Kind' ?
                            'active'
                            : ''
                    ?>"
            >
                <a class="nav-link" href="<?=Url::toRoute(['dictionary/dictionary-list', 'modelName' => 'Kind'])?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Рода</span></a>
            </li>

            <!-- Nav Item -->
            <li
                class="nav-item
                    <?=
                        Yii::$app->request->get('modelName') === 'Place' ?
                            'active'
                            : ''
                    ?>"
            >
                <a class="nav-link" href="<?=Url::toRoute(['dictionary/dictionary-list', 'modelName' => 'Place'])?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Места</span></a>
            </li>

            <!-- Nav Item -->
            <li
                class="nav-item
                    <?=
                        Yii::$app->request->get('modelName') === 'Status' ?
                            'active'
                            : ''
                    ?>"
            >
                <a class="nav-link" href="<?=Url::toRoute(['dictionary/dictionary-list', 'modelName' => 'Status'])?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Статусы</span></a>
            </li>

            <!-- Divider -->
<!--            <hr class="sidebar-divider">-->
<!---->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="--><?//=Url::toRoute(['admin/static-page'])?><!--">-->
<!--                    <i class="fas fa-fw fa-tachometer-alt"></i>-->
<!--                    <span>Статические страницы</span></a>-->
<!--            </li>-->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <?= Html::beginForm(['/site/logout'], 'post') ?>
                            <?= Html::submitButton(
                         'Выйти (' .Yii::$app->user->identity->username . ')',
                                ['class' => 'btn mr-2 d-none d-lg-inline']
                            )?>
                            <?= Html::endForm() ?>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if( Yii::$app->session->hasFlash('error') ): ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('error'); ?>
                        </div>
                    <?php endif;?>

                    <?php if( Yii::$app->session->hasFlash('success') ): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('success'); ?>
                        </div>
                    <?php endif;?>

                    <?= $content ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; <?= date('Y') ?> <a href="http://www.bsu.ru/university/departments/faculties/bgf/">БГФ</a> <a href="http://imi.bsu.ru/">ИМИ</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
