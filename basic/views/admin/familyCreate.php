	<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
require_once ('menu.php');
?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'family_name')->textInput()->label('Семейство') ?>

    <?= $form->field($model, 'family_name_lat')->textInput()->label('На латинском') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'bttn-fill bttn-md bttn-success' : 'bttn-fill bttn-md bttn-primary']) ?>

<?php ActiveForm::end() ?>