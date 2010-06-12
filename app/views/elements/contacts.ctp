
<div class="adres-left-sidebar span-5">
	
	<?php  
	/*-------------------------------
	| Keyword Search Section
	|--------------------------------*/
	?>
	
	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'add_keyword'
		),
		'type'=>'get',
		'class' => 'adres-ajax-search', 
		)) ?>
		<?php echo $form->input('keyword') ?>
		<?php echo $form->hidden('contact_type_id',array(
			'value' => 5
		)); ?>
	<?php echo $form->end('Search') ?>
	
	
	
	<?php  
	/*-------------------------------
	| Advance Search Section
	|--------------------------------*/
	?>

	<?php echo $form->create('AdvanceSearch',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'add_criteria'
		),
		'class' => 'adres-ajax-form'
		)) ?>
		
		<?php foreach ($fields as $field): ?>
			
			<?php echo $form->input($field['Field']['id'],array(
				'type'=>'text',
				'label'=>array(
					'text'=>$field['Field']['name']
			))) ?>
		<?php endforeach ?>			
		
	<?php echo $form->end('Advance Search') ?>


	<?php  
	/*-------------------------------
	| Groups Filter Section
	|--------------------------------*/
	?>
	
	<br /><br />

	<?php if (isset($groups) and !empty($groups)): ?>
		<div id="adres-saved-group">
		<?php echo $html->tag('h3',__('Groups',true)) ?>		

		<?php foreach ($groups as $group): ?>
			
			<div class="adres-group">
				<?php echo $html->link($group['Group']['name'],array(
						'controller'=>'users',
						'action'=>'load_group',
						$group['Group']['id']	
					),array(
						'class'=>'adres-ajax-anchor adres-load-group'	
					)
				)?>
				
				<?php echo $html->link('(x)',array(
					'controller'=>'groups',
					'action' => 'delete',
					$group['Group']['id']
				),array(
					'class'=>'adres-ajax-anchor adres-delete-group'			
				)
				) ?>					
			</div>
		
		<?php endforeach ?>
		</div><!-- adres-groups -->

	<?php endif ?>




	<?php  
	/*-------------------------------
	| Keyword Filter Section
	|--------------------------------*/
	?>
	
	<?php if ($session->check('Filter.keyword') || $session->check('Filter.criteria')): ?>
		
			
		<?php echo $html->tag('h3',__('Loaded Filters',true)) ?>	
		<?php $keyword = $session->read('Filter.keyword') ?>

		<?php if ($session->check('Filter.keyword')): ?>
			<div class="adres-criteria">
				<?php echo $html->link("Keyword :{$keyword}",array(
					'controller'=>'users',
					'action' => 'delete_keyword', 
					$keyword
				),array(
					'class'=>'adres-ajax-anchor adres-delete-keyword'
				)) ?>				
			</div>
		<?php endif ?>

		<br>
		
		
	<?php  
	/*-------------------------------
	| Criteria Filter Section
	|--------------------------------*/
	?>
			

		
		<?php if ($session->check('Filter.criteria')): ?>
			<?php $criterias = unserialize($session->read('Filter.criteria')) ?>

				<?php echo "Criterias:" ?>
				
			<?php foreach ($criterias as $idx => $criteria): ?>
			<div class="adres-criteria">					
				<?php echo $html->link($criteria['name'],array(
					'controller'=>'users',
					'action'    =>'delete_criteria',
					'id:'.$idx
					),
					array(
					'class'=>'adres-ajax-anchor'	
					)
				) ?>
			</div>				
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
	
	
	<br /><br />
	
	
	
	<?php  
	/*-------------------------------
	| Saved Filter Section
	|--------------------------------*/
	?>
			
	
	<div id="adres-saved-filters">

	<?php  echo $html->tag('h3',__('Filters',true)) ?>
	
	<?php foreach ($filters as $filter): ?>
		<div class='adres-filter'>
			<?php echo $html->link($filter['Filter']['name'],array(
				'controller'=>'users',
				'action' => 'load_filter',
				$filter['Filter']['id']
			),array(
				'class'=>'adres-ajax-anchor'			
			)
			) ?>
			
			<?php echo $html->link('(x)',array(
				'controller'=>'filters',
				'action' => 'delete',
				$filter['Filter']['id']
			),array(
				'class'=>'adres-ajax-anchor adres-delete-filter'			
			)
			) ?>			
		</div>
	<?php endforeach ?>	
	</div><!-- // adres-saved-filters -->
	
