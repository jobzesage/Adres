<div class="contactTypes form">
<?php echo $form->create('ContactType');?>
	<fieldset>
 		<legend><?php __('Add ContactType');?></legend>

	<?php echo $form->input('name') ?>

	<?php echo $form->input('implementation_id',array(
		'type'=>'select',
		'options'=>$implementations))?>

	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ContactTypes', true), array('action' => 'index'));?></li>
	</ul>
</div>
