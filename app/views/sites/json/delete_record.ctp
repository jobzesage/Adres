<?php echo $html->tag('h3', __('Do you really want to delete this item')) ?>
<?php echo $form->create('ContactDelete',array(
	'url'=>array(
		'controller'=>'sites',
		'action'=>'delete_record',
		$id
	)	
)) ?>
	
	<?php echo $form->input('description',array(
		'type'=>'textarea',
		'class'=>'span-8',
		'style'=>'height:150px'
	)) ?>
	<?php echo $form->input('contact_id',array(
		'type'=>'hidden',
		'value'=>$id
	)) ?>
<div id="adres-form-buttons">
	<?php echo $form->button('cancel',array('class' => 'adres-button small')) ?>
	<?php echo $form->end(array('label'=>'Delete','class' => 'adres-button small','div'=>false)) ?>	
</div>
