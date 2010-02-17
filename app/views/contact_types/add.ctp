<div class="contactTypes form">
<?php echo $form->create('ContactType');?>
	<fieldset>
 		<legend><?php __('Add ContactType');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('implementation_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ContactTypes', true), array('action' => 'index'));?></li>
	</ul>
</div>
