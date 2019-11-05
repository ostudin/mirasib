<?php

// comment out the following two lines when deployed to production
if(strpos($_SERVER['REMOTE_ADDR'], '127.0.0.1') !== false || strpos($_SERVER['REMOTE_ADDR'], '37.192.235.130') !== false)
{
	defined('YII_DEBUG') or define('YII_DEBUG', true);
	defined('YII_ENV') or define('YII_ENV', 'dev');
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
