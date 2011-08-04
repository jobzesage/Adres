<?php echo $form->create(null,array(
	'url' => '/sites/interact',
	'class'=>'adres-ajax-form',
	'id' => 'edit-contact', 
))?>
	<?php echo $form->input("key",array('class' => 'text')) ?>

<?php echo $form->end(array('label'=>'Submit','class'=>'adres-button')) ?>