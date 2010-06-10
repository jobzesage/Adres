<?php echo $form->create('Contact',array(
	'url'=>array(
		'controller' => 'users', 
		'action' => 'add_record'
	),
	'class' => 'adres-ajax-form ' 
	)) ?>
	
<?php echo $form->end('Save') ?>