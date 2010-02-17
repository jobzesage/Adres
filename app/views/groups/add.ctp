<div class="groups form">
<?php echo $form->create('Group');?>
	<fieldset>
 		<legend><?php __('Add Group');?></legend>
 		
	<?php echo $form->input('Group.name'); ?>
	<?php echo $form->input('Group.parent_id',array(
		'type'=>'select',
		'options'=>$groups,
		'empty'=>array(0=>__('No Parent',true)),
		'label'=>'Parent Group'
		)); ?>
	
	<?php ?>
	
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Groups', true), array('action' => 'index'));?></li>
	</ul>
</div>
