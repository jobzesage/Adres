<?php echo $html->docType() ?>
<html>
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
	<?php echo $html->css(array(
			'adres.default',
			'jquery-ui-1.7.2.modified'
		)) ?>
		
	<?php	echo $javascript->link(array(
			'jquery-1.4.2.min',
			'jquery-ui-1.8.custom.min',
			'jquery.blockUI.js',
			'adres.core'
		));
	?>
</head>
<body>
	<div class="container" style='background:#f2f2f2'>
		<div class="header">
			<h1><?php echo $html->link(__('Adres', true), '#'); ?></h1>
			<hr/>
		</div>
		<div id="content" class='clearfix'  >

			<?php 
				if($session->check('Message'))	
					$session->flash();
			?>

      <div class="prepend-7 clear" style >
      			<h2>Login</h2>
                <?php echo $session->flash(); ?>
                <div class='span-8'>
                <?php echo $form->create('User',array(
                 'url'=>array(
                 'controller'=>'users',
                 'action'=>'login'
                 )))?>
                
                    <?php
                        echo $form->input('username', array(
                            'label' => __('User Name', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                        'class' => 'text',
                        'id'=>'username'
                        ));
                    ?>
                    <?php
                        echo $form->input('password', array(
                            'label' => __('Password', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                            'class' => 'text',
                            'id'=>'password'
                        ));
                    ?>
 
                <?php echo $form->end('submit')?>
                </div>
 
        </div>
		</div>
		<div id="footer" class="span-24 last">
			(c) Copyright 2010 	. All Rights Reserved. 
		</div>
	</div>
</body>
</html>












