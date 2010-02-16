<div class="filters form">
<?php echo $form->create('Filter');?>
	<fieldset>
 		<legend><?php __('Edit Filter');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Filter.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Filter.id'))); ?></li>
		<li><?php echo $html->link(__('List Filters', true), array('action' => 'index'));?></li>
	</ul>
</div>
