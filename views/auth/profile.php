<?php
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
	use app\models\Page;

	$this->title = 'Профиль';
	
	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			'image'       => '/web/images/nroo-mira.jpg',
		]);	
?>

<div class="col-md-8 col-md-offset-2 module">
	<div class="module-title"><?= $this->title; ?></div>
	<div class="module-content">		
		<div class="col-md-8 col-md-offset-2">
			<?php
				$form = ActiveForm::begin();
								
				echo $form->field($user, 'fullname')->textInput(['autocomplete' => 'off', 'maxlength'=>'256'])->label("Имя");
				
				if(!$user['vk_id'])
				{
					echo '<p>' . Html::a("Изменить пароль", ['/auth/setpassword']) . '</p>';
				}
				//echo $form->field($user, 'password')->passwordInput()->label("Пароль");			
			?>

			<button type="submit" class="btn btn-primary col-md-8 col-md-offset-2">Сохранить</button>
			
			<?php
				ActiveForm::end();				
			?>
		</div>		
	</div>
</div>