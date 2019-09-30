<?php
namespace app\assets;

use yii\web\AssetBundle;

class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [       		
		"assets/site/public/css/bootstrap.min.css",
		"assets/site/public/css/font-awesome.min.css",
		"assets/site/public/css/animate.min.css",
		"assets/site/public/css/owl.carousel.css",
		"assets/site/public/css/owl.theme.css",
		"assets/site/public/css/owl.transitions.css",
		"assets/site/public/css/style.css",
		"assets/site/public/css/responsive.css",
		
		"assets/site/module/visually-impaired/style.css",
		
		"assets/site/plugins/magnific/magnific-popup.css",
		
		"assets/site/plugins/nivo-slider/default.css",
		"assets/site/plugins/nivo-slider/nivo-slider.css",
		
		"assets/site/css/default.css",
		"assets/site/css/admin.css",
		"assets/site/css/site.css",
		"assets/site/css/htmlpages.css",
		"assets/site/css/linkspage.css",		
    ];
	
    public $js = [
		"assets/site/public/js/bootstrap.min.js",
		"assets/site/public/js/owl.carousel.min.js",
		"assets/site/public/js/jquery.stickit.min.js",
		"assets/site/public/js/menu.js",
		"assets/site/public/js/scripts.js",
		
		"assets/site/module/visually-impaired/script.js",
		
		"assets/site/plugins/magnific/jquery.magnific-popup.min.js",
		"assets/site/plugins/magnific/script.js",
		
		"assets/site/plugins/nivo-slider/jquery.nivo.slider.js",
		"assets/site/plugins/nivo-slider/script.js",
    ];
	
    public $depends = [
        
    ];
	
}

