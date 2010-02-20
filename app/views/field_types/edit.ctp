<div class="fieldTypes form">
	<?php echo $this->element('field_types/_form') ?>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('FieldType.class_name')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('FieldType.class_name'))); ?></li>
		<li><?php echo $html->link(__('List FieldTypes', true), array('action' => 'index'));?></li>
	</ul>
</div>
