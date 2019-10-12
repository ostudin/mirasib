<?php
	use yii\helpers\Html;
	use app\models\Page;	
	
	$this->title = 'Наши проекты';
	
	Page::setMetaTags([
		'title'   => 'Проекты НРОО "МиРа"',
		'section' => 'Проекты',
		'image'   => '/images-folders/socialnye-uslugi/socuslugi-service.jpg',
	]);
?>

<article class="post">                    
	<div class="post-content">
		<header class="entry-header text-center text-uppercase">                            
			<h1 class="entry-title"><?= $this->title; ?></h1>
		</header>
		<div class="entry-content">
			<div class="projects col-md-12">
				<h2 class="projects-title">Изготовление брошей</h2>
				<?= Html::a(Html::img(Yii::getAlias('@web') . '/images/broshi.jpg', ['width' => '100%', 'height' => 'auto']), ['site/view', 'alias' => '2019-09-16-broshi'], ['class' => 'project-img']) ?>
				<p>Друзья, среди членов организации «МиРа» есть настоящие мастера народного творчества… Изготовлением красивых ювелирных украшений занимается <a href='https://www.instagram.com/nataljaviltsan/?igshid=15e98tgn9m0n8' target='_blank'>Наталья Вылцан</a>. Эта удивительная женщина охотно делиться своим мастерством со всеми, кто пожелает. Работы, представленные <?= Html::a('на этой странице', ['site/view', 'alias' => '2019-09-16-broshi'])?>, тоже выполнены мастерицей. Их может приобрести любой желающий. Цены – под каждым изделием. Подробная информация по телефону 8 (383) 312-01-40</p>
			</div>
			
			<div class="projects last col-md-12">
				<h2 class="projects-title">Социальные услуги</h2>
				<?= Html::a(Html::img(Yii::getAlias('@web') . '/images-folders/socialnye-uslugi/socuslugi-service.jpg', ['width' => '100%', 'height' => 'auto']), ['site/view', 'alias' => 'socialnye-uslugi'], ['class' => 'project-img']) ?>
				<p class="info">Общественная организация “МиРа” ориентируется на социальное предпринимательство. В рамках этого направления, мы начинаем оказывать комплекс услуг населению города и людям с ОВЗ.</p>
				<div>
				<p class="info">- Представление интересов в органах власти</p>
				<p class="info">- Профпереподготовка и трудоустройство</p>
				<p class="info">- Юридическая консультация</p>
				<p class="info">- Поддержка при медицинской реабилитации</p>
				<p class="info">- Социальное такси</p>
				<p class="info">- Доставка товаров на дом</p>
				<p class="info">- Мелкий бытовой ремонт</p>
				<p class="info">- Уборка квартир, домов</p>
				<p class="info">- Другая социальная помощь населению и людям с ОВЗ</p>
				</div>
				<p>С более подробной информацией об услугах Вы можете ознакомиться <?= Html::a('здесь', ['site/view', 'alias' => 'socialnye-uslugi'])?></p>
				<p>Будем рады Вашим звонкам по телефону  8 (383) 312-01-40</p>
			</div>
			
		</div>		

		<div class="social-share">			
			<?= $this->render('/partials/socialshare', ['image' => false, 'title' => $this->title]); ?>			
		</div>
		
	</div>
</article>