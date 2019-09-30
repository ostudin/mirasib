<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;
 
/**
 * Signup form
 */
class Signup extends Model
{ 
    public $name;
    public $email;
    public $password;
	//public $verifyCode;
	
    public function rules()
	{
		return [
			[['password', 'name'], 'required', 'message'=>'Необходимо заполнить поле'],
			['email', 'email'],
			['email', 'unique', 'targetClass' => 'app\models\User'],
			['name', 'unique', 'targetClass' => 'app\models\User'],
			['password', 'string', 'min' => 5, 'max' => 16],			
			//['verifyCode', 'captcha', 'captchaAction'=>'/site/captcha']		
		];
	}
	
	public function signup()
	{
		if(!$this->validate()) return false;
		
		$this->writeBase();	
		
		return true;		
	}
	
	private function writeBase()
	{						
		Yii::$app->db->createCommand("INSERT INTO user (name, email, password)
									VALUES ('".$this->name."', '".$this->email."', '".md5($this->password)."')")->execute();
	}
}
