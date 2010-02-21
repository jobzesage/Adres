<div class="fieldTypes index">
<h2><?php __('FieldTypes');?></h2>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('class_name');?></th>
	<th><?php echo $paginator->sort('nice_name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($fieldTypes as $fieldType):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $fieldType['FieldType']['class_name']; ?>
		</td>
		<td>
			<?php echo $fieldType['FieldType']['nice_name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $fieldType['FieldType']['class_name'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $fieldType['FieldType']['class_name'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $fieldType['FieldType']['class_name']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldType['FieldType']['class_name'])); ?>
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
		<li><?php echo $html->link(__('New FieldType', true), array('action' => 'add')); ?></li>
	</ul>
</div>
