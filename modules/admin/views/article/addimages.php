<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => true])->label('Добавить изображение') ?>
	<?= $form->field($model, 'text')->textInput()->label('Подпись к изображению') ?>
	
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
		
</div>

<div class="col-md-12 row-flex">
	<?php foreach($images as $item): ?>
		<div class="col-md-2">
			<div class="uploaded-images">
				<img src="/uploads/images/<?= $item['file'] ?>" />
				<div class="description">
					<div><?= $item['title'] ?></div>
					<div><?= Html::a('Удалить', ['delete-image', 'id' => $item['id'] ]) ?></div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>