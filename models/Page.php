<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Article;

class Page extends Model
{		
	public function getMiraLinks()
	{
		$links = [];
		
		$links['federal'] = self::getLinks('federal', 'Федеральные интернет-ресурсы');
		$links['nso']     = self::getLinks('nso', 'Интернет-ресурсы НСО');
		$links['nsk']     = self::getLinks('nsk', 'Интернет-ресурсы Новосибирска');
		
		return $links;
	}
	
	public function getMiraDoc()
	{
		$doc = [];
		
		$doc['international'] = self::getDoc('international', 'Международные правовые акты');
		$doc['fz']            = self::getDoc('fz', 'Федеральные законы');
		$doc['up']            = self::getDoc('up', 'Указы Президента Российской Федерации');
		$doc['pprf']          = self::getDoc('pprf', 'Постанвления правительства Российской Федерации');
		
		return $doc;
	}
	
	public function getMiraFaq()
	{
		$faq = [];
		
		$faq[1] = self::getFaq('Установление инвалидности', 1);
		$faq[2] = self::getFaq('Доступная среда', 2);
		$faq[3] = self::getFaq('Образование', 3);
		$faq[4] = self::getFaq('Право на труд', 4);
		$faq[5] = self::getFaq('Реабилитация и социальная помощь', 5);
		$faq[6] = self::getFaq('Пенсии и пособия', 6);
		$faq[7] = self::getFaq('Жилищные права, льготы по оплате услуг ЖКХ', 7);
		$faq[8] = self::getFaq('Защита своих прав', 8);
		
		return $faq;
	}
	
	private function getLinks($level, $title)
	{
		$array = [];
		$links = Yii::$app->db->createCommand("SELECT * FROM mira_links WHERE level = '$level'")->queryAll();
		
		if(count($links))
		{
			foreach ($links as &$link)
			{		
				$id = intval($link['id']);
				$link['contacts'] = Yii::$app->db->createCommand("SELECT * FROM mira_links_contacts WHERE linkID = $id")->queryAll();
				
				if(count($link['contacts']))
				{
					foreach($link['contacts'] as &$contact)
					{
						$contact['href'] = self::linksRender($contact);
					}
				}
			}
			
			$array['data']  = $links;
			$array['title'] = $title;
			
			return $array;
		}
		
		return false;	
	}
	

	private function linksRender($contact)
	{ 
		$title = $contact['title'];
		$type  = $contact['type'];
		$value = $contact['value'];
		
		switch($type)
		{
			case 'tel':
				$title = $title ? $title."<br/>" : false;
				$title = "$title<i class='fa fa-phone' aria-hidden='true'></i>&nbsp&nbsp$value";
				$value = preg_replace("/[^,.0-9]/", '', $value);
				$value = "tel:$value";
				break;
			case 'ok': $title = "<i class='fa fa-odnoklassniki' aria-hidden='true'></i>&nbsp&nbsp$title"; break;
			case 'vk': $title = "<i class='fa fa-vk' aria-hidden='true'></i>&nbsp&nbsp$title"; break;
			case 'mail': 
				$title = $title ? $title."<br/>" : false;
				$title = "$title<i class='fa fa-envelope' aria-hidden='true'></i>&nbsp&nbsp$value";
				$value = "mailto:$value";
				break;
		}
		
		return "<a href='$value' class='links-contacts-item links-$type' target='_blank'><div class='links-contacts-item-table'><div>$title</div></div></a>";
	}
	
	private function getDoc($level, $title)
	{
		$array = [];
		$doc = Yii::$app->db->createCommand("SELECT * FROM mira_doc WHERE level = '$level'")->queryAll();
		
		if(count($doc))
		{
			foreach($doc as &$item)
			{
				$icon = self::getIcon($item['file']);		
				$item['icon'] = $icon ? "<img src='/images/$icon' alt='' title='Скачать' />" : false;						
			}
		}
		
		$array['data']  = $doc;
		$array['title'] = $title;
			
		return $array;
	}
	
	private function getIcon ($doc)
	{
		if (strpos($doc, '.pdf')) return 'pdf.png';
			
		return false;
	}
	
	private function getFaq($title, $category)
	{
		$array = [];
		$faq = Yii::$app->db->createCommand("SELECT * FROM mira_faq WHERE category = $category")->queryAll();		
				
		if(count($faq))
		{					
			foreach ($faq as &$item)
			{					
				$item['answer'] = nl2br($item['answer']);				
			}			
		}
		
		$array['data']  = $faq;
		$array['title'] = $title;
			
		return $array;
	}
	
