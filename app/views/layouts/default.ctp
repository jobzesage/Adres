<?php $html->docType('XTHML') ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Adres the Adress Book',true); ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php echo $html->meta('icon') ?>
		
	<?php	echo $html->css('blueprint/screen','stylesheet',array('media'=>'screen, projection')) ?>

	<?php	echo $html->css('blueprint/print','stylesheet',array('media'=>'print')) ?>
	
	<!--[if lte IE 7]>
	<?php	echo $html->css(array('blueprint/ie')) ?>		
	<![endif]-->
	<?php echo $html->css('adres.default') ?>
		
	<?php	echo $javascript->link(array(
			'jquery-1.4.1.min',
			'jquery-ui-1.7.2.custom.min',
			'jquery.blockUI.js',
			'adres.core'
		));

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div class="container">
		<div class="header">
			<h1><?php echo $html->link(__('Adres', true), '#'); ?></h1>
			<hr/>
		</div>
		<?php echo $this->element('implementations/list') ?>
		<?php echo $this->element('main_navigation') ?>		
		<div id="content" class='clear'>

			<?php 
				// if($session->check('Message'))	
					$session->flash();
			?>
			
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer" class="span-24 last">
			(c) Copyright 2010 	. All Rights Reserved. 
		</div>
	</div>
	<?php #echo $cakeDebug; ?>
</body>
</html>