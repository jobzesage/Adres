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
			<?php echo $form->input('affiliation_id',array('type'=>'select','options'=>$affiliations)) ?>
			<?php echo $form->input('autocompleter') ?>
			<?php echo $form->input('contact_type_id', array('type' => 'select','values' => $contactTypes )) ?>
			<?php echo $form->hidden('contact_id') ?>
			<?php echo $form->input('current_contact_id',array(
				'type'=>'hidden',
				'value'=>$contactId
			)) ?>
		<?php echo $form->end('Affiliate') ?>
		
	
		<table>
			<tr>
				<th><?php echo $descriptiveFields ?></th>	
				<th>Affiliations</th>
			</tr>	
		
			<?php foreach ($contact as $affiliation): ?>
			<tr>
				<td>
					<?php 
					echo $name ." &nbsp";	
				 	?>
				</td>
				<td> 
					<div class="adres-affiliations">
						<?php echo $affiliation['affiliation_type'] ?>
						
						<?php $pid = $affiliation['affiliated_contact_id'] ?>
						<?php echo $html->link($affiliation['affiliated_to'],array(
							'controller'=>'users',
							'action' => 'show_record', 
							$pid
						),array(
							'class'=>'adres-ajax-anchor adres-show',
						)) ?>
					</div>
				</td>
			</tr>
			<?php endforeach ?>
	
		</table>
	</div>
	
	
<script type="text/javascript" src="/js/adres-contact-autocompleter.js.php"></script>
