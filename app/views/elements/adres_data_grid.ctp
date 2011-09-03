<div id="datagrid">
	<div id="adres-basic-panel" class="adres-panel">
		<?php echo $html->link('New', array(
			'controller'=>'users',
			'action'=>'add_record'),array(
				'class'=>'adres-button  small adres-ajax-anchor  adres-add ui-state-default ui-corner-all basic' ))
		 ?>
		 
		<?php echo $html->link('Export File ('.$count.')', array(
			'controller'=>'users',
			'action'=>'export.csv'
			),array(
				'class' => 'adres-button small ui-state-default ui-corner-all basic' )
		) ?>


        <?php
            $email='';
            foreach ($fields as $field){
                if($field['Field']['field_type_class_name']=='TypeEmail'){
                    $email= $field['Field']['id'];
                } 
	    	}
	    ?>


		<?php echo $html->link('Send Email ('.$count.')', array(
			'controller'=>'mailer',
            'action'=>'open_message',
            $email
			),array(
                'class' => 'adres-button adres-ajax-anchor small ui-state-default ui-corner-all basic' ,
                'id'=>'send_email'
			),null,null,false
		) ?>
		<?php echo $html->link('<strike>Send SMS</strike>', array(
			'controller'=>'users',
			'action'=>'#'
			),array(
				'class' => 'adres-button small ui-state-default ui-corner-all basic' 			
			),null,null,false
		) ?>	
		
		<?php echo $this->element('field_switchers') ?>
	
	</div>	
	
	<?php if (!empty($values) && isset($values)): ?>

	<div id="main_table">

	<table border="0" class="adres-datagrid">
		<thead>
		<tr>
			<th style="min-width: 25px;">ID</th>
			<?php foreach ($fields as $field): ?>

				<th style="min-width: 150px;">
					
					<?php $img_a = $html->image("/css/theme1/images/up_arrow.png") ?>
					<?php $img_d = $html->image("/css/theme1/images/down_arrow.png") ?>
					
					<span class="field_name">
						<?php echo $field['Field']['name'] ?>
						<?php if ($field['Field']['field_type_class_name'] == "TypeEncrypt"): ?>
							<div class="encrypt">
								<?php echo $form->create("Contact",array('url'=>array(
									'controller' => 'sites', 
									'action' => 'interact'
								),
								'class' => 'adres-ajax-form'
								)) ?>
									<?php echo $form->input("key") ?>
									<?php echo $form->input("field_id", array(
										'type' => 'hidden',
										'value' => $field['Field']['id']  
									)) ?>
								<?php echo $form->end("Submit") ?>
							</div>	
						<?php endif ?>
					</span>
					
					<div class="up-down">
					
							<?php echo $html->link($img_a,array(
								'controller' => 'users',
								'action' => 'paging',
								'page'=>isset($paging['page']) ? $paging['page'] : 1,
								'sort'=>urlencode($field['Field']['name']),
								'order'=>'asc'
							),array(
								'class' => 'adres-ajax-anchor sort', 	
							), null, null, false)  ?> 
							<span>|</span> 
							<?php echo $html->link($img_d,array(
								'controller' => 'users',
								'action' =>'paging',
								'page'=>isset($paging['page']) ? $paging['page'] : 1,
								'sort'=>urlencode($field['Field']['name']),
								'order'=>'desc'					
							),array(
								'class' => 'adres-ajax-anchor sort', 	
							), null, null, false)  ?>
							
					</div>
					
				</th>
			<?php endforeach ?>
			<th style="min-width: 50px;">Links</th>
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
					
						<?php echo $html->link("del",array( 
							'controller' => 'sites',
							'action' => 'show_contact_panel', 
							$value['Contact']['id']),array(
								'title' => 'Edit Contact', 
								'class' => 'adres-edit', 
							),null,false)
						?>	

						<?php echo $html->link("del",array( 
							'controller' => 'sites',
							'action' => 'delete_record', 
							$value['Contact']['id']),array(
								'title' => 'Delete Contact', 
								'class' => 'adres-delete adres-ajax-anchor', 
							),null,false)
						?>				
				</div>
			</td>
		</tr>		
		<?php endforeach ?>
	</table>
			<?php else: ?>
					<div class="no-record">
					<?php echo "No Records Found" ?>
					</div>
			<?php endif  ?>
	</table>
	
	</div>

	<?php echo $this->element('paginator')?>
	
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var header_index = 0;
		header_index = $.cookie('header_index');
		if(header_index){
			$('table.adres_data_grid > tbody > tr > td:nth-child('+header_indx+')').css("background","#f2f2f2");
		}	
	});
	
</script>
