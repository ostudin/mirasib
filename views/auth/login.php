<?php
	use yii\bootstrap\ActiveForm;
	//use yii\captcha\Captcha;	
	use yii\helpers\Html;
	use app\models\Page;

	$this->title = 'Авторизация';

	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			'image'       => '/web/images/nroo-mira.jpg',
		]);	
	
	
?>

<div class="col-md-8 module">
	<div class="module-title"><?= $this->title; ?></div>
	<div class="module-content">
		<p class="text-center">Пожалуйста, заполните следующие поля:</p>
		<div class="col-md-6 col-md-offset-3">
			<?php
				$form = ActiveForm::begin();
				
				echo $form->field($login_model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off', 'maxlength'=>'32'])->label("Логин");
				echo $form->field($login_model, 'password')->passwordInput()->label("Пароль");

				/* echo 	'<img src="'.Yii::getAlias('@web').'/css/refresh.png" title="Обновить число" id="captcha-refresh" />';
				echo $form->field($login_model, 'verifyCode')->widget(Captcha::className(['autocomplete' => 'off']), ['imageOptions' => ['id' => 'captcha-image']])
					->label("Введите код"); */
			?>

			<button type="submit" class="btn btn-primary col-md-8 col-md-offset-2">Войти</button>
			<p class="col-md-12 text-center"><?= Html::a("Зарегистрироваться", ['/auth/signup']) ?></p>

			<?php
				ActiveForm::end();
				
				/*$this->registerJs("								
							$(document).on('click', '#captcha-refresh', function(event){
								$('#captcha-image').yiiCaptcha('refresh');
							});
						");*/
			?>
		</div>		
	</div>
</div>

<div class="col-md-4">
	
		<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
		<script type="text/javascript">
			VK.init({apiId: 7110624});
		</script>

		<!-- VK Widget -->
		<div id="vk_auth"></div>
		<script type="text/javascript">
			VK.Widgets.Auth("vk_auth", {"authUrl":"/auth/login-vk"});
		</script>
	
</div>