<?php
namespace app\models;
use yii\base\Model;
use Yii;

class Feedback extends Model
{
	public $name;
	//public $phone;
	public $email;
	//public $verifyCode;	
	public $message;
	private $ip, $httpReferer;
	
	public function rules()
    {	
		return [
			['name', 'required', 'message'=>'Необходимо заполнить поле'],
			['email', 'required', 'message'=>'Необходимо заполнить поле'],
			['message', 'required', 'message'=>'Необходимо заполнить поле'],
			['email', 'email'],
			//['verifyCode', 'captcha', 'captchaAction'=>'/site/captcha']
		];
    }	
		
	public function sendmail2($post)
	{
		if(!$this->validate()) return false;
		
		$this->feedbackInit($post);	
		
		//if(!strpos($this->phone, ' ')) return false;
				
		$from = self::routeFrom();
		
		$to = ['ivan@ivoron.ru'];
		
		$userMail = strlen($this->email)>0 ? $this->email : "не указан";
		$date = date('d.m.Y H:i');
		
		$subject = 'НРОО МиРа';
		$message = "Сообщение с сайта\n\nИмя: ".$this->name."\nE-mail: $userMail\n\n".$this->message."\n\n$date";
		$headers =    
			'From: ' . $from . "\r\n" .
			'Reply-To: ' . $from . "\r\n" .
			'X-Mailer: PHP/sendmail';

		if(ini_get('sendmail_path'))
		{
			foreach ($to as $item)
			{
				mail($item, $subject, $message, $headers);
			}
		}
			
		$this->writeBase();		
		$this->clearFields();
				
		return true;	
	}
	
	private function feedbackInit($post)
	{
		if(!$this->name && isset($post["Feedback"]['name']))
			$this->name = htmlspecialchars($post["Feedback"]["name"]);
		
		/* if(!$this->phone && isset($post["Feedback"]['phone']))
			$this->phone = $post["Feedback"]["phone"]; */
		
		if(!$this->email && isset($post["Feedback"]['email']))
			$this->email = $post["Feedback"]["email"];
		
		if(!$this->message && isset($post["Feedback"]['message']))
			$this->message = htmlspecialchars($post["Feedback"]["message"]);
						
		$this->ip = $_SERVER['REMOTE_ADDR'];	
		$this->httpReferer = $_SERVER['HTTP_REFERER'];	
	}
	
	private function writeBase()
	{		
		$time = time();
						
		Yii::$app->db->createCommand("INSERT INTO feedback (ip, time, name, mail, message, referer)
									VALUES ('".$this->ip."', $time, '".$this->name."', '".$this->email."', 
											'".$this->message."', '".$this->httpReferer."' )")->execute();
	}
	
	private function clearFields()
	{
		$this->name = false;
		//$this->phone = false;
		$this->email = false;
		$this->message = false;
	}
	
	private function routeFrom()
	{
		$host = Yii::$app->request->hostInfo;
		
		if(strpos($host, '.local')) return 'ivan@ivoron.ru';
		if(strpos($host, 'ivoron.ru')) return 'ivan@ivoron.ru';
		
		return 'feedback@mira-sib.ru';
	}
}
?>