<html>
	<head>
		<?php echo $html->charset(); ?>
		
		<title><?php echo isset($page_title) ? h($page_title) : __('ADres - Dashboard', true)?></title>

		<?php echo $html->meta('icon') ?>
			
		<?php	echo $html->css('blueprint/screen','stylesheet',array('media'=>'screen, projection')) ?>
	
		<?php	echo $html->css('blueprint/print','stylesheet',array('media'=>'print')) ?>
				
		<!--[if lte IE 7]>
		<?php	echo $html->css(array('blueprint/ie')) ?>		
		<![endif]-->
		
		<?php echo $html->css(array(
				'adres.default',
				'jquery-ui-1.7.2.modified',
				'jquery.ui.selectmenu',
				#'flick/jquery.ui.all'
			)) ?>
			
		<?php	echo $html->css('theme1/default') ?>
			
		<?php	echo $javascript->link(array(
				'jquery-1.4.2.min',
				'jquery-ui-1.8.custom.min',
				'jquery.blockUI',
				'jquery.cookie',
				'jquery.jstree',
				'jquery.validate.pack',
				'jquery.ui.selectmenu',
		        'jquery.qtip-1.0', #Downloaded from launch pad Ref. 55
                'adres.core'
			));
			
			
			#echo $scripts_for_layout;
		?>
	</head>
    
	<body>
    
		<div class="container">
        
		<div class="header">

				<div class="adres-menu">
                		<?php echo $html->link(__('Logout',true),array('controller'=>'users','action'=>'logout'), array("class"=>"logout top-button")) ?>
                </div>
                
				<div class="adres-menu">
                		<?php echo $html->link(__('Administrator',true),array('controller'=>'data_structure','action'=>'index'), array("class"=>"admin top-button")) ?>
                </div>
                
				<div class="adres-menu">
                		<?php echo $html->link(__('Home',true),array('controller'=>'users','action'=>'home'), array("class"=>"home top-button")) ?>
                </div>
                
                <img class="logo" src="/css/theme1/images/logo.png" alt="" />

		</div>
