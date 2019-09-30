<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6])->label('Текст статьи') ?>

    <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')])->label('Дата') ?>

    <?= false;//$form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?= false;//$form->field($model, 'imageFolder')->textInput(['maxlength' => true]) ?>
    <?= false;//$form->field($model, 'category_id')->textInput() ?>
    <?= false;//$form->field($model, 'html_page')->textInput(['maxlength' => true]) ?>
    <?= false;//$form->field($model, 'viewed')->textInput() ?>
    <?= false;//$form->field($model, 'user_id')->textInput() ?>
    <?= false;//$form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
