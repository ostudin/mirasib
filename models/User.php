<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
	public $newPassword, $newPasswordRepeat;
	
	public function rules()
	{
		return [			
			[['fullname'], 'string', 'length' => [0, 255]],
			['newPassword', 'string', 'min' => 5, 'max' => 16],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
		];
	}
	
	public function validatePassword($password)
	{
		return $this->password === md5($password);
	}
			
	public static function findIdentity($id)
	{
		return self::findOne($id);
	}
	
	public static function findIdentityProfile($id)
	{
		$user = self::findOne($id);
		if(!$user['fullname']) $user['fullname'] = $user['name'];
		return $user;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public static function findIdentityByAccessToken($token, $type = NULL)
	{
		
	}
		
	public function getAuthKey()
	{
		
	}
	
	public function validateAuthKey($authKey)
	{
		
	}
	
	public function saveFromVk($uid, $first_name, $last_name, $photo)
	{
		$user = User::findOne(['vk_id' => $uid]);
		
		if($user)
		{
			return Yii::$app->user->login($user);
		}
		
		$this->vk_id    = $uid;
		$this->name     = $first_name;
		$this->fullname = $first_name . ' ' . $last_name;		
		$this->password = false;
		
		if(!strpos($photo, '.png')) $this->photo = $photo;
		
		$this->save(false);
		
		return Yii::$app->user->login($this);
	}
	
	public function isAdmin()
	{
		if(!Yii::$app->user->isGuest)
		{			
			return Yii::$app->user->identity->isAdmin;
		}
		
		return false;
	}
	
	public function getUserName()
	{
		$name = false;		
		$user = Yii::$app->user->identity->attributes;
						
		if(isset($user['name']) || isset($user['fullname']))
		{
			$name = $user['fullname'] ? $user['fullname'] : $user['name'];
		}
		
		return $name;
	}
	
	public function getUserPhoto()
	{
		$photo = false;		
		$user  = Yii::$app->user->identity->attributes;
						
		if(isset($user['photo']))
		{
			if(strpos($user['photo'], 'http') !== false)
			{
				$photo = $user['photo'];
			}
			
			if(file_exists(Yii::getAlias('@web') . "uploads/images/" . $user['photo']))
			{
				$photo = '/uploads/images/' . $user['photo'];
			}
		}
		
		return $photo;
	}
	
	public function userSave($post)
	{
		if(isset($post['fullname'])) 
		{
			$this->fullname = $post['fullname'];
			
			if($this->validate())
			{
				$this->save(false);
			}
		}
	}
	
	
	public function setPassword($post)
	{
		if(strlen($post['newPassword']) >= 5)
		{
			$this->newPassword       = $post['newPassword'];
			$this->newPasswordRepeat = $post['newPasswordRepeat'];
			
			if($this->validate())
			{
				$this->password = md5($this->newPassword);
				$this->save();
			}
		}
	}
}
