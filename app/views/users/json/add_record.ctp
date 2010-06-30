<div style="width:310px">
	
<?php echo $form->create('Contact',array(
	'url'=>array(
		'controller' => 'users', 
		'action' => 'add_record'
	),
	'class' => '' 
	)) ?>
	
<?php echo $form->end('Save') ?>
</div>