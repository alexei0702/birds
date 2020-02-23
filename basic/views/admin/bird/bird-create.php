<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use app\assets\MapCreateAsset;
    MapCreateAsset::register($this);

    $this->title = 'Создание';
?>
<style>
    .width {
        width: 100%;
    }
    .textarea {
        height: 100px;
        width: 700px;
    }
</style>

<h1 style="text-align: center;">Создание</h1>

<?php
    $form = ActiveForm::begin([
        'id' => 'form-with-map',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'options' => [
            'class' => 'form',
            'enctype' => 'multipart/form-data'
        ]
    ])
?>

<?= $form->field($bird, 'name') ?>

<?= $form->field($bird, 'name_lat') ?>

<?php
    $items = ArrayHelper::map($squads,'id','name');
    $params = [
        'prompt' => 'Выберите Отряд'
    ];
    echo $form->field($bird, 'squad_id',['inputOptions' => ['class' => 'form-control width']])->dropDownList($items, $params);
?>

<?php
    $items = ArrayHelper::map($families,'id','name');
    $params = [
        'prompt' => 'Выберите Семейство'
    ];
    echo $form->field($bird, 'family_id',['inputOptions' => ['class' => 'form-control width']])->dropDownList($items,$params);
?>

<?php
    $items = ArrayHelper::map($kinds,'id','name');
    $params = [
        'prompt' => 'Выберите Род'
    ];
    echo $form->field($bird, 'kind_id',['inputOptions' => ['class' => 'form-control width']])->dropDownList($items,$params);
?>

<h3>Статус:</h3>

<?php
    $items = ArrayHelper::map($statuses,'id','name');
    echo $form->field($status_bird, 'status_id')->checkboxList($items)->label('');
?>

<h3>Распространение:</h3>

<?= $form->field($bird, 'propagation',['inputOptions' => ['class' => 'textarea']])->textarea()->label('') ?>

<h3>Миграции:</h3>

<?= $form->field($bird, 'migration',['inputOptions' => ['class' => 'textarea']])->textarea()->label('') ?>

<h3>Место обитания</h3>

<?= $form->field($bird, 'habitat',['inputOptions' => ['class' => 'textarea']])->textarea()->label('') ?>

<?php
    $items = [
        '1' => 'Юг Восточной Сибири',
        '2' => 'Республика Тыва'
    ];
    $params = [
        'prompt' => 'Выберите регион'
    ];
    echo $form->field($bird, 'region',['inputOptions' => ['class' => 'form-control width']])->dropDownList($items,$params);
?>

<h3>Численность:</h3>
<div class="col-lg-5">
    <?php
        $items = ArrayHelper::map($populations,'id','population');
        $params = [
            'prompt' => 'Численность'
        ];
        echo $form->field($population_bird_place, 'population_id',['inputOptions' => ['class' => 'form-control']])->dropDownList($items,$params);
    ?>
</div>
<div class="col-lg-5">
    <?php
        $items = ArrayHelper::map($places,'id','name');
        $params = [
            'prompt' => 'Место'
        ];
        echo $form->field($population_bird_place, 'place_id',['inputOptions' => ['class' => 'form-control']])->dropDownList($items,$params);
    ?>
</div>

<div class="clearfix"></div>
<style type="text/css">
    #map{
        height: 500px;
        width: 100%;
    }
</style>

<p style='font-size: 20px;'> Чтобы удалить полигон, нужно зажать клавишу CTRL и кликнуть по полигону левой кнопкой мыши. </p>

<div id="map" data-coords="<?= Html::encode($coords)?>"></div>

<button id="add-polygon" type="button" class="btn btn-success form-group">
    Добавить полигон
</button>

<input type="hidden" name="coords" id="coords">
<br>
<?= $form->field($bird, 'area', ['inputOptions' => ['class' => 'form-control']])->fileInput()->label('Выберите фото ареала') ?>

<?= $form->field($bird, 'link', ['inputOptions' => ['class' => 'form-control']])->fileInput()->label('Выберите фото птицы') ?>

<button class="btn btn-lg btn-primary form-group" type="submit">
    Сохранить
</button>

<?php ActiveForm::end() ?>