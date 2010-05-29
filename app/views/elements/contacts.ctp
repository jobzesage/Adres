
<div class="adres-left-sidebar span-5">
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
</div>


<div class="adres-contacts-panel span-11">
			
	<?php if (!empty($values) && isset($values)): ?>

	<table border="0" cellspacing="5" cellpadding="5">
		<tr>
		<th>ID</th>
		<?php foreach ($fields as $field): ?>
			<th><?php echo $field['Field']['name'] ?></th>
		<?php endforeach ?>
		</tr>
		<?php foreach ($values as $value): ?>
		<tr>
			<?php foreach ($value as $key => $data): ?>
			<td><?php  $d=array_values($data);	echo $d[0];	?></td>
			<?php endforeach ?>
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
