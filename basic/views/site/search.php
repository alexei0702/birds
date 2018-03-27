<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Squad;
use app\models\Family;
use app\models\Kind;
use app\models\Status;
use app\models\StatusConnect;
?>
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
.head
{
    text-align: center;    
    color : #061C4E !important;
}
.text
{
    color : #0C6339 ;
}
</style>

<div class="jumbotron">
<h2 class="head">По запросу <b><?=$query?></b> найдено совпадений: <?=$num?></h2>
<br>
<br>
<div class="row">
<?php
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
?>
<div class="col-lg-4 text">
            <a href='index.php?r=site/views-details&id=<?=$bird->bird_id?>'>
            <img src="<?= '/basic/upload/'.$bird->link?>" width="300" height="300" class="img-rounded" alt="111">
            <br>
            <?= Html::encode ("{$bird->bird_name} - {$bird->bird_name_lat}") ?><br>
            <?= Html::encode ("{$squad->squad_name} - {$squad->squad_name_lat}") ?> <br>
            <?= Html::encode ("{$family->family_name} - {$family->family_name_lat}") ?><br>
            <?= Html::encode ("{$kind->kind_name} - {$kind->kind_name_lat}") ?> <br>
            </a>
</div>
<?php 
 endforeach;
 ?>
 </div>
 </div>
<div class="clear-fix"></div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>