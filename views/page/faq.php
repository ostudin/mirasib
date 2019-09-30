<?php
	$this->title = 'Права инвалидов в вапросах и ответах';
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
								<details><summary class='p-10'><?= $data['question'] ?></summary><p class='padding-10'><?= $data['answer'] ?></p></details>
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