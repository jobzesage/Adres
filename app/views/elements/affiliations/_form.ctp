<?php echo $form->create('Affiliation');?>
	<fieldset>
 		<legend><?php __('Add Affiliation');?></legend>
	<?php
		echo $form->input('contact_type_father_id',array(
			'type'=>'select',
			'options'=>$fatherContactTypes
			)
		);
	?>
	<?php
		echo $form->input('contact_type_child_id',array(
			'type'=>'select',
			'options'=>$childContactTypes
			)
		);
	?>
	<?php	
		echo $form->input('father_name');
	?>
	<?php
		echo $form->input('child_name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>