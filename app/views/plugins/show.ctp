<?php echo $output ?>
<?php if(!empty($this->params)): ?>

<div class="add_action">
	<ul>
		<li>
			
		<?php echo $html->link('Add' , array(
			'controller'=>'plugins',
			'action' => 'add',
			'field_id' => $this->params['named']['field_id'], 
			'contact_type_id' =>$this->params['named']['contact_type_id']  	
		))?>
	
		</li>
	</ul>
	<div class="clear"></div>
</div>
	
<?php endif ?>