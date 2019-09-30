<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\CommentForm;
use app\models\Feedback;
use app\models\Search;
use app\models\Slider;

class SiteController extends Controller
{   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
   
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {		
		$query = Article::find()->orderBy(['date' => SORT_DESC]);
		
		$articles  = $query->limit(6)->all();
		$interview = $query->where(['category_id' => 2])->all();
		$services  = $query->where(['category_id' => 3])->all();
		$poems     = $query->where(['category_id' => 5])->all();
		//$videos    = $query->where(['category_id' => 6])->all();
		
		$slides = Slider::getImages();
		
        return $this->render('index', compact('articles', 'interview', 'services', 'poems', 'slides'));
    }
	
	public function actionNews()
    {
		$query = Article::find()->orderBy(['date' => SORT_DESC]);
		$count = $query->count();
		$pagination = new Pagination(['totalCount' => $count, 'pageSize' => 30]);
		$articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();
		$title = 'Новости';
				
        return $this->render('news', compact('articles', 'pagination', 'title'));
    }
        
    public function actionAbout()
    {       
		$article  = Article::findOne(['html_page' => 'about']);
		$comments = CommentForm::getComments($article->id);
		$commentForm = new CommentForm;
		
		if(Yii::$app->request->get('uid'))
		{
			$commentForm->answer(Yii::$app->request->get('uid'));
		}
		
		return $this->render('about', compact('article', 'comments', 'commentForm'));
    }
	
	public function actionView($id)
	{
		$article  = Article::findOne($id);
		$article->view();
		$comments = CommentForm::getComments($id);
		$commentForm = new CommentForm;
		
		if(Yii::$app->request->get('uid'))
		{
			$commentForm->answer(Yii::$app->request->get('uid'));
		}
		
		return $this->render('single', compact('article', 'comments', 'commentForm'));
	}
	
	public function actionComment($id)
	{
		$model = new CommentForm;
		
		if(Yii::$app->request->isPost)
		{
			$model->load(Yii::$app->request->post());
			
			if($model->saveComment($id))
			{
				Yii::$app->getSession()->setFlash('comment', 'Комментарий добавлен!');				
			}
			
			return $this->redirect(['site/view', 'id' => $id]);
		}
	}
	
	public function actionFeedback()
	{
		$model = new Feedback();
		$post = Yii::$app->request->post();
						
		if($post)
		{
			if($model->load($post) && $model->sendMail2($post))
			{				
				return $this->redirect(['/']);
			}						
		} 
		
		return $this->render('feedback', compact('model'));
	}
	
	public function actionSearch()
	{
		$post = Yii::$app->request->post('Search');
				
		$query = Search::articleFind($post['search']);
				
		$count = $query->count();
		$pagination = new Pagination(['totalCount' => $count, 'pageSize' => 30]);
		$articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();
		
		$title = "Результаты поиска ($count)";
        return $this->render('news', compact('articles', 'pagination', 'title'));
	}
	
	public function actionPrivacy()
	{
		return $this->render('privacy', ['title' => 'Политика конфиденциальности']);
	}
	
	public function actionCookies()
	{
		return $this->render('cookies', ['title' => 'Политика использования файлов Cookies']);
	}
	
	public function actionContacts()
	{
		return $this->render('contacts', ['title' => 'Контакты']);
	}
	
	public function actionPhoto($id = false)
    {
		if(!$id)
		{
			$query = Article::getPhotoalbum();
			$count = $query->count();
			$pagination = new Pagination(['totalCount' => $count, 'pageSize' => 30]);
			$articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();
			$title = 'Фотоальбом';
					
			return $this->render('news', compact('articles', 'pagination', 'title'));
		}
		
		if($id)
		{
			$article  = Article::findOne($id);
			$article->view();			
			
			return $this->render('photo', compact('article'));
		}
    }
}
