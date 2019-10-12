<?php
	use yii\helpers\Html;
	use app\models\Page;
	
	$this->title = 'Ошибка 404';
	
	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			//'section'     => 'Контакты',
			'image'       => '/web/images/nroo-mira.jpg',
		]);

	
?>

<article class="post"> 
	<section class="error-404 not-found text-center">
		<h1 class="404">404</h1>

		<p class="lead">Страница не найдена!</p>

		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<!--form role="search" method="get" id="searchform" action="#">
					<div>
						<input type="text" placeholder="Search and hit enter..." name="s" id="s"/>
					</div>
				</form-->
				<p class="go-back-home col-sm-12"><a href="/">Вернуться на главную</a></p>
			</div>
		</div>

	</section><!-- .error-404 -->
</article> 
                   