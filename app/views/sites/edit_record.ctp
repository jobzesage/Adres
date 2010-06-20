<script type="text/javascript">
	$(function(){
		$('form#edit-contact').validate();
	});	
</script>

<?php echo $form->create(null,array(
	'url' => '/users/update_contact',
	'class'=>'adres-ajax-form',
	'id' => 'edit-contact', 
	))?>
<?php echo $form_inputs ?>

<?php echo $form->end(array('label'=>'Save','class'=>'adres-button')) ?>