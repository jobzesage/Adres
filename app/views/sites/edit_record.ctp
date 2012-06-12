<script type="text/javascript">
	$(function(){
		$('form#edit-contact').validate();
		$('input.date_time').datetime({format:'yy-mm-dd hh:ii:ss'});
	});
</script>

<?php echo $form->create(null,array(
	'url' => '/users/update_contact',
	'class'=>'adres-ajax-form',
	'id' => 'edit-contact',
	))?>

    <?php echo $form_inputs ?>
    <?php echo $form->button('test') ?>
<?php echo $form->end(array('label'=>'Save','class'=>'adres-button')) ?>
