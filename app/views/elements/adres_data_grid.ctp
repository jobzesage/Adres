<div id="datagrid" >
	<div id="adres-basic-panel" class="adres-panel">
		<?php echo $html->link('New', array(
			'controller'=>'users',
			'action'=>'add_record'),array(
				'class'=>'adres-button  small adres-ajax-anchor  adres-add ui-state-default ui-corner-all' ))
		 ?>
		 
		<?php echo $html->link('Export File('.$count.')', array(
			'controller'=>'users',
			'action'=>'export.csv'
			),array(
				'class' => 'adres-button small ui-state-default ui-corner-all' )
		) ?>
		
		<?php echo $html->link('<strike>Send Email('.$count.')</strike>', array(
			'controller'=>'users',
			'action'=>'#'
			),array(
				'class' => 'adres-button small ui-state-default ui-corner-all' 
			),null,null,false
		) ?>
		<?php echo $html->link('<strike>Send SMS</strike>', array(
			'controller'=>'users',
			'action'=>'#'
			),array(
				'class' => 'adres-button small ui-state-default ui-corner-all' 			
			),null,null,false
		) ?>	
		
		<?php echo $this->element('field_switchers') ?>
	

	</div>	
	
	<hr class="space" />
	<?php if (!empty($values) && isset($values)): ?>


	<table border="0" class="adres-datagrid">
		<thead>
		<tr>
			<th>ID</th>
			<?php foreach ($fields as $field): ?>

				<th>
					<?php echo $field['Field']['name'] ?>
					<?php echo $html->link('A', array(
						'controller' => 'users',
						'action' => 'paging',
						'page'=>isset($paging['page']) ? $paging['page'] : 1,
						'sort'=>urlencode($field['Field']['name']),
						'order'=>'asc'
					),array(
						'class' => 'adres-ajax-anchor sort', 	
					))  ?> 
					| 
					<?php echo $html->link('D', array(
						'controller' => 'users',
						'action' =>'paging',
						'page'=>isset($paging['page']) ? $paging['page'] : 1,
						'sort'=>urlencode($field['Field']['name']),
						'order'=>'desc'					
					),array(
						'class' => 'adres-ajax-anchor sort', 	
					)
					)  ?>
				</th>
			<?php endforeach ?>
			<th>Links</th>
		</tr>
		</thead>
		<?php foreach ($values as $value): ?>
		<tr>
			<?php foreach ($value as $key => $data): ?>
			<td><?php  $d=array_values($data);	
				echo $html->link($d[0],array(
					'controller'=>'users',
					'action'=>'show_contact_panel',
					$value['Contact']['id']),
					array(
						'class'=>'adres-contact-tabs-panel'	
					)	
				);	?>
			</td>
			<?php endforeach ?>
			<td>
				<div class="adres-toolbar">
					<!--
					<?php $span = '<span class=\'ui-icon ui-icon-trash \'></sapn>edit';
						$span = 'delete';	
				 	?>
					<?php echo $html->link(__($span,true),array( 
						'controller' => 'users',
						'action' => 'show_contact_panel', 
						$value['Contact']['id']),array(
							'title' => 'Edit Contact', 
							'class' => 'adres-button small adres-contact-tabs-panel ui-state-default ui-corner-all', 
						),null,false)
					?>
					
					<?php $span = '<span class=\'ui-icon ui-icon-pencil\'></sapn>edit';
						$span = 'edit';	
					 ?>
					<?php echo $html->link(__($span,true),array( 
										'controller' => 'users',
										'action' => 'edit_record', 
										$value['Contact']['id']),array(
											'title' => 'Edit Contact', 
											'class' => 'adres-button small adres-ajax-anchor adres-edit ui-state-default ui-corner-all', 
										),null,false)
									?>
									-->					
									<?php $span = '<span class=\'ui-icon ui-icon-trash\'></sapn>delete';
											$span = 'del';	
									 ?>
									<?php echo $html->link($span,array( 
										'controller' => 'sites',
										'action' => 'delete_record', 
										$value['Contact']['id']),array(
											'title' => 'Delete Contact', 
											'class' => 'adres-button small adres-delete adres-ajax-anchor ui-state-default ui-corner-all', 
										),null,false)
									?>				
				</div>
			</td>
		</tr>		
		<?php endforeach ?>
	</table>
			<?php else: ?>
					<?php echo " no records found" ?>
			<?php endif  ?>
	</table>

	<?php echo $this->element('paginator')?>
	


</div>
