<?php echo $this->element('header')?>
        <div class="container showgrid">
                <h1><?php echo __('Adress Social Contact'); ?></h1>
                <?php echo $this->Session->flash(); ?>
                <div class='span-8'>
                <?php echo $this->Form->create('User',array('url'=>array('controller'=>'users','action'=>'login')))?>
                    <?php
                        echo $this->Form->input('name', array(
                            'label' => __('User Name', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                        'class' => 'text'
                        ));
                    ?>
                    <?php
                        echo $this->Form->input('email',array(
                            'label'=>__('User Email',true).':',
                            'div'=>true,
                            'class'=>'text'
                        ))
                    ?>
                    <?php
                        echo $this->Form->input('password', array(
                            'label' => __('Password', true) . ':',
                            'div' => array(
                                'class' => ''
                            ),
                            'class' => 'text'
                        ));
                    ?>             
                    <?php
                        echo $this->Form->input('confirm_password', array(
                            'label' => __('Confirm Password', true) . ':',
                            'div' =>true,
                            'class' => 'text'
                        ));
                    ?>     
                <?php echo $this->Form->end('submit')?>
                </div>

        </div>
<?php echo $this->element('footer')?>
