<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Squad;
use app\models\Family;
use app\models\Kind;
use app\models\Status;
use app\models\StatusConnect;
?>
<?php $this->title = 'Птицы'; ?>
<style>
body{
    background-image: url('http://www.zastavki.com/pictures/originals/2015/Backgrounds_Silhouette_of_the_bird_on_branch__light_background_102709_.jpg');
    background-size: cover; 
    background-repeat: no-repeat;
    background-attachment: fixed; 
}
.footer
{
    background: rgba(255, 255, 255, 0);
}
.text
{
    color : #0C6339 ;
}

</style>
<div class="banner">
    <h1 class="banner-head">
        Электронная база данных птиц<br>    
        Юга Восточной Сибири
    </h1>
</div>
<?php if($display==0): ?>
    <div class="btn-group" role="group">
        <button type="button" class="bttn-simple bttn-sm bttn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Сортировать по
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
                <li><a href="index.php?r=site/all-birds&sort=bird_name"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по имени</button></a></li>
                <li><a href="index.php?r=site/all-birds&sort=kind_id"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по роду</button></a></li>
                <li><a href="index.php?r=site/all-birds&sort=family_id"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по семейству</button></a></li>
                <li><a href="index.php?r=site/all-birds&sort=squad_id"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по отряду</button></a></li>
        </ul>
    </div>
    <a href="index.php?r=site/index" class="btn-right"><button class="bttn-minimal bttn-sm bttn-primary">Показывать по 3</button></a>
<?php else: ?>
    <div class="btn-group" role="group">
        <button type="button" class="bttn-simple bttn-sm bttn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Сортировать по 
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="index.php?r=site/index&sort=bird_name"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по имени</button></a></li>
            <li><a href="index.php?r=site/index&sort=kind_id"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по роду</button></a></li>
            <li><a href="index.php?r=site/index&sort=family_id"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по семейству</button></a></li>
            <li><a href="index.php?r=site/index&sort=&sort=squad_id"><button class="bttn-minimal bttn-sm bttn-primary">Сортировать по отряду</button></a></li>
        </ul>
    </div>
    <a href="index.php?r=site/all-birds" class="btn-right"><button class="bttn-minimal bttn-sm bttn-primary">Показать лентой</button></a>
<?php endif; ?>
<div class="row">
<?php
$i=0;
foreach ($birds as $bird): 
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
if($i%3==0):
?>
</div>
<br>
<div class="row">
<?php endif; ?>
<div class="col-md-4 text">
            <a href='index.php?r=site/views-details&id=<?=$bird->bird_id?>'>
            <img src="<?='/basic/upload/'.$bird->link?>" width="300" height="300" class="img-rounded" alt="111">
            <br>
            <?= Html::encode ("{$bird->bird_name} - {$bird->bird_name_lat}") ?><br>
            <?= Html::encode ("{$squad->squad_name} - {$squad->squad_name_lat}") ?> <br>
            <?= Html::encode ("{$family->family_name} - {$family->family_name_lat}") ?><br>
            <?= Html::encode ("{$kind->kind_name} - {$kind->kind_name_lat}") ?> <br>
            </a>
</div>
<?php 
$i++;
 endforeach;
 ?>
 </div>
<div class="clear-fix"></div>
<?php if($display): ?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<?php endif; ?>