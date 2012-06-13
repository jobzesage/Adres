<html>
	<head>
		<?php echo $html->charset(); ?>
		<title>
			<?php echo empty($title_for_layout) ? __('Adres the Adress Book',true): $title_for_layout; ?>
		</title>
		<?php   echo $html->meta('icon') ?>
		<?php	echo $html->css('blueprint/screen','stylesheet',array('media'=>'screen, projection')) ?>
		<?php	echo $html->css('blueprint/print','stylesheet',array('media'=>'print')) ?>

		<!--[if lte IE 7]>
		<?php	echo $html->css(array('blueprint/ie')) ?>
		<![endif]-->

		<?php echo $html->css(array(
				'adres.default',
				'jquery-ui-1.7.2.modified',
				'jquery.ui.selectmenu'
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
				'jquery.ui.selectmenu',
                'dust-full-0.3.0.min',
				'adres.core'
			));

			#echo $scripts_for_layout;
		?>

	</head>

	<body style="background: url(/css/theme1/images/header.jpg) repeat-x;">

		<div class="container" style="margin: 0 auto; width: 980px;">

		<div class="header">

				<div class="adres-menu" style="margin: 2px 0 0 0;">

				<?php echo $html->link(__('Home',true),array('controller'=>'users','action'=>'home'), array("class"=>"home top-button")) ?>

				<?php echo $html->link(__('Affiliations',true),array('controller'=>'affiliations','action'=>'index')) ?>

				<?php echo $html->link(__('Implementations',true),array('controller'=>'implementations','action'=>'index')) ?>

				<?php echo $html->link(__('Contact Types',true),array('controller'=>'contact_types','action'=>'index')) ?>

				<?php echo $html->link(__('Groups',true),array('controller'=>'groups','action'=>'index')) ?>

				<?php echo $html->link(__('Data Structure',true),array('controller'=>'fields','action'=>'index')) ?>

				<?php echo $html->link(__('Field Types',true),array('controller'=>'field_types','action'=>'index')) ?>

				<?php echo $html->link(__('Trash',true),array('controller'=>'contacts','action'=>'trash')) ?>

                <?php echo $html->link(__('Email Log',true),array('plugin'=>'emailer','controller'=>'main','action'=>'show')) ?>

<?php echo $html->link(__('Users',true),array('controller'=>'users','action'=>'index')) ?>

				<?php echo $html->link(__('Logout',true),array('controller'=>'users','action'=>'logout'), array("class"=>"logout top-button")) ?>

	            </div>

	            <img style="padding-left: 5px;" class="logo" src="/css/theme1/images/logo.png" alt="" />

		</div>

		<div id="content" class='clear' style="padding: 10px 0 0 0;">

			<?php
				if($session->check('Message'))
					$session->flash();
			?>

			<?php echo $content_for_layout; ?>

		</div>

	<?php echo $this->element('layout/_footer')?>
