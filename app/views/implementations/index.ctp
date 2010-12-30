<div class="implementations index">
<h2><?php __('Implementations');?></h2>

<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($implementations as $implementation):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
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
			
			<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
			<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>
			
			<?php echo $html->link(__($img_view, true), array('action' => 'view', $implementation['Implementation']['id']), null, null, false)  ?> 
			<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $implementation['Implementation']['id']), null, null, false)  ?> 
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $implementation['Implementation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $implementation['Implementation']['id']), null, null, false)  ?> 
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
		<li><?php echo $html->link(__('New Implementation', true), array('action' => 'add')); ?></li>
	</ul>
</div>
