<div class="implementations index">
<h2><?php __('Implementations');?></h2>

<table class="adres-datagrid" >
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($implementations as $implementation):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $implementation['Implementation']['id']; ?>
		</td>
		<td>
			<?php echo $implementation['Implementation']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $implementation['Implementation']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $implementation['Implementation']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $implementation['Implementation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $implementation['Implementation']['id'])); ?>
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
		<li><?php echo $html->link(__('New Implementation', true), array('action' => 'add')); ?></li>
	</ul>
</div>
