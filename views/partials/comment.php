<?php
	use yii\widgets\ActiveForm;
	use yii\helpers\Html; 
?>

<?php if(count($comments)): ?>
	<div class="bottom-comment"><!--bottom comment-->
		<h4>Комментарии</h4>
		<?php foreach($comments as $item): ?>
			<div class="col-md-12">
				<div class="comment-img">
					<img class="img-circle" src="<?= $item['photo'] ?>" alt="">
				</div>

				<div class="comment-text">					
					<?= Html::a('Ответить', [
							Yii::$app->requestedRoute, 
							'id' => $article->id, 
							'uid' => $item['user_id'] ,
							'#'=>'comment'
						],['class'=>'replay btn pull-right'])?>
					<h5><?= $item['name'] ?></h5>

					<p class="comment-date">
						<?= $article->getPostDate($item['date']); ?>
					</p>

					<p class="para"><?= $item['text']; ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if(!Yii::$app->user->isGuest): ?>
	<?php if(Yii::$app->session->getFlash('comment')): ?>
		<div class="alert alert-success" role="alert">
			<?= Yii::$app->session->getFlash('comment'); ?>
		</div>
	<?php endif; ?>

	<?php
		$form = ActiveForm::begin([
			'action' => ['site/comment', 'id' => $article->id],
			'options' => ['class' => 'form-horizontal contact-form', 'role' => 'form'],
			]);
	?>
		<div class="leave-comment" id="comment"><!--leave comment-->
			<h4>Оставить комментарий</h4>
			<form class="form-horizontal contact-form" role="form" method="post" action="#">		
				<div class="form-group">
					<div class="col-md-12">
						<?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Введите текст комментария'])->label(false); ?>							
					</div>
				</div>
				<button type="submit" class="btn send-btn">Отправить</button>
			</form>
		</div><!--end leave comment-->
	<?php ActiveForm::end(); ?>
<?php endif; ?>

<?php if(Yii::$app->user->isGuest): ?>
	<div class="alert alert-warning" role="alert">
		Для отправки комментария необхожимо <?= Html::a('пройти авторизацию', ['/entry']);?> на сайте
	</div>
<?php endif; ?>