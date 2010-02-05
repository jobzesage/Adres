<?php echo $this->Html->docType('xhtml');?>
<html>

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php __('Adress Application'); ?></title>

        <?php   echo $this->Html->meta('icon');
                echo $this->Html->css(array('blueprint/screen','blueprint/print'));
                
                echo $this->Javascript->link(array('jquery.1.4.1.min.js')); 
                echo $scripts_for_layout;
        ?>
        <!--[if lt IE 8]>
            <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->

    </head>
    <body>
        <div id="container">
            <div id="header" class="span-24 last">
                <h1><?php echo __('Adress Social Contact'); ?></h1>
            </div>
            <hr /> 
            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $content_for_layout;?>
            </div>  

        </div>
    </body>
</html>
