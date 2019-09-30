<?php	
	use yii\helpers\Html;
	
	$this->title = $article->title;
	$header = '<header class="entry-header text-center text-uppercase">			
					<h1 class="entry-title">' . $article->title . '</h1>
				</header>';
		
	$thumbnails    = $article->thumbnails;	
	$htmlContent   = $article->htmlContent;
	$imageFolder   = '/' . Yii::getAlias('@web') . 'images-folders/' . $article->imageFolder . '/';
?>
              
<article class="post">
	<?= $header; ?>	
	<div class="post-content">		
					
		<div class="post-images gallery row-flex">
			<?php foreach($article->postImages as $image): ?>
				<?php $imagePosition = $article->getObjectPosition($image['file']); ?>
				<div class="post-image">
					<a href="<?= $image['file'] ?>" title='<?= $image['title'] ?>'>
						<img src="<?= $image['file'] ?>" class="<?= $imagePosition ?>" />
					</a>
				</div>
			<?php endforeach; ?>
		</div>
								
		<div class="social-share">
			<span class="social-share-title pull-left"><?= $article->getPostDate(); ?></span>
			<?= $this->render('/partials/socialshare', ['image' => $thumbnails['file'], 'title' => $article->title]); ?>			
		</div>
	</div>
</article>