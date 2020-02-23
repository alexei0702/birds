<?php

    use app\models\Bird;
    use yii\helpers\Html;
    use app\assets\MapViewAsset;
    MapViewAsset::register($this);

    $this->title = Html::encode ("{$bird->name}");
    $this->params['breadcrumbs'][] = $this->title;
?>

<h1 style="text-align: center;"><?=Html::encode ("{$bird->name}")?></h1>
<br>
<div class="col-lg-4">
<img src="<?= Yii::getAlias('@img') . Bird::IMAGE_PATH . $bird->link?>" width="400" class="img-rounded img-responsive" alt="<?= $bird->name ?>">
</div>
<div class="col-lg-8">
<table class="table table-striped table-hover">
<tbody>
	<tr>
		<th>Имя</th>
        <td><?=Html::encode ("{$bird->name} - {$bird->name_lat}")?></td>
    </tr>
    <tr>
    	<th>Отряд</th>
        <td><?= Html::encode ("{$bird->squad->name} - {$bird->squad->name_lat}") ?> </td>
    </tr>
    <tr>
    	<th>Семейство</th>
        <td><?= Html::encode ("{$bird->family->name} - {$bird->family->name_lat}") ?> </td>
    </tr>
    <tr>
    	<th>Род</th>
        <td><?= Html::encode ("{$bird->kind->name} - {$bird->kind->name_lat}") ?> </td>
    </tr>
    <tr>
    	<th>Распространение</th>
        <td><?= Html::encode ("{$bird->propagation}") ?> </td>
    </tr>
    <tr>
    	<th>Миграция</th>
        <td><?= Html::encode ("{$bird->migration}") ?> </td>
    </tr>
    <tr>
    	<th>Место обитания</th>
        <td><?= Html::encode ("{$bird->habitat}") ?> </td>
    </tr>
    <tr>
    	<th>Статус</th>
    	<td>
    		<?php foreach ($bird->statuses as $status): ?>
    		    <?= Html::encode ("{$status->name}") ?>
    	    <?php endforeach; ?>
    	</td>
    </tr>
    <tr>
    	<th>Численность</th>
    	<td>
    		<?php for ($i = 0; $i < count($bird->population); $i++): ?>
    		    <?= Html::encode ("{$bird->population[$i]->population} ({$bird->population[$i]->description}) - {$bird->places[$i]->name}") ?>
    	    <?php endfor; ?>
    	</td>
    </tr>
</tbody>
</table>
</div>
<style type="text/css">
    #map{
        height: 325px;
        width: 100%;
    }
</style>
<!--    TODO: добавить иерархию в базу, ссылки на родителей и поменять модели и создание (для птиц только семейство, остальное автоматически-->
<!--    TODO: add all-->
<?php if($bird->area == null): ?>
    <div id="map" data-coords="<?= Html::encode($coords)?>"></div>
<?php else: ?>
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="margin-top:30px;">
        <img src="<?= Yii::getAlias('@img') . Bird::AREA_PATH .$bird->area?>" class="img-rounded img-responsive" alt="area">
    </div>
<?php endif; ?>