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
                    <?php
                        echo $form->input('first_name', array(
                            'label' => __('First Name', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                        'class' => 'text'
                        ));
                    ?>
        
                    <?php
                        echo $form->input('last_name', array(
                            'label' => __('Last Name', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                        'class' => 'text'
                        ));
                    ?>
                            
                    <?php
                        echo $form->input('username', array(
                            'label' => __('User Name', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                        'class' => 'text'
                        ));
                    ?>
                    <?php
                        echo $form->input('email',array(
                            'label'=>__('User Email',true).':',
                            'div'=>true,
                            'class'=>'text'
                        ))
                    ?>
                    <?php
                        echo $form->input('password', array(
                            'label' => __('Password', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                            'class' => 'text'
                        ));
                    ?>
                    <?php
                        echo $form->input('confirm_password', array(
                            'type'=>'password',
                            'label' => __('Confirm Password', true) . ':',
                            'div' =>true,
                            'class' => 'text'
                        ));
                    ?>
                <?php echo $form->end('Submit')?>
                
                <span class='regi_link'><?php echo $html->link(__('Forget Password',true),'#')?></span>
                <span class='regi_link'><?php echo $html->link(__('Login',true),'#')?></span>
                
             </div>
 
        </div>
<?php #echo $this->element('footer')?>
 