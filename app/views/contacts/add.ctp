<div class="contacts form">
<?php echo $form->create('Contact');?>
	<fieldset>
 		<legend><?php __('Add Contact');?></legend>
	<?php
		echo $form->input('contact_type_id');
		echo $form->input('trash_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('List Contacts', true), array('action' => 'index'));?></li>
	</ul>
</div>
