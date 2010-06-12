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
					'order'=>'asc'
				),array(
					'class' => 'adres-ajax-anchor', 	
				))  ?> 
				| 
				<?php echo $html->link('D', array(
					'controller' => 'users',
					'action' =>'test_paging',
					'page'=>1,
					'sort'=>urlencode($field['Field']['name']),
					'order'=>'desc'					
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