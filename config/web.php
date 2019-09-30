<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	
	'language'=>'ru',
    'sourceLanguage'=>'ru',
	
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '12345',
			'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => ['auth/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'about/' => 'site/about',
				'view/'  => 'site/view',
				'news/'  => 'site/news',
				'feedback/' => 'site/feedback',
				'search'    => 'site/search',
				'privacy'   => 'site/privacy',
				'cookies'   => 'site/cookies',
				'contacts'  => 'site/contacts',
				'photo'     => 'site/photo',
				
				'entry/'       => 'auth/entry',
				'signup/'      => 'auth/signup',
				'profile/'     => 'auth/profile',
				'setpassword/' => 'auth/setpassword',
				
				'links/'     => 'page/links',
				'documents/' => 'page/documents',
				'faq/'       => 'page/faq',
				'projects/'  => 'page/projects',
				
				//'2019/09/19/104-stranicy-pro-ljubov-mirovcy-otkryvajut-novyj-teatralnyj-sezon/' => 'page/projects',
            ],
        ],
    
    ],
	
	'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\module',
        ],
    ],
	
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;