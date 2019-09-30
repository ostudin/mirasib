<?php
	$image = $image ? "&image=" . Yii::$app->request->hostInfo . $image : false; 
?>

<ul class="text-center pull-right">
	<li>
		<a class="s-vk" href="http://vk.com/share.php?url=<?= Yii::$app->request->absoluteUrl ?>&title=<?= urlencode($title) ?><?= $image ?>"
				target="_blank" title="ВКонтакте">
			<i class="fa fa-vk"></i>
		</a>
	</li>
	<li>
		<a class="s-ok" href="https://connect.ok.ru/offer?url=<?= Yii::$app->request->absoluteUrl ?>&title=<?= urlencode($title) ?>"
				target="_blank" title="Одноклассники">
			<i class="fa fa-odnoklassniki"></i>
		</a>
	</li>				
	<li>
		<a class="s-whatsapp" href="https://api.whatsapp.com/send?text=<?= Yii::$app->request->absoluteUrl ?>" target="_blank" title="WhatsApp">
			<i class="fa fa-whatsapp"></i>
		</a>
	</li>
</ul>