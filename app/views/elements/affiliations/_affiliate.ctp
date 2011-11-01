	
	<div id="adres-affiliation" class="affiliation_container">
		<?php //echo $html->tag('h3',__('Affiliations',true)) ?>
		
		<?php echo $form->create('Affiliate',array(
			'url'=>array(
				'controller'=>'sites',
				'action'=>'affiliate',
				$contactId
			),
			'id'=>'adres-affiliate-form'
		)) ?>
			<?php echo $form->input('affiliation_id',array(
				'type'=>'select',
				'options'=>$affiliations
				)
			) ?>
			<?php echo $form->input('autocompleter') ?>
			<?php echo $form->hidden('contact_id') ?>
			<?php echo $form->input('current_contact_id',array(
				'type'=>'hidden',
				'value'=>$contactId
			)) ?>
		<?php echo $form->end('Affiliate') ?>
		

	</div>
	