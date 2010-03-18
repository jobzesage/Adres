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

<div class="adres-contacts-panel span-13">
<?php foreach ($contactTypes as $contactType): ?>	
	<?php echo $html->link('Add Record','#') ?><br/>
	<table border="0" class="adres-datagrid">

		<tr>
            <th>ID</th>
			<?php foreach ($contactType['Field'] as $field): ?>
			<th><?php echo $field['name'] ?></th>
			<?php endforeach ?>
		</tr>
		
		<?php foreach ($values as $realContact): ?>
			<tr>
				<?php foreach ($realContact as $key => $value): ?>
				<td>
					<?php echo $html->link($value,array(
							'controller' => 'users', 
							'action' => 'show_record',
							$realContact['id']),
							array(
								'class' => 'adres-ajax-anchor', 	
							)
						) ?>					
				</td>
				<?php endforeach ?>
			</tr>
		<?php endforeach ?>

	</table>
<?php endforeach ?>
</div>

<div class="adres-right-sidebar span-5">
	<div class="adres-single-record">
		
	</div>
</div>