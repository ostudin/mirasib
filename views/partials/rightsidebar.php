<?php
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;
	use app\models\Search;
	use app\models\Article;
	use app\models\User;
?>

<div class="primary-sidebar">
	
	<aside class="widget pb-0">
		<?php //Версия для слабовидящих ?>
		<div class="visually-impaired visually-impaired-right col-md-12 btn btn-danger wrap">
			<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Версия для слабовидящих
		</div>
		<div class="visually-normal visually-normal-button visually-impaired-right col-md-12 btn btn-link wrap mb-20">Обычный режим</div>
		
		<?php //Поиск ?>
		<?php
			$model = new Search;
			$form = ActiveForm::begin([
				'action' => ['site/search'],
				'options' => ['class' => 'form-horizontal', 'role' => 'form'],
				]);
		?>
			<div class="leave-comment mt-0 mb-0 pb-0" id="search">
				<form class="form-horizontal contact-form" role="form" method="post" action="#">		
					<div class="form-group mb-0">
						<div class="col-md-12 mt-10">
							<?= $form->field($model, 'search')->textInput(['class' => 'form-control', 'placeholder' => 'Поиск'])->label(false); ?>	
						</div>
					</div>				
				</form>
			</div>
		<?php ActiveForm::end(); ?>
	</aside>
	
	<?php if(!Yii::$app->user->isGuest): ?>
		<aside class="widget user pos-padding">
			<?php if($photo = User::getUserPhoto()): ?>
				<div class="user-photo">
					<?= Html::img($photo, ['class' => 'right-sidebar-user-photo']); ?>
				</div>
			<?php endif; ?>
			<p><?= Html::a(User::getUserName(), ['/auth/profile']); ?></p>
			<p><?= Html::a("<i class='fa fa-sign-out'></i> Выйти", ['/auth/logout'], ['data' => ['method' => 'post'], 'class' => 'white text-center']) ?></p>
		</aside>
	<?php endif; ?>
	
	<aside class="widget pos-padding">
		<h3 class="widget-title text-uppercase text-center">Фотоальбом</h3>		
		<div class="popular-post">
			<div class="article-img popular-img">				
				<?php $image = Article::getPreview([], 'photoalbumimg'); ?>
				<?= Html::a(Html::img($image['file'], ['alt' => 'Фотоальбом', 'class' => 'popular-img ' . $image['topPosition']]), ['/photo']); ?>
			</div>				
		</div>						
	</aside>
	
	<?php $popular = Article::getPopular(); ?>
	<?php if(count($popular)): ?>
		<aside class="widget pos-padding">
			<h3 class="widget-title text-uppercase text-center">Популярные посты</h3>
			<?php foreach($popular as $article): ?>
				<?php $thumbnails = $article->getPreview();?>
				<div class="popular-post">
					<div class="article-img popular-img">
					<?= Html::a(Html::img($thumbnails['file'], ['alt' => $article->title, 'class' => 'popular-img ' . $thumbnails['topPosition'], ]), [$article->pageURL, 'alias' => $article->alias]); ?>
					</div>
					<div class="p-content">					
						<?= Html::a($article->title, [$article->pageURL, 'alias' => $article->alias]); ?>
						<span class="p-date"><?= $article->getPostDate(); ?></span>
					</div>
				</div>				
			<?php endforeach; ?>					
		</aside>
	<?php endif; ?>
		
</div>

<?= $this->render('/partials/visually-js'); ?>