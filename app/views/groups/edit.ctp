<div class="groups form">
<?php echo $form->create('Group');?>
	<fieldset>
 		<legend><?php __('Edit Group');?></legend>
 		
	<?php echo $form->input('id') ?>
	
	<?php echo $form->input('name')	?>
	
	<?php echo $form->input('Group.parent_id',array(
		'type'=>'select',
		'options'=>$groups,
		'empty'=>array(0=>__('No Parent',true)),
		'label'=>'Parent Group'
	)); ?>
	
	<?php echo $form->input('Group.contact_type_id',array(
			'type'=>'select',
			'options'=>$contactTypes))
	 ?>

	
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Group.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Group.id'))); ?></li>
		<li><?php echo $html->link(__('List Groups', true), array('action' => 'index'));?></li>
	</ul>
</div>
