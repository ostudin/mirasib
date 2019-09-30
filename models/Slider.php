<?php
namespace app\models;

use yii;	
use yii\base\Model;
use yii\helpers\FileHelper;

class Slider extends Model
{
	public function getImages($dir = 'images-slider')
	{		
		$array = array();
				
		$files=\yii\helpers\FileHelper::findFiles("$dir");		
		
		$count = 0;
		
		foreach($files as $file)
		{
			if(strpos(strtolower($file), '.jpg') || strpos(strtolower($file), '.png'))
			{
				$array['images'][$count] = basename($file);
				$count++;
			}
		}
						
		return $array;
	}
}
