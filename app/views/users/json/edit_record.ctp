<?php echo $form->create('Contact',array('url' => array(
		'controller' => 'users', 
		'action' => 'test',
		$id
		)
	 )) ?>

	<?php $i=0 ?>
	 
	 <?php foreach ($record as $colum_name => $values): ?>
		<?php echo $form->input($values['plugin'].".$i.".$values['field_id'],array(
			'type' => 'text', 
			'value' => $values['data'], 
			'label' =>array(
				'for' => $colum_name, 
				'text'=> $colum_name,
			)
		)) ?>
		
		<?php $i++ ?>
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