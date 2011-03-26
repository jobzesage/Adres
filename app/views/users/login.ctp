<?php echo $html->docType() ?>

<html>
	<head>
		<?php echo $html->charset(); ?>
		<title>Login | ADres</title>
		
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
			
		<?php	echo $html->css('theme1/default') ?>
			
		<?php	echo $javascript->link(array(
				'jquery-1.4.2.min',
				'jquery-ui-1.8.custom.min',
				'jquery.blockUI.js',
				'jquery.ba-bbq.min',
				'jquery.cookie',
				'jquery.jstree',
				'jquery.validate.pack',
				'adres.core'
			));
		?>
	</head>
    
	<body>
    
		<div class="container">
        
		<div id="content" class="clearfix">

			<?php 
				if($session->check('Message'))	
					$session->flash();
			?>

      <div class="login">
      
			<img class="big_logo" src="/css/theme1/images/big_logo.png" alt="" />
            <div style="clear: both;"></div>

     		<div class="login_con">
      
      			<h2>Login Pannel</h2>
                
                <?php echo $session->flash(); ?>
                
                <div class="login_form">
                
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
 
                <?php //echo $form->end('submit')?>
                
                <input class="submit" type="submit" value="" />
                
                <a class="forgot" href="#">Forgot your password?</a>
                
                <a class="signup" href="#">Not Registered? Sign Up Now!</a>
                
                </div>

			</div>
 
        </div>

	<?php echo $this->element('layout/_footer')?>