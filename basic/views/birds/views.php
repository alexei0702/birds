<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Squad;
use app\models\Family;
use app\models\Kind;
use app\models\Status;
use app\models\StatusConnect;

require_once ('menu.php');
?>
<h1>Птички</h1>
<br>
<p>
        <a href="index.php?r=birds/create-bird"><button class="bttn-unite bttn-md bttn-primary">Добавить</button></a>
</p>
<br>
<table class="table table-striped table-hover table-bordered">
<thead>
<tr>
<th>#</th>
<th>Имя</th>
<th>Отряд</th>
<th>Семейство</th>
<th>Род</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
<?php $i=1;
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
	    <tr>
            <td><?=$i?></td>
            <td><?= Html::a(Html::encode ("{$bird->bird_name} - {$bird->bird_name_lat}"), "index.php?r=birds/views-details&id=".$bird->bird_id) ?></td>
            <td><?= Html::encode ("{$squad->squad_name} - {$squad->squad_name_lat}") ?> </td>
            <td><?= Html::encode ("{$family->family_name} - {$family->family_name_lat}") ?> </td>
            <td><?= Html::encode ("{$kind->kind_name} - {$kind->kind_name_lat}") ?> </td>
            <td>
            <a href="/bird_project/basic/web/index.php?r=birds%2Fupdate-bird&amp;id=<?=$bird->bird_id?>&amp;name=Bird" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="/basic/web/index.php?r=birds%2Fdelete-bird&amp;id=<?=$bird->bird_id?>&amp;name=Bird" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
<?php $i++;
 endforeach;
 ?>
</tbody>
</table>

<?= LinkPager::widget(['pagination' => $pagination]) ?>