<table border="0">
	<tr>
		<th>Date  </th>
		<th>User </th>
		<th>Message </th>
		<th>Contact Type </th>
		<th>Contact ID</th>
		<th> Restore </th>
	</tr>
	<?php foreach ($trashed as $trash): ?>
	<tr>
		<td><?php echo $time->nice($trash['Trash']['log_dt']) ?></td>
		<td><?php echo $trash['Trasher']['username'] ?> </td>
		<td><?php echo $trash['Trash']['description'] ?></td>
		<td><?php echo $trash['ContactType']['name'] ?></td>
		<td><?php echo $trash['Contact']['id'] ?></td>
		<td> <?php echo $html->link('Restore',array(
			'controller'=>'contacts',
			'action'=>'restore',
			$trash['Contact']['id']),array(
				'class'=>'adres-button small adres-delete adres-ajax-anchor ui-state-default ui-corner-all'	
			)	
		) ?> </td>
	</tr>		
	<?php endforeach ?>
</table>