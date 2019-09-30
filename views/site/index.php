<?php
	use yii\helpers\Html;
	
	$this->title = 'НРОО "МиРа"';
?>

<div class="col-md-12 module">	
	<div class="col-md-12 module-content">
		<div class="slider-wrapper theme-default col-md-12">
            <div id="slider" class="nivoSlider">
				<?php if(count($slides)): ?>
					<?php foreach ($slides['images'] as $item): ?>						
						<img src='/web/images-slider/<?= $item ?>' data-thumb='/web/images-slider/<?= $item ?>' alt='' class="slide" title='Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"' />						
					<?php endforeach; ?>											
				<?php endif; ?>				
            </div>            
        </div>	
	</div>
</div>

<div class="col-md-12 module">
	<div class="col-md-12 module-title">Новости</div>
	<div class="col-md-12 module-content row-flex">
		<?php foreach($articles as $article): ?>
			<?php $thumbnails = $article->thumbnails;?>
			<div class="col-md-4 article">
				<div class="article-img">
					<?= Html::a(Html::img($thumbnails['file'], ['alt' => $article->title, 'class' => $thumbnails['topPosition'], ]), 
							[$article->pageURL, 'id' => $article->id]); ?>
				</div>
				<div class="article-content">
					<div class="article-date"><?= $article->getPostDate(); ?></div>
					<div class="article-title"><?= Html::a('<h2>' . $article->title . '</h2>', [$article->pageURL, 'id' => $article->id]); ?></div>
					<div class="article-description"><?= Html::a($article->description, [$article->pageURL, 'id' => $article->id]); ?></div>
				</div>
			</div>					
		<?php endforeach; ?>
		<div class="col-md-12 text-center">
			<a class="button" href="/news">Показать все</a>
		</div>
	</div>
</div>

<div class="col-md-12 module">
	<div class="col-md-12 module-title">Услуги</div>
	<div class="col-md-12 module-content row-flex">
		<?php foreach($services as $article): ?>
			<?php $thumbnails = $article->getThumbnails('service');?>
			<div class="col-md-4 article">
				<div class="article-img-contain">
					<?= Html::a(Html::img($thumbnails['file'], ['alt' => $article->title, 'class' => $thumbnails['topPosition'], ]), 
							[$article->pageURL, 'id' => $article->id]); ?>
				</div>
				<div class="article-content">
					<div class="article-date"></div>
					<div class="article-title"><?= Html::a('<h2>' . $article->title . '</h2>', [$article->pageURL, 'id' => $article->id]); ?></div>
					<div class="article-description"><?= Html::a($article->description, [$article->pageURL, 'id' => $article->id]); ?></div>
				</div>
			</div>					
		<?php endforeach; ?>		
	</div>
</div>

<div class="col-md-12 module">
	<div class="col-md-12 module-title">Наша команда</div>
	<div class="col-md-12 module-content row-flex">
		<?php foreach($interview as $article): ?>
			<?php $thumbnails = $article->thumbnails;?>
			<div class="col-md-4 article">
				<div class="article-img">
					<?= Html::a(Html::img($thumbnails['file'], ['alt' => $article->title, 'class' => $thumbnails['topPosition'], ]), 
							[$article->pageURL, 'id' => $article->id]); ?>
				</div>
				<div class="article-content">
					<div class="article-date"><?= $article->getPostDate(); ?></div>
					<div class="article-title"><?= Html::a('<h2>' . $article->title . '</h2>', [$article->pageURL, 'id' => $article->id]); ?></div>
					<div class="article-description"><?= Html::a($article->description, [$article->pageURL, 'id' => $article->id]); ?></div>
				</div>
			</div>					
		<?php endforeach; ?>		
	</div>
</div>

<div class="col-md-12 module">
	<div class="col-md-12 module-title">Стихи</div>
	<div class="col-md-12 module-content row-flex">
		<?php foreach($poems as $article): ?>
			<?php $thumbnails = $article->thumbnails;?>
			<div class="col-md-4 article">
				<div class="article-img">
					<?= Html::a(Html::img($thumbnails['file'], ['alt' => $article->title, 'class' => $thumbnails['topPosition'], ]), 
							[$article->pageURL, 'id' => $article->id]); ?>
				</div>
				<div class="article-content">
					<div class="article-date"></div>
					<div class="article-title"><?= Html::a('<h2>' . $article->title . '</h2>', [$article->pageURL, 'id' => $article->id]); ?></div>
					<div class="article-description"><?= Html::a($article->description, [$article->pageURL, 'id' => $article->id]); ?></div>
				</div>
			</div>					
		<?php endforeach; ?>		
	</div>
</div>
            