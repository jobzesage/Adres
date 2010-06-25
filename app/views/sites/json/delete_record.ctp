<?php echo $html->tag('h3', __('Do you really want to delete this item')) ?>
<?php echo $form->create('ContactDelete',array(
	'url'=>array(
		'controller'=>'sites',
		'action'=>'delete_record',
	)	
)) ?>
	<?php echo $form->input('description',array(
		'type'=>'textarea',
		'class'=>'span-8',
		'style'=>'height:150px'
	)) ?>
<div id="adres-form-buttons">
	<?php echo $form->button('cancel',array('class' => 'adres-button small')) ?>
	<?php echo $form->end(array('label'=>'Search','class' => 'adres-button small','div'=>false)) ?>	
</div>
