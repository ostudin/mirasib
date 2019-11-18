<?php
namespace app\components;
use \Yii;
use yii\captcha\CaptchaAction;
class NumCaptchaAction extends CaptchaAction
{    
    protected function generateVerifyCode()
    {
        $length = 5;
        $digits = '012345689';
 
        $code = '';
        for($i = 0; $i < $length; $i++) {
            $code .= $digits[mt_rand(0, 8)];
        }
        return $code;
    }
}