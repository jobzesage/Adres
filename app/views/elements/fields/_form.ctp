<?php echo $form->create('Field');?>
	<fieldset>
 		<legend><?php __('Add Field');?></legend>

	<?php echo $form->input('id') ?>

 	<?php
		
		echo $form->input('name');
		
		echo $form->input('contact_type_id',array(
			'type'=>'select',
			'options'=>$contact_types
		));
		
		echo $form->input('order');
		
		echo $form->input('field_type_class_name',array(
			'type'=>'select',
			'options'=>$field_types
		));
		
		echo $form->input('is_descriptive');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>