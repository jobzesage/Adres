<?php echo $html->tag('h3',__('Affiliations',true)) ?>

<?php echo $form->create('AffiliationsContact',array(
	'url' => array(
		'controller' => 'users', 
		'action' => 'affiliate'
	 ))) 
?>
	<?php if (!empty($contact['ParentAffiliation'])): ?>
		<?php foreach ($contact['ParentAffiliation'] as $parentAffiliation): ?>
			<?php echo $parentAffiliation['father_name'] ?>
			<?php $pid = $parentAffiliation['AffiliationsContact']['contact_child_id'] ?>
			<?php echo $form->input('contact_child_id',array('value'=>$pid)) ?>
		<?php endforeach ?>	
	<?php else: ?>
		<?php echo $form->input('contact_child_id') ?>	
	<?php endif ?>

	<?php if (!empty($contact['ChildAffiliation'])): ?>
		<?php foreach ($contact['ChildAffiliation'] as $childAffiliation): ?>
			<?php echo $childAffiliation['child_name'] ?>
			<?php $pid = $childAffiliation['AffiliationsContact']['contact_father_id'] ?>
			<?php echo $form->input('contact_father_id',array('value'=>$pid)) ?>
		<?php endforeach ?>
	<?php else: ?>
		<?php echo $form->input('contact_father_id') ?>
	<?php endif ?>	


<?php echo $form->end("Affilliate") ?>