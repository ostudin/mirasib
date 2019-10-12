<?php
namespace app\models;

use Yii;
use app\models\FileUpload;
use yii\helpers\Html;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property string $imageFolder
 * @property int $category_id
 * @property string $html_page
 * @property int $viewed
 * @property int $user_id
 * @property int $status
 */
class Article extends \yii\db\ActiveRecord
{	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
			[['title', 'description', 'content'], 'string'],
			[['date'], 'date', 'format' => 'php:Y-m-d'],
			[['date'], 'default', 'value' => date('Y-m-d')],
			[['description', 'content'], 'default', 'value' => null],
			[['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'content' => 'Контент',
            'date' => 'Дата',
            'image' => 'Изображение статьи',
            'imageFolder' => 'Папка с изображениями',
            'category_id' => 'Category ID',
            'html_page' => 'Html страница',
            'viewed' => 'Просмотры',
            'user_id' => 'User ID',
            'status' => 'Статус',
			'audio' => 'Аудио',
        ];
    }
	
	public function saveImage($filename)
	{
		$this->image = $filename;
		return $this->save(false);	// false отключает валидацию
	}
	
	public function getImage()
	{
		if($this->image)
		{
			return '/' . FileUpload::getFolder('images') . $this->image;
		}
		
		return '/images/no-image.png';
	}
	
	private function deleteImage()
	{		
		$file = new FileUpload();		
		$file->path = 'images';
		$file->deleteFile($this->image);	
	}
	
	public function saveAudio($filename)
	{
		$this->audio = $filename;
		return $this->save(false);
	}
	
	public function getAudio()
	{
		if($this->audio)
		{
			return '/' . FileUpload::getFolder('audio') . $this->audio;
		}
		
		return false;
	}
	
	private function deleteAudio()
	{
		$file = new FileUpload();
		$file->path = 'audio';
		$file->deleteFile($this->audio);		
	}
	
