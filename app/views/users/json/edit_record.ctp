<?php echo $form->create('Contact',array('url' => array(
		'controller' => 'users', 
		'action' => 'test',
		$id
		)
	 )) ?>

	<?php foreach ($record as $value): ?>
		<?php $i= 0 ?>
		<?php foreach ($value as $dataum): ?>
			<div>
				<span> <?php echo $dataum['Field']['name']  ?></span>:
				<?php $type = Configure::read('PluginPrefix'). 
				Inflector::camelize($dataum['Field']['field_type_class_name'])?> 
				<?php echo $form->input($type.".{$i}.".$dataum['Field']['id'] ,array(
					'value'=>$dataum['data'],
					'lable'=>$dataum['Field']['name'],
					'div'=>false
					))?>
			</div>
			<?php $i++ ?>
		<?php endforeach ?>
	<?php endforeach ?>

	<?php echo $form->hidden('Contact.id',array(
		'value' => $id
	)) ?>	 
	<?php echo $form->hidden('Contact.contact_type_id',array(
		'value' => $contact['Contact']['contact_type_id']
	)) ?>
<?php echo $form->end('Save',null,array(
		'div' => false, 
		'class' => 'adres-save'
	)) ?>
	
<?php echo $this->element('contacts_details'); ?>	