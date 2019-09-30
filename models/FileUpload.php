<?php

namespace app\models;
use yii\base\Model;
use Yii;

/* Загрузка файлов */
class FileUpload extends Model {
	
	public $path;
	private $file;
	
	public function upload($path, $file, $currentFile = false)
	{
		$this->path = $path;
		$this->file = $file;
		
		if($currentFile) 
		{
			$this->deleteFile($currentFile);
		}
		
		return $this->saveFile();
	}
	
	public function deleteFile($currentFile, $path = false)
	{
		if($path)
		{
			$this->path = $path;
		}
		
		if($this->fileExists($currentFile))
		{
			unlink($this->getFolder() . $currentFile);
		}
	}
	
	public function getFolder($path = false)
	{
		if ($path)
		{
			return Yii::getAlias('@web') . "uploads/$path/";
		}
		
		return Yii::getAlias('@web') . "uploads/" . $this->path . "/";
	}
	
	private function fileExists($currentFile)
	{
		if(!empty($currentFile) && $currentFile != null)
		{
			return file_exists($this->getFolder() . $currentFile);
		}
		
		return false;
	}
	
	private function saveFile()
	{
		$filename = $this->generateFilename();			
		$this->file->saveAs($this->getFolder() . $filename);
		
		return $filename;
	}
	
	private function generateFilename()
	{
		return strtolower(md5(uniqid($this->file->basename)) . '.' . $this->file->extension);
	}
}