<?php
namespace app\models;

use yii\base\Model;

class Login extends Model
{
	public $username;
	public $password;
	public $verifyCode;
	
	public function rules()
	{
		return [
			[['password', 'username'], 'required', 'message'=>'Необходимо заполнить поле'],
			['password', 'validatePassword'],	//Собственная функция для валидации пароля
			/*['verifyCode', 'captcha', 'captchaAction'=>'/site/captcha']	*/
		];
	}
	
	public function validatePassword($attribute, $params)
	{
		if(!$this->hasErrors()) //Если нет ошибок
		{
			$user = $this->getUser();
								
			if(!$user || !$user->validatePassword($this->password))
			{
				//Пользователь не найден или  введённый Пароль не совпадает с паролем из базы
				
				$this->addError($attribute, 'Логин или пароль введены неверно!');
			}
		}
	}
	
	//Получение пользователя по логину
	public function getUser()
	{
		return User::findOne(['name' => $this->username]);
	}
}
