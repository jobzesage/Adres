		<?php $field_list=array() ?>
		<?php foreach ($fields as $field): ?>
				<?php 
					/*--------------------------------
					|generating list of fields
					|that are needed to be displayed
					--------------------------------*/
					$field_list[$field['Field']['id']] = $field['Field']['name'];
				?>
		<?php endforeach ?>

		<?php if (!empty($hidden_fields)): ?>
			<?php echo $form->create('Field',array(
				'url' => array(
					'controller' => 'fields', 
					'action'=>'update_hidden'),
				'class'=>'adres-fields-switcher' 
			)) ?>
				<?php echo $form->input('id',array(
					'type'=>'select',
					'options'=>$hidden_fields,
					'label' => false,
					'div' => false, 
				)) ?>
			<?php echo $form->end(array('label'=>'Show','div'=>false)) ?>
		<?php endif ?>
	
		<?php if (!empty($fields)): ?>
			<?php echo $form->create('Field',array(
				'url' => array(
					'controller' => 'fields', 
					'action'=>'hide'
				),
					'class'=>'adres-fields-switcher' 
				)) ?>
				
				<?php echo $form->input('id',array(
					'type'=>'select',
					'options'=>$field_list,
					'label' => false,
					'div' => false, 
				)) ?>
			<?php echo $form->end(array('label'=>'Hide', 'div' =>false)) ?>
			
		<?php endif ?>	