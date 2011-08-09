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