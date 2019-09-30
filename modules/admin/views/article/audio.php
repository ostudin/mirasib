<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'audio')->fileInput(['maxlength' => true])->label('Аудио') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
