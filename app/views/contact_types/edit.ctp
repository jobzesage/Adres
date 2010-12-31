<div class="contactTypes form">
<?php echo $form->create('ContactType');?>

	<fieldset>
 		<legend><?php __('Edit ContactType') ?></legend>
 		
	<?php echo $form->input('id') ?>
	
	<?php echo $form->input('name') ?>
	
	<?php
		echo $form->input('implementation_id',array(
		'type'=>'select',
		'options'=>$implementations))
	?>

	</fieldset>
<?php echo $form->end('Submit');?>

</div>
<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('ContactType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ContactType.id'))); ?></li>
		<li><?php echo $html->link(__('List ContactTypes', true), array('action' => 'index'));?></li>
	</ul>
	<div class="clear"></div>
</div>