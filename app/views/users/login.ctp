      <div class="">
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