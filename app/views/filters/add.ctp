<div class="filters form">
<?php echo $form->create('Filter');?>
	<fieldset>
 		<legend><?php __('Add Filter');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('List Filters', true), array('action' => 'index'));?></li>
	</ul>
</div>
