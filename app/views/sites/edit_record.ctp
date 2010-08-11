<script type="text/javascript">
	$(function(){
		$('form#edit-contact').validate();
		// $('form#edit-contact').find('input.check').click(function(){
		// 	var current_value = $(this).val()
		// 	
		// });
	});	
</script>

<?php echo $form->create(null,array(
	'url' => '/users/update_contact',
	'class'=>'adres-ajax-form',
	'id' => 'edit-contact', 
	))?>
<?php echo $form_inputs ?>
<br />
	<?php echo $form->end(array('label'=>'Save','class'=>'adres-button')) ?>	
