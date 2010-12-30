<div class="filters index">
<h2><?php __('Filters');?></h2>
<table class="adres-datagrid">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('ContactType.name');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($filters as $filter):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $filter['Filter']['id']; ?>
		</td>
		<td>
			<?php echo $filter['Filter']['name']; ?>
		</td>
		<td>
			<?php echo $filter['ContactType']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $filter['Filter']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $filter['Filter']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $filter['Filter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $filter['Filter']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Filter', true), array('action' => 'add')); ?></li>
	</ul>
</div>
