<div class="fields form">
<?php echo $form->create('Field');?>
	<fieldset>
 		<legend><?php __('Add Field');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('contact_type_id');
		echo $form->input('order');
		echo $form->input('field_type_class_name');
		echo $form->input('is_descriptive');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Fields', true), array('action' => 'index'));?></li>
	</ul>
</div>
