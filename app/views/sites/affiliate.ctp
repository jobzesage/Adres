	
	<div id="adres-affiliation">
		<?php //echo $html->tag('h3',__('Affiliations',true)) ?>
		
		<?php foreach ($contact['ParentAffiliation'] as $parentAffiliation): ?>
			<?php echo $parentAffiliation['father_name'] ?>
			<?php $pid = $parentAffiliation['AffiliationsContact']['contact_child_id'] ?>
			<?php echo $html->link($pid,array(
				'controller'=>'users',
				'action' => 'show_record', 
				$pid
			),array(
				'class'=>'adres-ajax-anchor adres-show',
			)) ?>
		<?php endforeach ?>
		
		<?php foreach ($contact['ChildAffiliation'] as $childAffiliation): ?>
			<?php echo $childAffiliation['child_name'] ?>
			<?php $pid = $childAffiliation['AffiliationsContact']['contact_father_id'] ?>
			<?php echo $html->link($pid,array(
				'controller'=>'users',
				'action' => 'show_record', 
				$pid
			),array(
				'class'=>'adres-ajax-anchor adres-show',
			)) ?>
				
		<?php endforeach ?>
		
	</div>