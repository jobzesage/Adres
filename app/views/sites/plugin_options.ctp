<?php 
	
	echo $output;

?>

<?php echo $html->link('Add', array('controller' => 'plugins', 'action' => 'add',
	'contact_type_id' => $session->read('Contact.contact_type_id'),
	'field_id' => 19  
)); ?>
<?php echo $html->link('Edit', array('controller' => 'plugins', 'action' => 'edit')); ?>

