<?php echo $html->tag('h3',__('Assigned Group',true)) ?>	

<?php foreach ($contact['Group'] as $assigned_group	): ?>
	<?php echo $html->tag('span',$assigned_group['name']) ?> 
	<?php echo $html->link('leave',array(
		'controller'=>'groups',
		'action' => 'leave_group', 
		'group_id'=>$assigned_group['id'],
		'contact_id'=>$contact['Contact']['id']
	),
	array('class' => 'adres-ajax-anchor adres-leave-group') 	
	)?> 
<?php endforeach ?>

<?php echo $form->create('Contact',array(
		'url' => array(
			'controller'=>'groups',
			'action' =>'join_group'
		),
		'class' => 'adres-join-group' 
	)) ?>
		
	<?php echo $form->input('group_id',array(
		'options'=>$groups,
		'type' => 'select'
	)) ?>
	<?php echo $form->input('contact_id',array(
		'type' => 'hidden', 
		'value' => $contact['Contact']['id'] 
	)) ?>
<?php echo $form->end('Save') ?>


<?php foreach ($contact['ParentAffiliation'] as $parentAffiliation): ?>
	<?php echo  $parentAffiliation['father_name']?>
	<?php echo  $parentAffiliation['child_name']?>
<?php endforeach ?>

<?php foreach ($contact['ChildAffiliation'] as $childAffiliation): ?>
	<?php echo  $parentAffiliation['father_name']?>
<?php endforeach ?>