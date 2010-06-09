<?php echo $form->create(null,array(
	'url' => '/users/update_contact',
	'class'=>'adres-ajax-form',
	'id' => 'edit-contact', 
	))?>
<?php echo $form_inputs ?>

<?php echo $form->end('save') ?>
	
<?php //echo $this->element('contacts_details'); ?>	