<?php

    use app\models\Bird;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
?>
<?php $title = $region == 1 ? 'юга Восточной Сибири' : 'Республики Тыва'; ?> 
<?php $this->title = 'База данных птиц '.$title; ?>

<div class="banner">
    <h1 class="banner-head">
        Электронная база данных птиц<br>    
        <?=$title?>
    </h1>
</div>
<div class="btn-group" role="group">
    <button type="button" class="bttn-simple bttn-sm bttn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Сортировать по
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li>
            <a href="<?=Url::toRoute(['site/index', 'sort' => 'bird_name'])?>">
                <button class="bttn-minimal bttn-sm bttn-primary">
                    Сортировать по имени
                </button>
            </a>
        </li>
        <li> <!-- TODO: поменять href на URL::TO и сортировать не по id -->
            <a href="index.php?r=site/index&sort=kind_id">
                <button class="bttn-minimal bttn-sm bttn-primary">
                    Сортировать по роду
                </button>
            </a>
        </li>
        <li>
            <a href="index.php?r=site/all-birds&sort=family_id">
                <button class="bttn-minimal bttn-sm bttn-primary">
                    Сортировать по семейству
                </button>
            </a>
        </li>
        <li>
            <a href="index.php?r=site/index&sort=squad_id">
                <button class="bttn-minimal bttn-sm bttn-primary">
                    Сортировать по отряду
                </button>
            </a>
        </li>
    </ul>
</div>
<div class="row">
<?php
    $i=0;
    foreach ($birds as $bird):
    if($i%3==0):
?>
</div>
<br>
<div class="row">
<?php endif; ?>
    <div class="col-md-4">
        <a href='<?=Url::toRoute(['site/views-details', 'id' => $bird->id])?>'>
         <img src="<?=Yii::getAlias('@img') . Bird::IMAGE_PATH . $bird->link?>" width="300" height="300" class="img-rounded" alt="<?= $bird->name ?>">
<!--        <img src="./../upload/1481549917_gag1.jpg" width="300" height="300" class="img-rounded" alt="111">-->
        <br>
        <?= Html::encode ("{$bird->name} - {$bird->name_lat}") ?><br>
        <?= Html::encode ("{$bird->squad->name} - {$bird->squad->name_lat}") ?> <br>
        <?= Html::encode ("{$bird->family->name} - {$bird->family->name_lat}") ?><br>
        <?= Html::encode ("{$bird->kind->name} - {$bird->kind->name_lat}") ?> <br>
        </a>
    </div>
<?php 
    $i++;
    endforeach;
 ?>
</div>
<div class="clear-fix"></div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
