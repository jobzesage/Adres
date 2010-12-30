<div class="implementations form">
<?php echo $form->create('Implementation');?>
	<fieldset>
 		<legend><?php __('Edit Implementation');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Implementation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Implementation.id'))); ?></li>
		<li><?php echo $html->link(__('List Implementations', true), array('action' => 'index'));?></li>
	</ul>
</div>
