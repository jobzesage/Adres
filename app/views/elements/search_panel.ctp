	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'search'
		),
		'type'=>'get',
		'class' => 'adres-ajax-search', 
		)) ?>
		<?php echo $form->input('keyword') ?>
		
	<?php echo $form->end('Search') ?>
	
	<?php echo $form->create('AdvanceSearch',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'advance_search'
		),
		'type'=>'get',
		'class' => 'adres-ajax-search'
		)) ?>
		
		<?php foreach ($contactTypes as $contactType): ?>
			<?php foreach ($contactType['Field'] as $field): ?>
				
				<?php echo $form->input('Type.'.$field['id'],array(
					'label'=>array(
						'text'=>$field['name']
				))) ?>
			<?php endforeach ?>
		<?php endforeach ?>
			
	<?php echo $form->end('Advance Search') ?>

	
	
	<?php foreach ($contactTypes as $contactType): ?>
		
		<?php echo $html->tag('h3',__('Types',true)) ?>
		
		<?php echo $html->link($contactType['ContactType']['name'],'#')."<br />" ?>

		<?php echo $html->tag('h3',__('Groups',true)) ?>
		
		<?php foreach ($contactType['CurrentGroup'] as $currentGroup): ?>
			<?php echo $html->link($currentGroup['name'],'#')."<br />" ?>
		<?php endforeach ?>
		
	<?php endforeach ?>
	
	<?php  echo $html->tag('h3',__('Filters',true)) ?>
	
	<?php foreach ($contactTypes as $contactType): ?>
		<?php foreach ($contactType['Filter'] as $filter): ?>
			<?php echo $html->link($filter['name'],'#') ?>
		<?php endforeach ?>
	<?php endforeach ?>