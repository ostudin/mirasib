<?php
namespace app\models;
use yii\base\Model;
use Yii;
use app\models\FileUpload;

/* Загрузка аудио */
class AudioUpload extends Model {
	
	public $audio;
	
	public function rules()
	{
		return [
			[['audio'], 'required'],
			[['audio'], 'file', 'extensions' => 'mp3, ogg', 'checkExtensionByMimeType' => false],
		];
	}
	
	public function uploadFile($file, $currentFile)
	{		
		$this->audio = $file;
		
		if($this->validate())
		{
			$fileUpload = new FileUpload();
						
			return $fileUpload->upload('audio', $file, $currentFile);			
		}
		
		return false;
	}	
}