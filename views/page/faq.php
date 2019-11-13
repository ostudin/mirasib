<?php
	use app\models\Page;
	
	$this->title = 'Права инвалидов в вопросах и ответах';
	Page::setMetaTags([
			'title'       => $this->title,
			'description' => 'Новосибирская региональная общественная организация по защите прав и законных интересов инвалидов "МиРа"',
			'section'     => 'Первая помощь',
			'image'       => '/web/images/nroo-mira.jpg',
		]);	
	
	
?>

<article class="post">                    
	<div class="post-content">
		<header class="entry-header text-center text-uppercase">                            
			<h1 class="entry-title"><?= $this->title; ?></h1>
		</header>
		<div class="entry-content">
			<?php if(count($faq)): ?>
				<div class='padding-10 alert alert-info'>
					При создании раздела использованы материалы сайта <a href='http://www.rusichi-center.ru/' target='_blank'>РООИ «РУСИЧИ-ЦЕНТР»</a>
				</div>
				<?php foreach($faq as $item): ?>
					<div class='links-level'>
						<h2><?= $item['title'] ?></h2>
						<?php if(count($item['data'])): ?>
							<?php foreach($item['data'] as $data): ?>
								<details class="details">
									<summary class='summary'><span class='span-summary'><?= $data['question'] ?></span></summary>
									<p class='p-details'><?= $data['answer'] ?></p>
								</details>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>			
		</div>

		<div class="social-share">			
			<?= $this->render('/partials/socialshare', ['image' => false, 'title' => $this->title]); ?>			
		</div>
		
	</div>
</article>