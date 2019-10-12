<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\PublicAsset;
use yii\web\JqueryAsset;
use app\models\User;
use app\models\Article;

Article::getIdWpUrl();

$visually = Yii::$app->request->cookies->getValue('visually');
$fontsize = Yii::$app->request->cookies->getValue('fontsize');
$scheme   = Yii::$app->request->cookies->getValue('scheme');
$images   = Yii::$app->request->cookies->getValue('images');

JqueryAsset::register($this);	//Регистрация jquery до PublicAsset
PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов">	
	<meta name="keywords" content="Мира, МиРа, НРОО, Кулекин, Кулекин Владимир Львович, организация инвалидов, защита инвалидов, социальные услуги, социальная доставка, доставка товаров, доставка продуктов, доставка лекарств, массаж, клининговые услуги, клининг, уборка, чистка, Новосибирск, мелкий ремонт, социальное такси, доброе">
		
	<link rel="shortcut icon" href="/images/logo-icon.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id='main'>
	<?php if(Yii::$app->controller->module->id == 'basic'): ?>
		<?= $this->render('/partials/visually'); ?>		
	<?php endif; ?>

	<div id="site" <?= $visually ? "class='$visually $fontsize $scheme $images'" : false ?>>
		<nav id="contacts" class="row-flex space-evenly flex-nowrap">
			<div class="div-contacts" id="contacts-address"><i class="fa fa-map-marker icon" aria-hidden="true"></i>Новосибирск, ул. Римского-Корсакова, 10</div>
			<div class="div-contacts" id="contacts-mail">
				<a href="mailto:nroo-mira@yandex.ru"><i class="fa fa-envelope icon" aria-hidden="true"></i>nroo-mira@yandex.ru</a>
			</div>
			<div class="div-contacts" id="contacts-phone">
					<a href="tel:83833120140"><i class="fa fa-phone icon" aria-hidden="true"></i>8 (383) 312-01-40</a>				
			</div>
			<div class="div-contacts" id="contacts-social">		
					<a href="https://vk.com/nroomira" target="_blank" title="Мы ВКонтакте"><i class="fa fa-vk icon" aria-hidden="true"></i></a>
					<a href="https://ok.ru/group/56793739755756" target="_blank" title="Мы в Одноклассниках">
						<i class="fa fa-odnoklassniki icon" aria-hidden="true"></i>
					</a>
					<a href="https://www.instagram.com/_mirasib/" target="_blank" title="Мы в Instgram"><i class="fa fa-instagram icon" aria-hidden="true"></i></a>
			</div>
		</nav>

		<div class="header header-intro header-new">
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container-fluid">
					<div class="menu-content">	
						<div class="navbar-header">						
							<button type="button" class="navbar-toggle collapsed toggle-button button-collapse" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="navbar-toggle collapsed visually-collapsed toggle-button visually-impaired"><i class="fa fa-eye" aria-hidden="true"></i></div>
							<!--a class="navbar-brand" href="/"><img src="/assets/site/public/images/logo.jpg" alt=""></a-->
						</div>				
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav text-uppercase menu-on-img col-md-12">                    
								<li><a href="/">Главная</a></li>
								<li><a href="/about">Об огранизации</a></li>
								<li><a href="/projects">Проекты</a></li>
								<li><a href="/feedback">Написать нам</a></li>
								<li><a href="/contacts">Контакты</a></li>
															
								<?php if(Yii::$app->user->isGuest): ?>
									<li class="float-right"><a href="/entry">Войти</a></li>
								<?php endif; if(!Yii::$app->user->isGuest):?>
									<li class="float-right"><?=Html::a("<i class='fa fa-sign-out'></i> Выйти", ['/auth/logout'], [
															'data' => ['method' => 'post'],
															'class' => 'white text-center',
														]) ?></li>
								<?php endif; ?>			
								
								<?php if(User::isAdmin()): ?>
									<li class="float-right"><a href="/admin/article">Администрирование</a></li>
								<?php endif; ?>
							</ul>						
						</div>				
					</div>
				</div>
			</nav>		
			<a href="/">
				<div id="organization-name">
					<div class="organization-logo"><img src="/web/images/logo-hand.png" class="logo"></div>
					<div class="organization-text"><p>Новосибирская региональная общественная организация <span class="nowrap">по защите</span> прав и законных интересов инвалидов "МиРа"</p></div>
				</div>
				<div id="header-bottom-bar"></div>
			</a>
		</div>
				
		<!--main content start-->
		<div class="main-content">
			<div class="container-fluid">
				<div class="row row-flex">
					<?php if(Yii::$app->controller->module->id == 'basic'): ?>
						<div class="col-md-2 data-sticky_column" id="leftsidebar">
							<?= $this->render('/partials/leftsidebar'); ?>
						</div>
						<div class="col-md-8" id="content"><?= $content; ?></div>			
						<div class="col-md-2 data-sticky_column" id="rightsidebar">
							<?= $this->render('/partials/rightsidebar'); ?>
						</div>
					<?php endif; ?>
					
					<?php if(Yii::$app->controller->module->id == 'admin'): ?>
						<div class="col-md-12"><?= $content; ?></div>							
					<?php  endif; ?>
				</div>
			</div>
		</div>
		<!-- end main content-->

		<!--footer start-->
		<footer class="footer-widget-section">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<aside class="footer-widget">
							<div class="widget-title">НРОО "МиРа"</div>
							<div class="about-content">Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов</div>
							<div class="address">
								<h4 class="text-uppercase">Контакты</h4>
								<p> ул Римского-Корсакова 10, первый этаж</p>
								<p> Телефоны: 8 (383) 312-01-40,<br/>+7-923-183-77-57, +7-961-223-29-70</p>
								<p>E-mail: nroo-mira@yandex.ru</p>
							</div>
						</aside>
					</div>

					<div class="col-md-4">
						<aside class="footer-widget">
							<h3 class="widget-title text-uppercase">Отзывы</h3>

							<div id="myCarousel" class="carousel slide" data-ride="carousel">
								<?php $review = Article::getReview(true); ?>
								<div class="carousel-inner1" role="listbox">
									<div class="item active">
										<div class="single-review">
											<div class="review-text">
												<p><?= $review['review'] ?></p>
											</div>
											<div class="author-id">
												<img src="/uploads/images/<?= $review['photo'] ?>" class="testimonials-photo" alt="">
												<div class="author-text">
													<h4><?= $review['author'] ?></h4>
													<h4><?= $review['description'] ?></h4>
												</div>
											</div>
										</div>
									</div>									
								</div>
							</div>

						</aside>
					</div>
					<div class="col-md-4">
						<aside class="footer-widget">
							<div class="widget-title">&copy; 2018-<?= date('Y'); ?> mira-sib.ru</div>
							<div class="about-content">Все материалы и цены, размещенные на сайте, носят справочный характер и не являются ни публичной офертой, ни рекламой. Используя сайт, вы даете согласие на обработку персональных данных и соглашаетесь c <?= Html::a('политикой конфиденциальности', ['site/privacy'], ['target' => '_blank', 'class' => 'footer-link']) ?> и <?= Html::a('политикой использования файлов Cookies', ['site/cookies'], ['target' => '_blank', 'class' => 'footer-link']) ?></div>
						</aside>
					</div>
				</div>
			</div>			
		</footer>
	</div>
</div>

<?php if (strpos($_SERVER["HTTP_HOST"],"mira-sib.ru") !== false): ?>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	   ym(55533865, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true
	   });
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/55533865" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
