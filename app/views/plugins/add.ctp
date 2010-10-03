<?php echo $form->create('TypeSelectOption',array(
	'url' => array(
		'controller' => 'plugins', 
		'action' => 'add'
	) 
)); ?>
	<?php echo $input_field ?>
<?php echo $form->end('Save'); ?>