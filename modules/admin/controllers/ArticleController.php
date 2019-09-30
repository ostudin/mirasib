<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\Category;
use app\models\ArticleSearch;
use app\models\ImageUpload;
use app\models\AudioUpload;
use app\models\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionSetImage($id)
	{
		$model = new ImageUpload;
		
		if (Yii::$app->request->isPost)
		{
			$article = $this->findModel($id);			
			$file = UploadedFile::getInstance($model, 'image');
						
			if ($article->saveImage($model->uploadFile($file, $article->image)))
			{
				return $this->redirect(['view', 'id' => $article->id]);
			}
		}
		
		return $this->render('image', compact('model'));
	}
	
	public function actionSetAudio($id)
	{
		$model = new AudioUpload;
		
		if (Yii::$app->request->isPost)
		{
			$article = $this->findModel($id);			
			$file = UploadedFile::getInstance($model, 'audio');
												
			if ($article->saveAudio($model->uploadFile($file, $article->audio)))
			{
				return $this->redirect(['view', 'id' => $article->id]);
			}
		}
		
		return $this->render('audio', compact('model'));
	}
	
	public function actionSetCategory($id)
	{
		$article = $this->findModel($id);
		
		$selectedCategory = $article->category->id;
		$categories = Category::getCategories();
		
		if (Yii::$app->request->isPost)
		{
			$category = Yii::$app->request->post('category');
			$article->saveCategory($category);
			
			return $this->redirect(['view', 'id' => $article->id]);
		}
				
		return $this->render('category', compact('article', 'selectedCategory', 'categories'));
	}
	
	public function actionAddImages($id)
	{
		$model = new Image;
		$images = $model->getImages($id);
						
		if (Yii::$app->request->isPost)
		{	
			$post_image = Yii::$app->request->post('Image');
			$title = $post_image['text'];
			
			$iUpload = new ImageUpload;
			$file = UploadedFile::getInstance($model, 'image');
			
			$model->addImage($iUpload->uploadFile($file, false), $id, $title);		
			return $this->redirect(['view', 'id' => $id]);
		}
						
		return $this->render('addimages', compact('model', 'images'));
	}
	
	public function actionDeleteImage($id)
	{
		$model = new Image;
		$article_id = $model->deleteImage($id);
		return $this->redirect(['view', 'id' => $article_id]);
	}
}