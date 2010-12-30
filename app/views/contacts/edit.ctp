<div class="contacts form">
<?php echo $form->create('Contact');?>
	<fieldset>
 		<legend><?php __('Edit Contact');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('contact_type_id');
		echo $form->input('trash_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Contact.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Contact.id'))); ?></li>
		<li><?php echo $html->link(__('List Contacts', true), array('action' => 'index'));?></li>
	</ul>
</div>
