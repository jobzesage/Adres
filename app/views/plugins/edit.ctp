<?php echo $form->create('TypeSelectOption',array(
	'url' => array(
		'controller' => 'plugins', 
		'action' => 'edit'
	) 
)); ?>
	<?php echo $input_field ?>
<?php echo $form->end('Save'); ?>