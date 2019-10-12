<?php	
	use yii\helpers\Html;
	use app\models\Page;
	
	$this->title = $article->title;
	$header = '<header class="entry-header text-center text-uppercase">			
					<h1 class="entry-title">' . $article->title . '</h1>
				</header>';
				
	$header_top    = $article->content ? false : $header;
	$header_bottom = $header_top ? false : $header; 	
	$thumbnails    = $article->thumbnails;	
	$htmlContent   = $article->htmlContent;
	$imageFolder   = '/' . Yii::getAlias('@web') . 'images-folders/' . $article->imageFolder . '/';
	$images        = $article->postImages;
	
	$this->params['image'] = $thumbnails['file'];	
		
	Page::setMetaTags([
			'title'       => $article->title,
			'description' => $article->description,
			'section'     => 'Новости',
			'image'       => $thumbnails['file'],
		]);
?>
              
<article class="post">
	<?= $header_top; ?>
	<div class="post-thumb">
		<?= Html::img($thumbnails['file'], ['alt' => $article->title, ]); ?>
	</div>
	<div class="post-content">
		<?= $header_bottom; ?>
		
		<?php if(!$htmlContent): //Поле html-content не заполнено ?>
			<div class="entry-content">
				<p><?= $article->nl2p($article->content); ?></p>
			</div>
			
			<?php if(count($images) > 1): ?>
				<div class="post-images gallery row-flex">
					<?php foreach($images as $image): ?>
						<?php $imagePosition = $article->getObjectPosition($image['file']); ?>
						<div class="post-image">
							<a href="<?= $image['file'] ?>" title='<?= $image['title'] ?>'>
								<img src="<?= $image['file'] ?>" class="<?= $imagePosition ?>" />
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		<?php endif; ?>
		
		<?php if($htmlContent): //Поле html-content заполнено ?>
			<div class="html-content">
				<?= $this->render('/html_content/'.$htmlContent, compact('imageFolder')); ?>
			</div>
		<?php endif; ?>
		
		<div class="social-share">
			<span class="social-share-title pull-left"><?= $article->getPostDate(); ?></span>
			<?= $this->render('/partials/socialshare', ['image' => $thumbnails['file'], 'title' => $article->title]); ?>			
		</div>
	</div>
</article>

<?= $this->render('/partials/comment', compact('article', 'comments', 'commentForm')); ?>