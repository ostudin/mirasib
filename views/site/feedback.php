<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\captcha\Captcha;
	use app\models\Page;
	
	$this->title = "Написать нам";
	
	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			//'section'     => 'Контакты',
			'image'       => '/web/images/nroo-mira.jpg',
		]);
?>

<div class="col-md-12 module">
	<header class="entry-header text-center text-uppercase">			
		<h1 class="entry-title"><?= $this->title; ?></h1>
	</header>
	<div class="module-content">
		<div class="col-sm-4 col-sm-offset-4 mt-20">
			<?php 
				$form = ActiveForm::begin();
						
				echo $form->field($model, 'name')->textinput(['maxlength'=>'32', 'placeholder'=>'Введите имя'])->label(false);
				/* echo $form->field($model, 'phone')->textinput()->label(false)
								->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999) 999 99 99'])
								->textInput(['placeholder' => 'Введите телефон']); */
				echo $form->field($model, 'email')->textinput(['maxlength'=>'32', 'placeholder'=>'Введите адрес электронной почты'])->label(false);
				
				echo $form->field($model, 'message')->textarea(['maxlength'=>'1500', 'placeholder'=>'Введите текст сообщения', 
						'cols' => '30', 'rows' => '4'])->label(false);
									
				echo Html::submitButton('Отправить', ['class' => 'btn btn-success mb-20 mt-20 col-sm-8 col-sm-offset-2', 'id' => 'feedback-button']); 
			
				ActiveForm::end();
			?>					
		</div>
		<div class="col-sm-8 col-sm-offset-2 text-center mb-20">Нажимая на кнопку, вы даете согласие на обработку персональных данных и соглашаетесь c <?= Html::a('политикой конфиденциальности', ['site/privacy'], ['target' => '_blank']) ?></div>
	</div>
</div>