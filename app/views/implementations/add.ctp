<div class="implementations form">
<?php echo $form->create('Implementation');?>
	<fieldset>
 		<legend><?php __('Add Implementation');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('List Implementations', true), array('action' => 'index'));?></li>
	</ul>
	<div class="clear"></div>
</div>
