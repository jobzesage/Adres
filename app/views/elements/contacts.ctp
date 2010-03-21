<div class="adres-left-sidebar span-5">
	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'search'
		),
		'type'=>'get',
		'class' => 'adres-ajax-form', 
		)) ?>
		<?php echo $form->input('keyword') ?>
		
	<?php echo $form->end('Search') ?>
	
	<?php echo $form->create('AdvanceSearch',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'advance_search'
		),
		'type'=>'get'
		)) ?>
		
		<?php foreach ($contactTypes as $contactType): ?>
			<?php foreach ($contactType['Field'] as $field): ?>
				<?php echo $form->input($field['id'],array(
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
	
</div>
<div class="adres-contacts-panel span-11">
	<?php foreach ($contactTypes as $contactType): ?>	
		<?php echo $html->link('Add Record','#') ?><br/>
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
				<tr id="adres-contact-<?php echo $realContact['id']  ?>" class="">
					<?php foreach ($realContact as $key => $value): ?>
					<td>
						<?php echo !empty($value) ? $value : '&nbsp'?>					
					</td>
					<?php endforeach ?>
					<td>
						<div class="adres-toolbar">
							<?php $span = '<span class=\'ui-icon ui-icon-folder-open\'></sapn>edit' ?>
							<?php echo $html->link(__($span,true),array( 
								'controller' => 'users',
								'action' => 'show_record', 
								$realContact['id']),array(
									'title' => 'Show Contact', 
									'class' => 'adres-button adres-ajax-anchor ui-state-default ui-corner-all', 
								),null,false)
							?>							
							<?php $span = '<span class=\'ui-icon ui-icon-pencil\'></sapn>edit' ?>
							<?php echo $html->link(__($span,true),array( 
								'controller' => 'users',
								'action' => 'edit_record', 
								$realContact['id']),array(
									'title' => 'Edit Contact', 
									'class' => 'adres-button ui-state-default ui-corner-all', 
								),null,false)
							?>
							<?php $span = '<span class=\'ui-icon ui-icon-trash\'></sapn>delete' ?>
							<?php echo $html->link($span,array( 
								'controller' => 'users',
								'action' => 'delete_record', 
								$realContact['id']),array(
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
<div class="clearfix"></div>