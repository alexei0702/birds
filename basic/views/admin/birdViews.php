<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Status;
use app\models\Population;
use app\models\Place;
require_once ('menu.php');
?>

<h1 style="text-align: center;">Птичка</h1>
<br>
<div class="col-lg-4">
<img src="<?= '/bird_project/basic/upload/'.$bird->link?>" width="400" class="img-rounded img-responsive" alt="111">
</div>
<div class="col-lg-8">
<table class="table table-striped table-hover">
<tbody>
	<tr>
		<td>Имя</td>
        <td><?=Html::encode ("{$bird->bird_name} - {$bird->bird_name_lat}")?></td>
    </tr>
    <tr>
    	<td>Отряд</td>
        <td><?= Html::encode ("{$squad->squad_name} - {$squad->squad_name_lat}") ?> </td>
    </tr>
    <tr>
    	<td>Семейство</td>
        <td><?= Html::encode ("{$family->family_name} - {$family->family_name_lat}") ?> </td>
    </tr>
    <tr>
    	<td>Род</td>
        <td><?= Html::encode ("{$kind->kind_name} - {$kind->kind_name_lat}") ?> </td>
    </tr>
    <tr>
    	<td>Распространение</td>
        <td><?= Html::encode ("{$bird->propagation}") ?> </td>
    </tr>
    <tr>
    	<td>Миграция</td>
        <td><?= Html::encode ("{$bird->migration}") ?> </td>
    </tr>
    <tr>
    	<td>Место обитания</td>
        <td><?= Html::encode ("{$bird->habitat}") ?> </td>
    </tr>
    <tr>
    	<td>Статус</td>
    	<td>
    		<?php 
    			foreach ($statusCon as $key):
    			$status = Status::find()->where(['status_id' => $key->status_id])->one();
    		?>
    		<?= Html::encode ("{$status->status_name}") ?> 
    	<?php endforeach; ?>
    	</td>
    </tr>
    <tr>
    	<td>Численность</td>
    	<td>
    		<?php 
    			foreach ($popul_con as $key):
    			$population = Population::find()->where(['population_id' => $key->population_id])->one();
    			$place = Place::find()->where(['place_id' => $key->place_id])->one();
    		?>
    		<?= Html::encode ("{$population->population} ($population->population_description) - {$place->place_name}") ?> 
    	<?php endforeach; ?>
    	</td>
    </tr>
</tbody>
</table>
</div>
<a href="/basic/web/index.php?r=birds%2Fupdate-bird&amp;id=<?=$bird->bird_id?>&amp;name=Bird" title="Update" aria-label="Update" data-pjax="0"><button class="bttn-float bttn-md bttn-primary">Обновить</button></a>

 <a href="/basic/web/index.php?r=birds%2Fdelete-bird&amp;id=<?=$bird->bird_id?>&amp;name=Bird" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><button class="bttn-float bttn-md bttn-danger">Удалить</button></a> 