<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($page, 'title')->textInput()->label('Title') ?>

    <?= $form->field($page, 'content')->textArea()->label('Content') ?>

    <?= Html::submitButton('Создать',['class' => 'bttn-fill bttn-md bttn-primary']) ?>

<?php ActiveForm::end() ?>