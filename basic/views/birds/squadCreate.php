<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
require_once ('menu.php');
?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'squad_name')->textInput()->label('Отряд') ?>

    <?= $form->field($model, 'squad_name_lat')->textInput()->label('На латинском') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'bttn-fill bttn-md bttn-success' : 'bttn-fill bttn-md bttn-primary']) ?>

<?php ActiveForm::end() ?>