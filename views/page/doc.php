<?php
	$this->title = 'Нормативно-правовые акты';
?>

<article class="post">                    
	<div class="post-content">
		<header class="entry-header text-center text-uppercase">                            
			<h1 class="entry-title"><?= $this->title; ?></h1>
		</header>
		<div class="entry-content">
			<?php if(count($doc)): ?>
				<?php foreach($doc as $item): ?>
					<div class='links-level'>
						<h2><?= $item['title'] ?></h2>
						<?php if(count($item['data'])): ?>
							<table class="doc">
							<?php foreach($item['data'] as $data): ?>
								<tr>
									<td><p class="doc-title"><?= $data['title'] ?></p><p class="doc-content"><?= $data['description'] ?></p></td>
									<td style='width: 15%;'><a href="/doc/<?= $data['file'] ?>" target='_blank'><?=$data['icon'] ?><span>&nbsp;Скачать</span></a></td>
								</tr>
							<?php endforeach; ?>
							</table>
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