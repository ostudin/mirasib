<?php
	$this->title = 'Полезные ссылки';
?>

<article class="post">                    
	<div class="post-content">
		<header class="entry-header text-center text-uppercase">                            
			<h1 class="entry-title"><?= $this->title; ?></h1>
		</header>
		<div class="entry-content">
			<?php if(count($links)): ?>
				<?php foreach($links as $item): ?>
					<div class='links-level'>
						<h2 class='ml-25'><?= $item['title'] ?></h2>
						<?php if(count($item['data'])): ?>
							<?php foreach($item['data'] as $data): ?>
								<div class='links-organization'>
									<div class='links-title'>
										<a href='<?= $data['link'] ?>' target='_blank' class='links-title-img'>
											<img src='/images-linkspage/<?= $data['pic'] ?>' alt='<?= $data['title'] ?>' title='<?= $data['title'] ?>' />
										</a>
										<a href='<?= $data['link'] ?>' target='_blank' class='links-title-text'><h4><?= $data['title'] ?></h4></a>
									</div>
									<?php if(count($data['contacts'])): ?>
										<div class="row-flex col-md-12">
											<?php foreach($data['contacts'] as $contact): ?>
												<div class='links-contacts col-md-6'><?= $contact['href'] ?></div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>			
		</div>

		<div class="social-share">			
			<?= $this->render('/partials/socialshare', ['image' => false, 'title' => 'Полезные ссылки']); ?>			
		</div>
		
	</div>
</article>