<div class="contacts index">
<h2><?php __('Contacts');?></h2>
<p>

<table cellpadding="0" cellspacing="0" class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('ContactType.name');?></th>
	<th><?php echo $paginator->sort('trash_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($contacts as $contact):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $contact['Contact']['id']; ?>
		</td>
		<td>
			<?php echo $contact['ContactType']['name']; ?>
		</td>
		<td>
			<?php echo $contact['Contact']['trash_id']; ?>
		</td>
		<td>
			<?php echo $contact['Contact']['created']; ?>
		</td>
		<td>
			<?php echo $contact['Contact']['modified']; ?>
		</td>
		<td class="actions">
			
			<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
			<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>
			
			<?php echo $html->link(__($img_view, true), array('action' => 'view', $contact['Contact']['id']), null, null, false)  ?>
			<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $contact['Contact']['id']), null, null, false)  ?>
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $contact['Contact']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contact['Contact']['id']), null, null, false)  ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<?php echo $this->element('layout/_default_paging') ?>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('New Contact', true), array('action' => 'add')); ?></li>
	</ul>
</div>
