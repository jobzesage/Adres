<?php echo $this->Html->docType('xhtml');?>
<html>

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php __('Adress Application'); ?></title>

        <?php   echo $this->Html->meta('icon');
                echo $this->Html->css('blueprint/screen','stylesheet',array('media'=>'screen, media'));
                echo $this->Html->css('blueprint/print','stylesheet',array('media'=>'print'));
                
                #echo $this->JavaScript->link('jquery.1.4.1.min'); 
                #echo $scripts_for_layout;
        ?>
        <!--[if lt IE 8]>
            <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->

    </head>
    <body>
