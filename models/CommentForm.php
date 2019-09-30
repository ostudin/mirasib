<?php

namespace app\models;

use yii\base\Model;
use Yii;
use app\models\Comment;

class CommentForm extends Model
{	
	public $comment;
	
	public function rules()
	{
		return [
			[['comment'], 'required'],
			[['comment'], 'string', 'length' => [3, 8192]],
		];
	}
		
	public function getComments($id)
	{
		$array = Yii::$app->db->createCommand("SELECT * FROM comment WHERE article_id=$id ORDER BY date DESC, id DESC")->queryAll();
		
		foreach($array as &$item)
		{								
			$item['name'] = self::getUseName($item['user_id']);
			$item['photo'] = self::getUserPhoto($item['user_id']);						
		}
				
		return $array;
	}
	
	public function saveComment($article_id)
	{
		if($this->validate())
		{
			$comment = new Comment;
			$comment->text = $this->comment;
			$comment->user_id = Yii::$app->user->id;
			$comment->article_id = $article_id;
			$comment->date = date("Y-m-d");
			
			return $comment->save();
		}
		return false;
	}
	
	public function answer($uid)
	{
		if ($name = self::getUseName($uid))
		{
			$this->comment = $name . ', ';
		}
	}
	
	private function getUseName($uid)
	{
		$name = false;
		
		$user = Yii::$app->db->createCommand("SELECT name, fullname FROM user WHERE id=$uid")->queryOne();
		
		if($user) $name = "Пользователь $uid";
		
		if(isset($user['name']) || isset($user['fullname']))
		{
			$name = $user['fullname'] ? $user['fullname'] : $user['name'];
		}
		
		return $name;
	}
	
	private function getUserPhoto($uid)
	{
		$user = Yii::$app->db->createCommand("SELECT photo FROM user WHERE id=$uid")->queryOne();
		
		$photo = $user['photo'] ? $user['photo'] : '/images/no-user.png';
		
		if($user['photo'] && strpos($user['photo'], 'http') === false)
		{
			if(file_exists(Yii::getAlias('@web') . "uploads/images/" . $user['photo']))
			{
				$photo = '/uploads/images/' . $user['photo'];
			}
				
			else $photo = '/images/no-user.png';
		}
		
		return $photo;
	}
}