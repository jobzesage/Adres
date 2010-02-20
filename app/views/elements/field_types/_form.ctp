<?php echo $form->create('FieldType');?>
	<fieldset>
 		<legend><?php __('Add FieldType');?></legend>
			<?php echo $form->input('class_name',array('type'=>'text'));	?>
			<?php echo $form->input('nice_name');	?>
	</fieldset>
<?php echo $form->end('Submit');?>