<div id="contact-window">

	<h3>Do you really want to delete this item?</h3>

	<?php echo $form->create('ContactDelete',array(
		'url'=>array(
			'controller'=>'sites',
			'action'=>'delete_record',
			$id)	
	)) ?>
	
	<?php echo $form->input('description',array(
		'type'=>'textarea',
		'style'=>'height: 100px; width: 330px;'
	)) ?>
	<?php echo $form->input('contact_id',array(
		'type'=>'hidden',
		'value'=>$id
	)) ?>
	
	<div id="adres-form-buttons">
		<?php echo $form->button('cancel',array('class' => 'adres-button small')) ?>
		<?php echo $form->end(array('label'=>'Delete','class' => 'adres-button small','div'=>false)) ?>	
	</div>

</div>
