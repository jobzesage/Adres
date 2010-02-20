<div class="fieldTypes form">
<?php echo $form->create('FieldType');?>
	<fieldset>
 		<legend><?php __('Add FieldType');?></legend>
			<?php echo $form->input('class_name');	?>
			<?php echo $form->input('nice_name');	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List FieldTypes', true), array('action' => 'index'));?></li>
	</ul>
</div>
