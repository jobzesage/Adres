<?php echo $form->create('Contact',array('url' => array(
		'controller' => 'users', 
		'action' => 'test',
		$id
		)
	 )) ?>

	<?php foreach ($record as $value): ?>
		<?php foreach ($value as $dataum): ?>
			<div><span> <?php echo $dataum['Field']['name']  ?></span>: <?php echo $dataum['data'] ?></div>
		<?php endforeach ?>
	<?php endforeach ?>

	<?php echo $form->hidden('Contact.id',array(
		'value' => $id
	)) ?>	 
	<?php echo $form->hidden('Contact.contact_type_id',array(
		'value' => $contact['Contact']['contact_type_id']
	)) ?>
<?php echo $form->end('Save',null,array(
		'div' => false, 
		'class' => 'adres-save'
	)) ?>