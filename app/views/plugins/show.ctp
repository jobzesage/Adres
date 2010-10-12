<?php echo $output ?>
<?php if(!empty($this->params)): ?>
	<?php echo $html->link('Add' , array(
		'controller'=>'plugins',
		'action' => 'add',
		'field_id' => $this->params['named']['field_id'], 
		'contact_type_id' =>$this->params['named']['contact_type_id']  	
	))?>
<?php endif ?>