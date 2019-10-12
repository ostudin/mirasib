<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;	
	//use yii\widgets\MaskedInput;	
	use app\models\Page;

	$this->title = "Регистрация";
	
	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			'image'       => '/web/images/nroo-mira.jpg',
		]);		
?>

<div class="col-md-12 module">
	<div class="module-title"><?= $this->title; ?></div>
	<div class="module-content">
		<p class="text-center">Пожалуйста, заполните следующие поля:</p>

		<div class="col-sm-4 col-sm-offset-4">

		<?php
			$form = ActiveForm::begin();
			
			echo $form->field($model, 'name')->textInput(['autofocus' => true, 'autocomplete' => 'off', 'maxlength'=>'32'])->label("Логин");
			echo $form->field($model, 'email')->textInput(['autocomplete' => 'off'])->label("E-mail");
			echo $form->field($model, 'password')->passwordInput()->label("Пароль");
			//echo $form->field($model, 'phone')->textInput()->label('Номер телефона')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999 99 99']);
			/* echo 	'<img src="'.Yii::getAlias('@web').'/css/refresh.png" title="Обновить число" id="captcha-refresh" />';
			echo $form->field($model, 'verifyCode')->widget(Captcha::className(['autocomplete' => 'off']), ['imageOptions' => ['id' => 'captcha-image']])
					->label("Введите код"); */
		?>

			<button type="submit" class="btn btn-primary col-sm-6 col-sm-offset-3 mb-20">Отправить</button>

		<?php
			ActiveForm::end();	
		?>
		</div>
	</div>
</div>
