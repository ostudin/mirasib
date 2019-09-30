<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\FileUpload;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int $article_id
 * @property string $file
 * @property string $title
 */
 
/* Изображения в статье */
class Image extends \yii\db\ActiveRecord
{
	public $image, $text;
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'file'], 'required'],
            [['article_id'], 'integer'],
            [['file', 'title'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'file' => 'File',
            'title' => 'Title',
        ];
    }
	
	public function addImage($filename, $article_id, $title)
	{		
		$this->file = $filename;
		$this->article_id = $article_id;
		$this->title = $title;
		
		if($this->validate())
		{			
			return $this->save(false);
		}
		
		return false;
	}
	
	public function getImages($article_id)
	{
		$array = [];
		$images = self::find()->where(['article_id' => $article_id])->orderBy(['id' => SORT_ASC])->asArray()->all(); 
		
		foreach($images as $item)
		{
			if($item['file'] && file_exists(Yii::getAlias('@web') . "uploads/images/" . $item['file']))
			{
				$array[] = $item;
			}
		}
		
		return $array;
	}
	
	public function deleteImage($id)
	{
		$image = self::find()->where(['id' => $id])->asArray()->one();
		$fu = new FileUpload();
		$fu->deleteFile($image['file'], 'images');
		Yii::$app->db->createCommand()->delete('image', "id=$id")->execute();
		
		return $image['article_id'];
	}
}
