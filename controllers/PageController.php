<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Page;

class PageController extends Controller {
		
	public function actionLinks()
    {		
		$links = Page::getMiraLinks();
		
		return $this->render('links', compact('links'));
	}
	
	public function actionDocuments()
    {		
		$doc = Page::getMiraDoc();
		
		return $this->render('doc', compact('doc'));
	}
	
	public function actionFaq()
    {
		
		$faq = Page::getMiraFaq();
		
		return $this->render('faq', compact('faq'));
	}
	
	public function actionProjects()
	{		
		return $this->render('projects');
	}
}