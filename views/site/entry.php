<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
    <!--custom labels-->
    <?= $form->field($model, 'name')->label('Нэйм') ?>
    <!--?= $form->field($model, 'name') ?-->
    <?= $form->field($model, 'email')->label('Емейл') ?>
    <!--?= $form->field($model, 'email') ?-->

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>