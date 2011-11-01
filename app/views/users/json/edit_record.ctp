<script type="text/javascript">
	$(function(){
        $('form#edit-contact').validate();
		$("select").selectmenu({width:150});
 
	});	
</script>

<div id="contact-window">
<?php echo $form->create(null,array(
	'url' => '/users/update_contact',
	'class'=>'adres-ajax-form',
	'id' => 'edit-contact'
	))?>
<?php echo $form_inputs ?>

<?php echo $form->end(array('label'=>'Save','class'=>'adres-button')) ?>
	<?php if (preg_match('/add_record/', $this->here)): ?>
		<?php echo $this->element("affiliations/_affiliate") ?>	
		<script type="text/javascript" src="/js/adres-contact-autocompleter.js.php"></script>
	<?php endif ?>
</div>

<?php //echo $this->element('contacts_details'); ?>
