<?php $html->docType('XTHML') ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Adres the Adress Book'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php echo $html->meta('icon') ?>
		
	<?php	echo $html->css(array(
		'blueprint/screen',
		'jquery-ui-1.7.2.modified.css'
	)) ?>
	
	<!--[if lte IE 8]>
	<?php	echo $html->css(array('blueprint/ie')) ?>		
	<![endif]-->
		
	<?php	echo $javascript->link(array(
			'jquery-1.4.1.min',
			'jquery-ui-1.7.2.custom.min',
			'adres.core'
		));

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div class="container showgrid">
		<div id="header">
			<h1><?php echo $html->link(__('Adres', true), '#'); ?></h1>
		</div>
		<div id="content">

			<?php 
				// if($session->check('Message'))	
					$session->flash();
			?>
			
			<?php echo $content_for_layout; ?>
		</div>
		<div id="footer">

		</div>
	</div>
	<?php echo $cakeDebug; ?>
</body>
</html>