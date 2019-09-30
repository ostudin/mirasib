<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Article;

class Search extends Model
{	
	public $search;
	
	public function rules()
	{
		return [			
			[['search'], 'string', 'length' => [3, 64]],
		];
	}
		
	public function articleFind($string)
	{
		$string = str_replace(' ', '%', $string);
						
		$articles = Article::find()->filterWhere([
			'or',
			['like', 'title', $string],
			['like', 'description', $string],
			['like', 'content', $string],
		])->orderBy(['date' => SORT_DESC]);
		
		return $articles;
	}
}