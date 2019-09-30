<?php
namespace app\models;
use yii\base\Model;
use Yii;
use app\models\FileUpload;

class ImageUpload extends Model {
	
	public $image;
	
	public function rules()
	{
		return [
			[['image'], 'required'],
			[['image'], 'file', 'extensions' => 'jpg,jpeg,png'],
		];
	}
	
	public function uploadFile($file, $currentImage)
	{		
		$this->image = $file;
		
		if($this->validate())
		{
			$fileUpload = new FileUpload();
						
			return $fileUpload->upload('images', $file, $currentImage);			
		}
		
		return false;
	}	
}