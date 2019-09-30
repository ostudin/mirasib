<?php 
	use yii\helpers\Html;

	$visually = Yii::$app->request->cookies->getValue('visually');
	$pic_directory = '/assets/site/module/visually-impaired/pic/';
	
	$font1 = !Yii::$app->request->cookies->getValue('fontsize') ? 'f1_active.png' : 'f1.png';
	$font2 = Yii::$app->request->cookies->getValue('fontsize') === 'fontsize-large'   ? 'f2_active.png' : 'f2.png';
	$font3 = Yii::$app->request->cookies->getValue('fontsize') === 'fontsize-largest' ? 'f3_active.png' : 'f3.png';
		
	$scheme1 = Yii::$app->request->cookies->getValue('scheme') === 'scheme-white' ? 'a1_active.png' : 'a1.png';
	$scheme2 = Yii::$app->request->cookies->getValue('scheme') === 'scheme-black' ? 'a2_active.png' : 'a2.png';
	$scheme3 = Yii::$app->request->cookies->getValue('scheme') === 'scheme-blue' ? 'a3_active.png' : 'a3.png';	
	
	$image1 = !Yii::$app->request->cookies->getValue('images') ? 'c1_active.png' : 'c1.png';
	$image2 = Yii::$app->request->cookies->getValue('images') === 'images-black-white' ? 'c2_active.png' : 'c2.png';
	$image3 = Yii::$app->request->cookies->getValue('images') === 'images-none' ? 'c3_active.png' : 'c3.png';
?>

<nav id ="visually-panel-nav" class="navbar visually-panel-nav <?= $visually ? "panel-nav-$visually-mode" : false ?>">
	<div class="col-md-12 row-flex space-evenly visually-panel">
		<div class="visually-panel-block">
			<div class="title">Размер шрифта: </div>
			<ul class="visually-ul">
				<li id="fontsize-normal"><?= Html::img($pic_directory . $font1, ['title' => 'Нормальный размер шрифта', 'id' => 'fontsize-normal-pic']) ?></li>
				<li id="fontsize-large"><?= Html::img($pic_directory . $font2, ['title' => 'Увеличенный размер шрифта', 'id' => 'fontsize-large-pic']) ?></li>
				<li id="fontsize-largest"><?= Html::img($pic_directory . $font3, ['title' => 'Максимальный шрифта', 'id' => 'fontsize-largest-pic']) ?></li>
			</ul>
		</div>
		<div class="visually-panel-block">
			<div class="title">Цвет сайта: </div>
			<ul class="visually-ul">
				<li id="scheme-white">
					<?= Html::img($pic_directory . $scheme1, ['title' => 'Цветовая схема: черный текст, белый фон', 'id' => 'scheme-white-pic']) ?>
				</li>
				<li id="scheme-black">
					<?= Html::img($pic_directory . $scheme2, ['title' => 'Цветовая схема: белый текст, черный фон', 'id' => 'scheme-black-pic']) ?>
				</li>
				<li id="scheme-blue">
					<?= Html::img($pic_directory . $scheme3, ['title' => 'Цветовая схема: темно-синий текст, голубой фон', 'id' => 'scheme-blue-pic']) ?>
				</li>
			</ul>
		</div>
		<div class="visually-panel-block">
			<div class="title">Изображения: </div>
			<ul class="visually-ul">
				<li id="images-color">
					<?= Html::img($pic_directory . $image1, ['title' => 'Цветные изображения', 'id' => 'images-color-pic']) ?>
				</li>
				<li id="images-black-white">
					<?= Html::img($pic_directory . $image2, ['title' => 'Чёрно-белые изображения', 'id' => 'images-black-white-pic']) ?>
				</li>
				<li id="images-none">
					<?= Html::img($pic_directory . $image3, ['title' => 'Отключить изображения', 'id' => 'images-none-pic']) ?>
				</li>
			</ul>
		</div>
		<div class="visually-panel-block visually-normal-button">
		<div class="title">Обычный режим: </div>
			<ul class="visually-ul">				
				<li id="close"><?= Html::img($pic_directory . 'close.png', ['title' => 'Обычный режим']) ?></li>
			</ul>
		</div>
	</div>
</nav>