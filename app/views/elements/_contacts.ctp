<div class="adres-left-sidebar">
	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'display_contacts'
		),
		'type'=>'get',
		'class' => 'adres-ajax-search', 
		)) ?>
		<?php echo $form->input('keyword') ?>
		<?php echo $form->hidden('contact_type_id',array(
			'value' => $contactTypeId
		)); ?>
	<?php echo $form->end('Search') ?>
	
	<?php echo $form->create('AdvanceSearch',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'display_contacts'
		),
		'class' => 'adres-ajax-form'
		)) ?>
		
		<?php foreach ($contactTypes as $contactType): ?>
			<?php foreach ($contactType['Field'] as $field): ?>
				
				<?php echo $form->input('AdvanceSearch.column.'.$field['id'],array(
					'type'=>'text',
					'label'=>array(
						'text'=>$field['name']
				))) ?>
			<?php endforeach ?>
		<?php endforeach ?>
		<?php echo $form->hidden('contact_type_id',array(
			'value' => $contactTypeId
		)); ?>			
	<?php echo $form->end('Advance Search') ?>

	
	
	<?php foreach ($contactTypes as $contactType): ?>
		
		<?php echo $html->tag('h3',__('Types',true)) ?>
		
		<?php echo $html->link($contactType['ContactType']['name'],'#')."<br />" ?>

		<?php echo $html->tag('h3',__('Groups',true)) ?>
		
		<?php foreach ($contactType['CurrentGroup'] as $currentGroup): ?>
			<?php echo $html->link($currentGroup['name'],'#')."<br />" ?>
		<?php endforeach ?>
		
	<?php endforeach ?>
	
	
	<?php if ($session->check('Filter.keyword') || $session->check('Filter.criteria')): ?>
		
		<?php echo $html->tag('h3',__('Search',true)) ?>	
		<?php $keyword = $session->read('Filter.keyword') ?>
		<?php if ($session->check('Filter.keyword')): ?>
			<?php echo "Keyword :".$html->link($keyword,array(
				'controller'=>'users',
				'action' => 'delete_keyword', 
				$keyword
			),array(
				'class'=>'adres-ajax-anchor adres-delete-keyword'
			)) ?>
		
		<?php endif ?>
		
		<br>
		
		<?php if ($session->check('Filter.criteria')): ?>
			<?php $criterias = unserialize($session->read('Filter.criteria')) ?>
				<?php echo "Criterias:" ?>
				
				<?php foreach ($criterias as $idx=>$criteria): ?>
				<?php echo $html->link($criteria,array(
					'controller'=>'users',
					'action'    =>'delete_criteria',
					'id:'.$idx.'/criteria:'.$criteria
				)) ?>
				
			<?php endforeach ?>
		<?php endif ?>
		<?php echo $form->create('Filter',array(
			'url'=>array(
				'controller'=>'users',
				'action' => 'save_filter'
			),
			'class' => 'adres-ajax-form'
		)) ?>
			<?php echo $form->input('name') ?>
		<?php echo $form->end('save') ?>
		
	<?php endif ?>
	
	<?php  echo $html->tag('h3',__('Filters',true)) ?>
	
	<?php foreach ($contactTypes as $contactType): ?>
		<?php foreach ($contactType['Filter'] as $filter): ?>
			<?php echo $html->link($filter['name'],array(
				'controller'=>'users',
				'action' => 'load_filter',
				$filter['id']
			)) ?>
		<?php endforeach ?>
	<?php endforeach ?>
	
</div>
<div class="adres-contacts-panel span-11">
	<?php foreach ($contactTypes as $contactType): ?>	
		<?php echo $html->link(__('Add Record',true),array(
			'controller' => 'users', 
			'action' => 'add_record',
			'contact_type:'.$contactType['ContactType']['id']	
		),
		array(
			'class' => 'adres-ajax-anchor adres-add', 
		))
		?>
		<br/>

		<table border="0" class="adres-datagrid">
			<tr>
	            <th>ID</th>
				<?php foreach ($contactType['Field'] as $field): ?>
				
				<th><?php echo $field['name'] ?></th>

				
				<?php endforeach ?>
				<th><?php echo __('Actions',true) ?></th>
			</tr>
			
			<?php if (!empty($values) && isset($values)): ?>
	
			<?php foreach ($values as $realContact): ?>
				<tr id="adres-contact-<?php $realContact['id'] ?>" class="">
					<?php echo $html->tag('td' , $realContact['id']) ?>
					<?php foreach ($realContact['record'] as $key => $value): ?>
					<td>
						<?php echo !empty($value) ? $value['data'] : '&nbsp'?>					
					</td>
					<?php endforeach ?>
					<td>
						<div class="adres-toolbar">
							<?php $span = '<span class=\'ui-icon ui-icon-folder-open\'></sapn>edit' ?>
							<?php echo $html->link(__($span,true),array( 
								'controller' => 'users',
								'action' => 'show_record', 
								$value['contact_id']),array(
									'title' => 'Show Contact', 
									'class' => 'adres-button adres-show adres-ajax-anchor ui-state-default ui-corner-all', 
								),null,false)
							?>							
							<?php $span = '<span class=\'ui-icon ui-icon-pencil\'></sapn>edit' ?>
							<?php echo $html->link(__($span,true),array( 
								'controller' => 'users',
								'action' => 'edit_record', 
								$value['contact_id']),array(
									'title' => 'Edit Contact', 
									'class' => 'adres-button adres-ajax-anchor adres-edit ui-state-default ui-corner-all', 
								),null,false)
							?>
							<?php $span = '<span class=\'ui-icon ui-icon-trash\'></sapn>delete' ?>
							<?php echo $html->link($span,array( 
								'controller' => 'users',
								'action' => 'delete_record', 
								$value['contact_id']),array(
									'title' => 'Delete Contact', 
									'class' => 'adres-button adres-delete adres-ajax-anchor ui-state-default ui-corner-all', 
								),null,false)
							?>						
						</div>
					</td>
				</tr>
			<?php endforeach ?>
			
			
			<?php else: ?>
				<div>
					<?php echo " no records found" ?>
				</div>
			<?php endif  ?>
		</table>
	<?php endforeach ?>	
	
</div>
<div class="adres-right-sidebar span-5">
	<div id="adres-record">
	
	</div>
	<div id="adres-details">
		
	</div>			
</div>
