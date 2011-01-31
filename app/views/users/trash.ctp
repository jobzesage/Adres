<div class="users index">
<h2>Trash</h2>

<table class="adres-datagrid ui-widget">

	<tr style="font-size: 13px; padding-left: 10px; color: #333;">
		<th>Date</th>
		<th>User</th>
		<th>Message </th>
		<th>Contact Type</th>
		<th>Contact ID</th>
		<th>Restore </th>
	</tr>
	
	<?php if (!empty($trashed)): ?>
		<?php foreach ($trashed as $trash): ?>
		<tr>
			<td><?php echo $time->nice($trash['Trash']['log_dt']) ?></td>
			<td><?php echo $trash['Trasher']['username'] ?> </td>
			<td><?php echo $trash['Trash']['description'] ?></td>
			<td><?php echo $trash['ContactType']['name'] ?></td>
			<td><?php echo $trash['Contact']['id'] ?></td>
			
			<?php $img_restore = $html->image("/css/theme1/images/restore.png", array("title"=>"Restore")) ?>
			<td><?php echo $html->link($img_restore,array(
				'controller'=>'contacts',
				'action'=>'restore',
				$trash['Contact']['id']),array(
					'class'=>'adres-delete adres-ajax-anchor'	
				), null, null, false)  ?></td>
		</tr>		
		<?php endforeach ?>	
	<?php else: ?>
		<tr>
			<td colspan="6">
				<?php echo __("Nothing to restore", true) ?>
			</td>
		</tr>	
	<?php endif ?>

</table>
</div>