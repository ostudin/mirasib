<?php	
	use yii\helpers\Html;
	use app\models\Page;
	
	$this->title = 'Наши достижения';
	$header = '<header class="entry-header text-center text-uppercase">			
					<h1 class="entry-title">' . $this->title . '</h1>
				</header>';		
		
	Page::setMetaTags([
			'title'       => $this->title,			
			'section'     => $this->title,
			'image'       => $diplomas[0]['file'],
		]);
?>
              
<article class="post">
	<?= $header; ?>
	
	<div class="post-content">							
			<?php if(count($diplomas) > 1): ?>
				<div class="gallery row-flex">
					<?php foreach($diplomas as $image): ?>
						<div class="diplom col-md-4">
							<a href="<?= $image['file'] ?>" title=''>
								<img src="<?= $image['file'] ?>" class="<?= $image['topPosition'] ?>" />
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>	
		
		<div class="social-share">			
			<?= $this->render('/partials/socialshare', ['image' => $diplomas[0]['file'], 'title' => $this->title]); ?>			
		</div>
	</div>
</article>