<?php echo $this->element('header');?>
        <div class="container showgrid">
            <div id="header" class="span-24 last">
                <h1><?php echo __('Adress Social Contact'); ?></h1>
                <?php echo $this->Session->flash(); ?>
                <?php echo $content_for_layout;?>
            </div>  
        </div>
<?php echo $this->element('footer')?>
