<div class="users index">
<h2><?php __('Users');?></h2>

<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('username');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['id']; ?>
		</td>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['created']; ?>
		</td>
		<td class="actions">
			
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>
			
			<?php #echo $html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php #echo $html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id']), null, null, false)  ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
	
<?php echo $this->element('layout/_default_paging') ?>

<div class="add_action">
	<ul>
		<li><?php echo $html->link('Create User', array(
		'controller' => 'users', 
		'action' => 'register', 
	)) ?></li>
	</ul>
	<div class="clear"></div>
</div>