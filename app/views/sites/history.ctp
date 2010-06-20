<div id="adres-logs">
	<?php //echo $html->tag('h3',__('Modification Logs',true)) ?>
	<table>
		<tr>
			<th>Date</th>
			<th>Desciption</th>
			<th>Author</th>
		</tr>
		<?php foreach ($contact['Log'] as $log): ?>
		<tr>
			<td><?php echo $log['log_dt'] ?> </td>
			<td><?php echo $log['description'] ?> </td>
			<td><?php echo $log['User']['username'] ?> </td>
		</tr>
		<?php endforeach ?>
	</table>	
	
</div>