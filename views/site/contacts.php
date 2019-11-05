<?php
	use yii\helpers\Html;
	use app\models\Page;
			
	$this->title = $title;
	
	Page::setMetaTags([
			'title'       => $title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			//'section'     => 'Контакты',
			'image'       => '/web/images/nroo-mira.jpg',
		]);
?>

<article class="post">                    
	<div class="post-content">
		<header class="entry-header text-center text-uppercase">                            
			<h1 class="entry-title"><?= $this->title; ?></h1>
		</header>
	
		<div class="entry-content">			
			<iframe id="yandex-card" src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac9d67fd001b75e066cfb53ce6a342c865af622492b122339007e76fac5ce24aa&amp;source=constructor" frameborder="0"></iframe>
			
			<div id="contacts-div" class="col-md-12">
				<div id="contacts-list" class="col-md-12 row-flex">
					<div class="col-md-6 mb-10">
						<div class="col-md-12 contacts-list-title">Адрес организации</div>
						<div class="contacts-items col-md-12 row-flex align-items-center nowrap">
							<div class="contacts-items-img"><?= Html::img('@web/images/location.png') ?></div>
							<div class="contacts-items-content wrap">630054, г. Новосибирск, ул Римского-Корсакова, 10, первый этаж</div>
						</div>
					</div>
					<div class="col-md-6 mb-10">
						<div class="col-md-12 contacts-list-title">Время работы</div>
						<div class="contacts-items col-md-12 row-flex align-items-center nowrap">
							<div class="contacts-items-img"><?= Html::img('@web/images/clock.png') ?></div>
							<div class="contacts-items-content wrap">с 9:00 до 16:00</div>
						</div>
					</div>
					<div class="col-md-6 mb-10">
						<div class="col-md-12 contacts-list-title">Телефоны</div>
						<div class="contacts-items col-md-12 row-flex align-items-center nowrap">
							<div class="contacts-items-img"><?= Html::img('@web/images/phone.png') ?></div>
							<div class="contacts-items-content nowrap"><a href='tel:83933120140'>8 (383) 312-01-40</a></div>
						</div>
						<div class="contacts-items col-md-12 row-flex align-items-center nowrap">
							<div class="contacts-items-img"><?= Html::img('@web/images/phone.png') ?></div>
							<div class="contacts-items-content nowrap"><a href='tel:+79231837757'>+7-923-183-77-57</a></div>
						</div>
						<div class="contacts-items col-md-12 row-flex align-items-center nowrap">
							<div class="contacts-items-img"><?= Html::img('@web/images/phone.png') ?></div>
							<div class="contacts-items-content nowrap"><a href='tel:+79612232970'>+7-961-223-29-70</a></div>
						</div>
					</div>
					<div class="col-md-6 mb-10">
						<div class="col-md-12 contacts-list-title">Электронный адрес</div>
						<div class="contacts-items col-md-12 row-flex align-items-center nowrap">
							<div class="contacts-items-img"><?= Html::img('@web/images/email.png') ?></div>
							<div class="contacts-items-content wrap"><a href="mailto:nroo-mira@yandex.ru">nroo-mira@yandex.ru</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</article>