<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = $title;
?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'name')->textInput() ?>

    <?= $withLatName ? $form->field($model, 'name_lat')->textInput() : null ?>

    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-primary']) ?>

<?php ActiveForm::end() ?>