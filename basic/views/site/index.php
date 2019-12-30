<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
    use app\models\Squad;
    use app\models\Family;
    use app\models\Kind;
    use app\models\Status;
    use app\models\StatusConnect;
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
        <li>
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
            <a href='index.php?r=site/views-details&id=<?=$bird->bird_id?>'>
            <!-- <img src="<?='/basic/upload/'.$bird->link?>" width="300" height="300" class="img-rounded" alt="111"> -->
            <img src="./../upload/1481549917_gag1.jpg" width="300" height="300" class="img-rounded" alt="111">
            <br>
            <?= Html::encode ("{$bird->bird_name} - {$bird->bird_name_lat}") ?><br>
            <?= Html::encode ("{$bird->squad->squad_name} - {$bird->squad->squad_name_lat}") ?> <br>
            <?= Html::encode ("{$bird->family->family_name} - {$bird->family->family_name_lat}") ?><br>
            <?= Html::encode ("{$bird->kind->kind_name} - {$bird->kind->kind_name_lat}") ?> <br>
            </a>
</div>
<?php 
$i++;
 endforeach;
 ?>
 </div>
<div class="clear-fix"></div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
