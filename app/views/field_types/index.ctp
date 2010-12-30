<div class="fieldTypes index">
<h2><?php __('FieldTypes');?></h2>

<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('class_name');?></th>
	<th><?php echo $paginator->sort('nice_name');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($fieldTypes as $fieldType):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
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
			
			<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
			<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>
			
			<?php echo $html->link(__($img_view, true), array('action' => 'view', $fieldType['FieldType']['class_name']), null, null, false)  ?> 
			<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $fieldType['FieldType']['class_name']), null, null, false)  ?> 
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $fieldType['FieldType']['class_name']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldType['FieldType']['class_name']), null, null, false)  ?> 
			
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 	<span>|</span> 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('New FieldType', true), array('action' => 'add')); ?></li>
	</ul>
</div>
