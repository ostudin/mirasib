<?php
	$csrf_param = Yii::$app->request->csrfParam; 
	$csrf_token = Yii::$app->request->csrfToken;
	$pic_directory = '/assets/site/module/visually-impaired/pic/';
		
	$this->registerJs("		
		$(document).on('click', '.visually-impaired', function() {
				$('#site').addClass('visually');
				$('#visually-panel-nav').addClass('panel-nav-visually-mode');
												
				$.post('/visually/visually', {visually: 1, '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
				
				$('#fontsize-normal-pic').attr('src', '".$pic_directory."f1.png');
				$('#fontsize-large-pic').attr('src', '".$pic_directory."f2_active.png');
				$('#fontsize-largest-pic').attr('src', '".$pic_directory."f3.png');
				
				$('#site').addClass('fontsize-large');
				$('#site').removeClass('fontsize-largest');
				
				$.post('/visually/fontsize', {fontsize: 'fontsize-largest', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
				
				$('#scheme-white-pic').attr('src', '".$pic_directory."a1_active.png');
				$('#scheme-black-pic').attr('src', '".$pic_directory."a2.png');
				$('#scheme-blue-pic').attr('src', '".$pic_directory."a3.png');
				
				$('#site').addClass('scheme-white');
				$('#site').removeClass('scheme-black');
				$('#site').removeClass('scheme-blue');
				
				$.post('/visually/scheme', {scheme: 'scheme-white', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
				
				
			});	

		$(document).on('click', '.visually-normal-button', function() {
				$('#fontsize-normal-pic').attr('src', '".$pic_directory."f1_active.png');
				$('#fontsize-large-pic').attr('src', '".$pic_directory."f2.png');
				$('#fontsize-largest-pic').attr('src', '".$pic_directory."f3.png');
				$('#scheme-white-pic').attr('src', '".$pic_directory."a1.png');
				$('#scheme-black-pic').attr('src', '".$pic_directory."a2.png');
				$('#scheme-blue-pic').attr('src', '".$pic_directory."a3.png');
				$('#images-color-pic').attr('src', '".$pic_directory."c1_active.png');
				$('#images-black-white-pic').attr('src', '".$pic_directory."c2.png');
				$('#images-none-pic').attr('src', '".$pic_directory."c3.png');
				
				$('#site').removeClass('visually');
				$('#site').removeClass('scheme-white');
				$('#site').removeClass('scheme-black');
				$('#site').removeClass('scheme-blue');
				$('#site').removeClass('fontsize-large');
				$('#site').removeClass('fontsize-largest');
				$('#site').removeClass('images-black-white');
				$('#site').removeClass('images-none');
				$('#visually-panel-nav').removeClass('panel-nav-visually-mode');
				$.post('/visually/visually', {visually: 0, '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#fontsize-normal', function() {
				$('#fontsize-normal-pic').attr('src', '".$pic_directory."f1_active.png');
				$('#fontsize-large-pic').attr('src', '".$pic_directory."f2.png');
				$('#fontsize-largest-pic').attr('src', '".$pic_directory."f3.png');
				
				$('#site').removeClass('fontsize-large');
				$('#site').removeClass('fontsize-largest');
				
				$.post('/visually/fontsize', {fontsize: 'fontsize-normal', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#fontsize-large', function() {
				$('#fontsize-normal-pic').attr('src', '".$pic_directory."f1.png');
				$('#fontsize-large-pic').attr('src', '".$pic_directory."f2_active.png');
				$('#fontsize-largest-pic').attr('src', '".$pic_directory."f3.png');
				
				$('#site').addClass('fontsize-large');
				$('#site').removeClass('fontsize-largest');
				
				$.post('/visually/fontsize', {fontsize: 'fontsize-large', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#fontsize-largest', function() {
				$('#fontsize-normal-pic').attr('src', '".$pic_directory."f1.png');
				$('#fontsize-large-pic').attr('src', '".$pic_directory."f2.png');
				$('#fontsize-largest-pic').attr('src', '".$pic_directory."f3_active.png');
				
				$('#site').addClass('fontsize-largest');
				$('#site').removeClass('fontsize-large');
				
				$.post('/visually/fontsize', {fontsize: 'fontsize-largest', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#scheme-white', function() {
				$('#scheme-white-pic').attr('src', '".$pic_directory."a1_active.png');
				$('#scheme-black-pic').attr('src', '".$pic_directory."a2.png');
				$('#scheme-blue-pic').attr('src', '".$pic_directory."a3.png');
				
				$('#site').addClass('scheme-white');
				$('#site').removeClass('scheme-black');
				$('#site').removeClass('scheme-blue');
				
				$.post('/visually/scheme', {scheme: 'scheme-white', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
		
		$(document).on('click', '#scheme-black', function() {
				$('#scheme-white-pic').attr('src', '".$pic_directory."a1.png');
				$('#scheme-black-pic').attr('src', '".$pic_directory."a2_active.png');
				$('#scheme-blue-pic').attr('src', '".$pic_directory."a3.png');
				
				$('#site').removeClass('scheme-white');
				$('#site').addClass('scheme-black');
				$('#site').removeClass('scheme-blue');
				
				$.post('/visually/scheme', {scheme: 'scheme-black', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#scheme-blue', function() {
				$('#scheme-white-pic').attr('src', '".$pic_directory."a1.png');
				$('#scheme-black-pic').attr('src', '".$pic_directory."a2.png');
				$('#scheme-blue-pic').attr('src', '".$pic_directory."a3_active.png');
				
				$('#site').removeClass('scheme-white');
				$('#site').addClass('scheme-blue');
				$('#site').removeClass('scheme-black');
				
				$.post('/visually/scheme', {scheme: 'scheme-blue', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#images-color', function() {
				$('#images-color-pic').attr('src', '".$pic_directory."c1_active.png');
				$('#images-black-white-pic').attr('src', '".$pic_directory."c2.png');
				$('#images-none-pic').attr('src', '".$pic_directory."c3.png');
				
				$('#site').removeClass('images-black-white');
				$('#site').removeClass('images-none');
				
				$.post('/visually/images', {images: 'images-color', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
		
		$(document).on('click', '#images-black-white', function() {
				$('#images-color-pic').attr('src', '".$pic_directory."c1.png');
				$('#images-black-white-pic').attr('src', '".$pic_directory."c2_active.png');
				$('#images-none-pic').attr('src', '".$pic_directory."c3.png');
				
				$('#site').addClass('images-black-white');
				$('#site').removeClass('images-none');
				
				$.post('/visually/images', {images: 'images-black-white', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
			
		$(document).on('click', '#images-none', function() {
				$('#images-color-pic').attr('src', '".$pic_directory."c1.png');
				$('#images-black-white-pic').attr('src', '".$pic_directory."c2.png');
				$('#images-none-pic').attr('src', '".$pic_directory."c3_active.png');
				
				$('#site').removeClass('images-black-white');
				$('#site').addClass('images-none');
				
				$.post('/visually/images', {images: 'images-none', '$csrf_param' : '$csrf_token'}, function(data){
					if(data) console.log(data);
				});
			});	
	"); 		
?>