<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class VisuallyController extends Controller {
		
	public function actionVisually()
    {
		$post = Yii::$app->request->post('visually');
		
		if($post === '1')
		{ 			
			$cookies = Yii::$app->response->cookies;
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'visually',
				'value' => 'visually',				
			]));			
		}
		
		if($post === '0')
		{
			Yii::$app->response->cookies->remove('visually');
			Yii::$app->response->cookies->remove('fontsize');
			Yii::$app->response->cookies->remove('scheme');
			Yii::$app->response->cookies->remove('images');
		}
	}
	
	public function actionFontsize()
	{
		$post = Yii::$app->request->post('fontsize');
		
		if($post === 'fontsize-normal' && Yii::$app->request->cookies->getValue('fontsize'))
		{
			Yii::$app->response->cookies->remove('fontsize');
		}
		
		if($post !== 'fontsize-normal')
		{
			$cookies = Yii::$app->response->cookies;
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'fontsize',
				'value' => $post,
			]));
		}
	}
	
	public function actionScheme()
	{				
		if($post = Yii::$app->request->post('scheme'))
		{
			$cookies = Yii::$app->response->cookies;
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'scheme',
				'value' => $post,
			]));
		}
	}
	
	public function actionImages()
	{
		$post = Yii::$app->request->post('images');
		
		if($post === 'images-color' && Yii::$app->request->cookies->getValue('images'))
		{
			Yii::$app->response->cookies->remove('images');
		}
		
		if($post !== 'images-color')
		{
			$cookies = Yii::$app->response->cookies;
			
			$cookies->add(new \yii\web\Cookie([
				'name' => 'images',
				'value' => $post,
			]));
		}
	}
}