</div>

<?php  
/*-------------------------------
| Adres ContactSet panle 
| displays contacts
|--------------------------------*/
?>
<div class="adres-contacts-panel span-11">
	
	<?php echo $html->link('Export', array('controller'=>'users','action'=>'export.csv')) ?>
	<?php echo $html->link('Add Contact', array('controller'=>'users','action'=>'add_record'),array('class'=>'adres-ajax-anchor adres-add' )) ?>	
	<?php if (!empty($values) && isset($values)): ?>

	<table border="0" class="adres-datagrid">
		<tr>
		<th>ID</th>
		
		<?php foreach ($fields as $field): ?>
			<th>
				<?php echo $field['Field']['name'] ?>
				<?php echo $html->link('A', array(
					'controller' => 'users',
					'action' => 'test_paging',
					'page'=>1,
					'sort'=>urlencode($field['Field']['name']),
					'direc'=>'asc'
				),array(
					'class' => 'adres-ajax-anchor', 	
				))  ?> 
				| 
				<?php echo $html->link('D', array(
					'controller' => 'users',
					'action' =>'test_paging',
					'page'=>1,
					'sort'=>urlencode($field['Field']['name']),
					'direc'=>'desc'					
				),array(
					'class' => 'adres-ajax-anchor', 	
				)
				)  ?>
			</th>
		<?php endforeach ?>
		<th>Links</th>
		</tr>
		<?php foreach ($values as $value): ?>
		<tr>
			<?php foreach ($value as $key => $data): ?>
			<td><?php  $d=array_values($data);	echo $d[0];	?></td>
			<?php endforeach ?>
			<td>
				<div class="adres-toolbar">
					<?php $span = '<span class=\'ui-icon ui-icon-folder-open\'></sapn>edit' ?>
					<?php echo $html->link(__($span,true),array( 
						'controller' => 'users',
						'action' => 'show_record', 
						$value['Contact']['id']),array(
							'title' => 'Edit Contact', 
							'class' => 'adres-button adres-ajax-anchor adres-edit ui-state-default ui-corner-all', 
						),null,false)
					?>
					
					<?php $span = '<span class=\'ui-icon ui-icon-pencil\'></sapn>edit' ?>
					<?php echo $html->link(__($span,true),array( 
						'controller' => 'users',
						'action' => 'edit_record', 
						$value['Contact']['id']),array(
							'title' => 'Edit Contact', 
							'class' => 'adres-button adres-ajax-anchor adres-edit ui-state-default ui-corner-all', 
						),null,false)
					?>
										
					<?php $span = '<span class=\'ui-icon ui-icon-trash\'></sapn>delete' ?>
					<?php echo $html->link($span,array( 
						'controller' => 'users',
						'action' => 'delete_record', 
						$value['Contact']['id']),array(
							'title' => 'Delete Contact', 
							'class' => 'adres-button adres-delete adres-ajax-anchor ui-state-default ui-corner-all', 
						),null,false)
					?>						
				</div>
			</td>
		</tr>		
		<?php endforeach ?>
	
	</table>
			
			
			<?php else: ?>
				<div>
					<?php echo " no records found" ?>
				</div>
			<?php endif  ?>
		</table>
	
</div>
<div class="adres-right-sidebar span-5">
	<div id="adres-record">
	
	</div>
	<div id="adres-details">
		
	</div>			
</div>