	public function setMetaTags($array)
	{
		Yii::$app->view->registerMetaTag([
			'name' => 'description',
			'content' => isset($array['description']) ? $array['description'] : (isset($array['title']) ? $array['title'] : 'НРОО "МиРа"'),
		]);
		
		Yii::$app->view->registerMetaTag([
			'property' => 'og:locale',
			'content' => 'ru_RU',
		]);
		
		Yii::$app->view->registerMetaTag([
			'property' => 'og:type',
			'content' => 'article',
		]);
		
		Yii::$app->view->registerMetaTag([
			'property' => 'og:title',
			'content' => isset($array['title']) ? $array['title'] : 'НРОО "МиРа"',
		]);
		
		Yii::$app->view->registerMetaTag([
			'property' => 'og:description',
			'content' => isset($array['description']) ? $array['description'] : (isset($array['title']) ? $array['title'] : 'НРОО "МиРа"'),
		]);
		
		Yii::$app->view->registerMetaTag([
			'property' => 'og:url',
			'content' => Yii::$app->request->hostInfo . Yii::$app->request->url,
		]);
		
		Yii::$app->view->registerMetaTag([
			'property' => 'og:site_name',
			'content' => 'НРОО "МиРа"',
		]);
		
		if(isset($array['section']))
		{
			Yii::$app->view->registerMetaTag([
				'property' => 'article:section',
				'content' => $array['section'],
			]);
		}
		
		if(isset($array['image']))
		{
			Yii::$app->view->registerMetaTag([
				'property' => 'og:image',
				'content' => Yii::$app->request->hostInfo . $array['image'],
			]);
			
			Yii::$app->view->registerMetaTag([
				'property' => 'og:image:secure_url',
				'content' => Yii::$app->request->hostInfo . $array['image'],
			]);
		}		
	}
	
	public function getVisitors()
	{				
		$date = date('Y-m-d', time() - 60*60*24);
		
		$visitors = Yii::$app->db->createCommand("SELECT yesterday, week, month FROM visitors WHERE date = '$date'")->queryOne();
		
		if(count($visitors) <= 1)
		{
			$visitors = self::getYandexMetrika();
			
			$yesterday = isset($visitors['yesterday']) ? $visitors['yesterday'] : 0;
			$month     = isset($visitors['month'])     ? $visitors['month']     : 0;
			$week      = isset($visitors['week'])      ? $visitors['week']      : 0;
						
			$params = ['yesterday' => $yesterday, 'week' => $week, 'month' => $month, 'date' => $date];			
			Yii::$app->db->createCommand('INSERT INTO visitors (yesterday, week, month, date) VALUES(:yesterday, :week, :month, :date)', $params)->execute();
		}
		
		return $visitors;
	}
	
	private function getYandexMetrika()
	{
		$array = [];
		
		$yandexID    = '55533865';
		$yandexToken = 'AgAEA7qiFI7AAAX4vfaW9kK4cUjUnOfmRBsF2wE';
		$url         = 'https://api-metrika.yandex.ru/stat/v1/data.json';
				
		$params = [
			'ids'         => $yandexID,
			'oauth_token' => $yandexToken,			
			'metrics'     => 'ym:s:visits',
			'dimensions'  => 'ym:s:date',
			'date1'       => '30daysAgo',
			'date2'       => 'yesterday',
			'sort'        => 'ym:s:date',
		];

		$metrics = file_get_contents($url . '?' . http_build_query($params));
		
		if($metrics)
		{
			$metrics = json_decode($metrics, JSON_OBJECT_AS_ARRAY);
			
			if(count($metrics['data']))
			{
				if(isset($metrics['data'][29]['metrics'][0]))
				{
					$array['yesterday'] = $metrics['data'][29]['metrics'][0];
				}
				
				$array['week'] = 0;
				
				for($i=29; $i>=23; $i--)
				{
					if(isset($metrics['data'][$i]['metrics'][0]))
					{
						$array['week'] += $metrics['data'][$i]['metrics'][0];
					}
				}				
			}
			
			if(isset($metrics['totals'][0])) $array['month'] = $metrics['totals'][0];
		}
		
		return $array;		
	}
}