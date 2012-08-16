<?php
	/**
	 * here id stands for the database field_id of contact_types
	 * to send the emails to proper contacts
	 */
	echo $form->create("Mailer",array(
        'url' => array(
			'controller' => 'aw_ses/main/',
            'action' => 'view',
            $session->read('Contact.contact_type_id'),
			'field_id'=>$id
		)
	)) ?>
	<div class="mailer">
		<?php echo $form->input("from",array('value'=>'ADres')) ?>
		<?php echo $form->input("subject") ?>
		<?php echo $form->input("message",array("type"=>"textarea")) ?>
		<?php echo $form->end("Send") ?>
	</div>
