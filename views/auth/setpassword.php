<?php
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
	
	$this->title = 'Изменение пароля';
?>

<div class="col-md-8 col-md-offset-2 module">
	<div class="module-title"><?= $this->title; ?></div>
	<div class="module-content">		
		<div class="col-md-8 col-md-offset-2">						
			<?php
				if($user['vk_id'])
				{
					echo '<div class="alert alert-success" role="alert">При авторизации через социальную сеть ввода пароля не требуется</div>';
					echo Html::a("Вернуться", ['/auth/profile'], ['class' => 'button col-md-6 col-md-offset-3 text-center']);
				}
			
				if(!$user['vk_id']):
					$form = ActiveForm::begin();
					
					echo $form->field($user, 'newPassword')->passwordInput()->label("Новый пароль");			
					echo $form->field($user, 'newPasswordRepeat')->passwordInput()->label("Подтвердите пароль");			
			?>

			<button type="submit" class="btn btn-primary col-md-8 col-md-offset-2">Сохранить</button>
			
			<?php
				ActiveForm::end();
				endif;				
			?>
		</div>		
	</div>
</div>