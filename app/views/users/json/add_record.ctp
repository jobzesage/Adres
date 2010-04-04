<?php echo $form->create('Contact',array(
	'url'=>array(
		'controller' => 'users', 
		'action' => 'add_record'
	),
	'class' => '' 
	)) ?>
	<?php foreach ($plugins as $type=>$field): ?>
	<?php echo $form->input($type.'.'.$field,array(
		'label'=>array(
			'text' => $type 
		)
	) ) ?>
	<?php endforeach ?>
	<?php echo $form->input('contactTypeId',array(
		'type' => 'hidden', 
		'value' => $contactTypeId, 
	)) ?>
<?php echo $form->end('Save') ?>