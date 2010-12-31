<div class="groups index">
<h2><?php __('Groups');?></h2>

<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('parent_id');?></th>
	<th><?php echo $paginator->sort('contact_type_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($groups as $group):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $group['Group']['id']; ?>	
		</td>
		<td>
			<?php echo $group['Group']['name']; ?>
		</td>
		<td>
			<?php echo $group['Group']['parent_id']; ?>
		</td>
		<td>
			<?php echo $group['ContactType']['name']; ?>
		</td>
		<td>
			<?php echo $group['Group']['created']; ?>
		</td>
		<td class="actions">
			
			<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
			<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>
			
			<?php echo $html->link(__($img_view, true), array('action' => 'view', $group['Group']['id']), null, null, false)  ?> 
			<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $group['Group']['id']), null, null, false)  ?> 
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id']), null, null, false)  ?> 
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<?php echo $this->element('layout/_default_paging') ?>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('New Group', true), array('action' => 'add')); ?></li>
	</ul>
	<div class="clear"></div>
</div>
