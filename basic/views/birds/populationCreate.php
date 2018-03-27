<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
require_once ('menu.php');
?>
<?php $form = ActiveForm::begin() ?>	
	<?= $form->field($model, 'population_designations')->textInput()->label('Обозначение') ?>

	<?= $form->field($model, 'population')->textInput()->label('Численность') ?>

	<?= $form->field($model, 'population_description')->textInput()->label('Описание') ?>

	<?= $form->field($model, 'population_dimension_start')->textInput()->label('Количество (нижняя граница)') ?>

	<?= $form->field($model, 'population_dimension_end')->textInput()->label('Количество (верхняя граница)') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'bttn-fill bttn-md bttn-success' : 'bttn-fill bttn-md bttn-primary']) ?>

<?php ActiveForm::end() ?>