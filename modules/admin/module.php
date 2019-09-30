<?php
namespace app\modules\admin;

use yii\filters\AccessControl;
use Yii;

class module extends \yii\base\Module
{    
    public $controllerNamespace = 'app\modules\admin\controllers';
    
    public function init()
    {
        parent::init();
    }
	
	/*Поведение*/
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'denyCallback' => function($rule, $action){
					throw new \yii\web\NotFoundHttpException();
				},
				'rules' => [
					[
						'allow' => true,
						'matchCallback' => function($rule, $action){
							if (Yii::$app->user->isGuest) 
							{
								throw new \yii\web\NotFoundHttpException();
							}
							
							return Yii::$app->user->identity->isAdmin;
						}
					]
				],
			],
		];
	}
}
