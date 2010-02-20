<div class="fieldTypes form">
<?php echo $form->create('FieldType');?>
	<fieldset>
 		<legend><?php __('Edit FieldType');?></legend>
	<?php
		echo $form->input('class_name');
		echo $form->input('nice_name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('FieldType.class_name')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('FieldType.class_name'))); ?></li>
		<li><?php echo $html->link(__('List FieldTypes', true), array('action' => 'index'));?></li>
	</ul>
</div>
