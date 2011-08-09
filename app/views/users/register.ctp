<?php #echo $this->element('header')?>
        <div class="container">
                <h1><?php echo __('Adress Social Contact'); ?></h1>
                <?php echo $session->flash(); ?>
                <div class='span-8'>
                <?php echo $form->create('User',array(
                	'url'=>array(
                		'controller'=>'users',
                		'action'=>'register'
                )))?>
                	<?php echo $this->element("_user_fields") ?>
                <?php echo $form->end('Submit')?>
                
                <span class='regi_link'><?php echo $html->link(__('Forget Password',true),'#')?></span>
                <span class='regi_link'><?php echo $html->link(__('Login',true),'#')?></span>
                
             </div>
 
        </div>
<?php #echo $this->element('footer')?>
 