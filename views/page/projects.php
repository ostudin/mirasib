<?php
	use yii\helpers\Html;
	$this->title = 'Наши проекты';
?>

<article class="post">                    
	<div class="post-content">
		<header class="entry-header text-center text-uppercase">                            
			<h1 class="entry-title"><?= $this->title; ?></h1>
		</header>
		<div class="entry-content">
			<div class="projects last col-md-12">
				<h2 class="projects-title">Изготовление брошей</h2>
				<?= Html::a(Html::img(Yii::getAlias('@web') . '/images/broshi.jpg', ['width' => '100%', 'height' => 'auto']), ['site/view', 'id' => '85'], ['class' => 'project-img']) ?>
				<p>Друзья, среди членов организации «МиРа» есть настоящие мастера народного творчества… Изготовлением красивых ювелирных украшений занимается <a href='https://www.instagram.com/nataljaviltsan/?igshid=15e98tgn9m0n8' target='_blank'>Наталья Вылцан</a>. Эта удивительная женщина охотно делиться своим мастерством со всеми, кто пожелает. Работы, представленные <?= Html::a('на этой странице', ['site/view', 'id' => '85'])?>, тоже выполнены мастерицей. Их может приобрести любой желающий. Цены – под каждым изделием. Подробная информация по телефону 8 (383) 312-01-40</p>
			</div>
			
		</div>		

		<div class="social-share">			
			<?= $this->render('/partials/socialshare', ['image' => false, 'title' => $this->title]); ?>			
		</div>
		
	</div>
</article>