<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
//use app\models\LoginForm;

use app\models\Signup;
use app\models\Login;
use app\models\User;

class AuthController extends Controller {
		
	public function actionEntry()
    {		
		if(!Yii::$app->user->isGuest)
		{
			 return $this->goHome();
		}
		
		$login_model = new Login();
		
		if($post = Yii::$app->request->post('Login'))
		{
			$login_model->attributes = $post;
			
			if($login_model->validate())
			{
				Yii::$app->user->login($login_model->getUser());
												
				return $this->goHome();
			}
		}
		
		return $this->render('/auth/login', ['login_model' => $login_model]);
    }
	
    public function actionLogout()
    {		
		if(!Yii::$app->user->isGuest)
		{
			Yii::$app->user->logout();
		}

        return $this->redirect(['/auth/entry']);
    }
	
	public function actionSignup()
	{
		$model = new Signup();
				
		$post = Yii::$app->request->post();
						
		if($post)
		{
			if($model->load($post) && $model->signup())
			{				
				return $this->redirect(['/auth/entry']);
			}						
		}		
		
        return $this->render('/auth/signup', ['model' => $model]);
	}
	
	public function actionLoginVk($uid, $first_name, $last_name, $photo)
	{
		$user = new User();
		
		if($user->saveFromVk($uid, $first_name, $last_name, $photo))
		{
			return $this->redirect('/');
		}		
	}
	
	public function actionProfile()
	{
		if(!Yii::$app->user->isGuest)
		{
			$id = Yii::$app->user->identity->attributes['id'];
			$user = User::findIdentityProfile($id);	
											
			if($post = Yii::$app->request->post('User'))
			{			
				$user->userSave($post);
			}
			
			return $this->render('/auth/profile', compact('user'));
		}
		
		return $this->redirect(['/auth/entry']);
	}
	
	public function actionSetpassword()
	{
		if(!Yii::$app->user->isGuest)
		{			
			$id = Yii::$app->user->identity->attributes['id'];
			$user = User::findIdentityProfile($id);	
						
			if($post = Yii::$app->request->post('User'))
			{			
				$user->setPassword($post);
			}
			
			return $this->render('/auth/setpassword', compact('user'));
		}
		
		return $this->redirect(['/auth/entry']);
	}
}