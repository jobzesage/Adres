<?php echo $form->create('Field');?>
	<fieldset>
 		<legend><?php __('Add Field');?></legend>

	<?php echo $form->input('id') ?>

 	<?php echo $form->input('name') ?>
		
	<?php echo $form->input('contact_type_id',array(
			'type'=>'select',
			'options'=>$contact_types
		));
	?>
	<?php echo $form->input('order') ?>
	
	<?php echo $form->input('field_type_class_name',array(
			'type'=>'select',
			'options'=>$field_types
		));
	?>	
	<?php echo $form->input('is_descriptive')?>
	<?php echo $form->input('required') ?>
	</fieldset>
<?php echo $form->end('Submit');?>