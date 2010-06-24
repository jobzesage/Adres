	
	<div id="adres-affiliation" class="affiliation_container">
		<?php //echo $html->tag('h3',__('Affiliations',true)) ?>
		
		<?php echo $form->create('Affiliate',array(
			'url'=>array(
				'controller'=>'sites',
				'action'=>'affiliate',
				$contact['Contact']['id']	
			),
			'id'=>'adres-affiliate-form'
		)) ?>
			<?php echo $form->input('affiliation_id',array('type'=>'select','options'=>$affiliations)) ?>
			<?php echo $form->input('contact_id') ?>
			<?php echo $form->input('current_contact_id',array(
				'type'=>'hidden',
				'value'=>$contact['Contact']['id']
			)) ?>
		<?php echo $form->end('Affiliate') ?>
		
			
		<?php foreach ($contact['ParentAffiliation'] as $parentAffiliation): ?>
		<div class="adres-affiliations">
 			<?php echo $parentAffiliation['father_name'] ?>
			<?php $pid = $parentAffiliation['AffiliationsContact']['contact_child_id'] ?>
			<?php echo $html->link($pid,array(
				'controller'=>'users',
				'action' => 'show_record', 
				$pid
			),array(
				'class'=>'adres-ajax-anchor adres-show',
			)) ?>
		</div>
		<?php endforeach ?>
		
		<?php foreach ($contact['ChildAffiliation'] as $childAffiliation): ?>
		<div class="adres-affiliations">
			<?php echo $childAffiliation['child_name'] ?>
			<?php $pid = $childAffiliation['AffiliationsContact']['contact_father_id'] ?>
			<?php echo $html->link($pid,array(
				'controller'=>'users',
				'action' => 'show_record', 
				$pid
			),array(
				'class'=>'adres-ajax-anchor adres-show',
			)) ?>
		</div>
		<?php endforeach ?>
		
	</div>
<script type="text/javascript">
	// $(function(){
	// 
	// 			
	// 	$('form#adres-affiliate-form').bind('submit',function(e){
	// 		e.stopPropagation();
	// 		e.preventDefault();
	// 		var $form = $(this);
	// 		var action = $form.attr('action');
	// 
	// 		$.ajax({
	// 			url:action,
	// 			dataType:'json',
	// 			type:'POST',
	// 			data:$form.serialize(),
	// 			beforeSend:ADres.LOADER.enable,
	// 			success:function(resp){
	// 				console.log($('div#adres-affiliation'));	
	// 				$('div.affiliation_container').replaceWith(resp);				
	// 			},
	// 			complete:ADres.LOADER.disable			
	// 		});
	// 	});
	// });
</script>	
	