	public function beforeDelete()	// Автоматически вызывается перед удалением статьи
	{
		$this->deleteImage();
		$this->deleteAudio();
		return parent::beforeDelete();
	}
	
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'category_id']);	//Указываем связь. Поле в таблице категорий => Поле в таблице статьей
	}
	
	public function saveCategory($category_id)
	{
		$this->category_id = $category_id;
		$this->save();
	}
	
	public function getThumbnails($key = false)
	{
		if($this->image)
		{
			if(!file_exists(Yii::getAlias('@web') . 'uploads/images/' . $this->image)) return false;
			
			return 	[
				'file' => '/' . FileUpload::getFolder('images') . $this->image,
				'topPosition' => self::getObjectPosition($this->image),
			];
		}
		
		if($this->imageFolder && is_dir(Yii::getAlias('@web') . 'images-folders/' . $this->imageFolder))
		{
			$files = scandir(Yii::getAlias('@web') . 'images-folders/' . $this->imageFolder);
			
			if(count($files))
			{
				if($key)
				{
					foreach($files as $file)
					{
						if(strlen($file) > 3 && strpos($file, $key)) 
						{					
							return [
								'file' => '/images-folders/' . $this->imageFolder . '/' . $file,
								'topPosition' => self::getObjectPosition($file),
							];
						}
					}
				}
			
				foreach($files as $file)
				{
					if(strlen($file) > 3) 
					{					
						return [
							'file' => '/images-folders/' . $this->imageFolder . '/' . $file,
							'topPosition' => self::getObjectPosition($file),
						];
					}
				}
			}
		}
		
		return [
				'file' => '/images/no-image.png',
				'topPosition' => 'topcenter',
			];;
	}
	
	public function getPostDate($date = false)
	{
		if(!$date) $date = $this->date;
		
		$day   = date("d", strtotime($date));
		$month = self::getMonth(date("m", strtotime($date)));
		$year  = date("Y", strtotime($date));
		
		return $day . ' ' . $month . ' ' . $year;
	}
	
	public function getPageURL($photo = false)
	{
		if($photo) return $this->html_page ? 'site/' . $this->html_page : 'site/photo';
		
		return $this->html_page ? 'site/' . $this->html_page : 'site/view';
	}
	
	public function getPostImages()
	{
		$array = [];
		
		/*images-folders*/
		if($this->imageFolder  && is_dir(Yii::getAlias('@web') . 'images-folders/' . $this->imageFolder))
		{
			if(!file_exists(Yii::getAlias('@web') . 'images-folders/' . $this->imageFolder . '/noscan'))
			{
				$files = scandir(Yii::getAlias('@web') . 'images-folders/' . $this->imageFolder);
				
				if(count($files))
				{
					$countImages = 0;				
					foreach($files as $file)
					{
						if(strlen($file) > 3) 
						{
							$countImages++;						
							$array[] = [
								'file' => '/images-folders/' . $this->imageFolder . '/' . $file,
								'title' => $this->title . ". Фото $countImages",
							];
						}
					}
				}
			}
		}
		
		/* image table */
		$images = Yii::$app->db->createCommand('SELECT file, title FROM image WHERE article_id = ' . $this->id)->queryAll();
		
		foreach($images as $item)
		{
			$currentFile = Yii::getAlias('@web') . 'uploads/images/' . $item['file'];			
			if(file_exists($currentFile))
			{
				$array[] = [
					'file' => '/uploads/images/' . $item['file'],
					'title' => $item['title'],
				];
			}
		}
		
		return $array;
	}
	
	public function nl2p($string) 
	{
		$string_parts = explode("\n", $string);
		$string = '<p>' . implode('</p><p>', $string_parts) . '</p>';	
		
		return str_replace("<p></p>", '', $string);	
	}
	
	private function getMonth($m)
	{
		switch($m)
		{
			case '01': return 'января';
			case '02': return 'февлаля';
			case '03': return 'марта';
			case '04': return 'апреля';
			case '05': return 'мая';
			case '06': return 'июня';
			case '07': return 'июля';
			case '08': return 'августа';
			case '09': return 'сентября';
			case '10': return 'октября';
			case '11': return 'ноября';
			case '12': return 'декабря';
			default: return false;
			
		}
	}
	
	public function getObjectPosition ($image)
	{
		if(strpos(mb_strtolower($image), 'topmiddle')!==false || strpos(mb_strtolower($image), 'topcenter')!==false) return 'topcenter';
		if(strpos(mb_strtolower($image), 'topbottom')!==false) return 'topbottom';
		return false;
	}
	
	public function saveArticle()
	{
		$this->user_id = Yii::$app->user->id;
		$this->alias = time();
		return $this->save();
	}
	
	public function getHtmlContent()
	{
		$html_content = $this->html_content;
		if(!$html_content) $html_content = $this->imageFolder;
		if($html_content && !file_exists(Yii::getAlias('@app') . "/views/html_content/".$html_content.".php")) $html_content = false;
		
		return $html_content;
	}
	
	public function view()
	{
		$this->viewed += 1;
		$this->save();
	}
	
	public function getPopular()
	{		
		$query = Article::find()->where('date >= DATE_SUB(CURRENT_DATE, INTERVAL 60 DAY)')->orderBy(['viewed' => SORT_DESC, 'date' => SORT_DESC])->limit(5)->all();
		return $query;
	}
	
	public function getPhotoalbum()
	{
		return Article::find()->orderBy(['date' => SORT_DESC])->where('imageFolder IS NOT NULL AND photoalbum IS NOT NULL AND (category_id = 1 or category_id = 2)');
	}
	
	public function getPhotoalbumImg()
	{
		$article = self::getPhotoalbum()->all();
		
		if($count = count($article))
		{
			$num = rand(0, $count);
			$folder = '2019-08-22-RosKviz';
			
			if(isset($article[$num]) && $article[$num]->imageFolder)
			{
				$folder = $article[$num]->imageFolder;
			}
			
			$files = scandir(Yii::getAlias('@web') . 'images-folders/' . $folder);
			
			if(count($files))
			{
				foreach($files as $file)
				{
					if(strlen($file) > 3) 
					{							
						return [
							'file' => '/images-folders/' . $folder . '/' . $file,
							'topPosition' => self::getObjectPosition($file),
						];
					}
				}
			}				
			
		}
	}
	
	public function getIdWpUrl()
	{
		$path = Yii::$app->request->pathInfo;
		
		if((strpos($path, '2018/') !== null) or (strpos($path, '2019/') !== null) or (strpos($path, '2020/') !== null))
		{
			$query = Yii::$app->db->createCommand('SELECT alias FROM article WHERE wp_url=:path', ['path' => $path])->queryOne();		
			if($query) return Yii::$app->getResponse()->redirect(['site/view', 'alias' => $query['alias']])->send();
		}
	}
	
	public function getReview($random = false)
	{
		$query = false;
		
		if($random)
		{
			$query = Yii::$app->db->createCommand('SELECT * FROM reviews WHERE status > 0 ORDER BY RAND() LIMIT 1')->queryOne();			
		}
		
		return $query;
	}
	
	public function articleInit($query)
	{
		if(is_array($query) && count($query))
		{
			foreach($query as &$item)
			{
				$item = self::setField($item);
			}
		}
		
		else 
		{
			$query = self::setField($query);
		}
		
		return $query;
	}
	
	private function setField($item)
	{
		$t = $item['alias'] ? $item['alias'] : false;				
		if(!$t && $item['imageFolder']) $t = $item['imageFolder'];
		if(!$t && $item['html_content']) $t = $item['html_content'];
		
		if($t && !$item['alias']) $item['alias'] = $t;
		if($t && !$item['imageFolder']) $item['imageFolder'] = $t;
		if($t && !$item['html_content']) $item['html_content'] = $t;
		
		return $item;
	}
}
