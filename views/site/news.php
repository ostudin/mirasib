<?php
	use yii\widgets\LinkPager;
	use yii\helpers\Html;
	use app\models\Page;
	
	$this->title = $title;
	
	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			'image'       => '/web/images/nroo-mira.jpg',
		]);	
?>

<div class="col-md-12 module">
	<div class="col-md-12 module-title"><?= $this->title; ?></div>
	<div class="col-md-12 module-content row-flex">
		<?php foreach($articles as $article): ?>
			<?php 
				$thumbnails = $article->getPreview();
				$link = ($title !== 'Фотоальбом') ? $article->pageURL : $article->getPageURL(1);
			?>
			<div class="col-md-4 article">
				<div class="article-img">
					<?= Html::a(Html::img($thumbnails['file'], ['alt' => $article->title, 'class' => $thumbnails['topPosition'],]), 
							[$link, 'alias' => $article->alias]); ?>
				</div>
				<div class="article-content">
					<div class="article-date"><?= $article->getPostDate(); ?></div>
					<div class="article-title"><?= Html::a('<h2>' . $article->title . '</h2>', [$link, 'alias' => $article->alias]); ?></div>
					<?php if($title !== 'Фотоальбом'): ?>
						<div class="article-description"><?= Html::a($article->description, [$link, 'alias' => $article->alias]); ?></div>
					<?php endif; ?>
				</div>
			</div>					
		<?php endforeach; ?>		
	</div>
</div>

<?php
	echo LinkPager::widget(['pagination' => $pagination, ]);
?>