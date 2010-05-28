<table border="0" cellspacing="5" cellpadding="5">
	<tr>
	<th>ID</th>
	<?php foreach ($fields as $field): ?>
		<th><?php echo $field['Field']['name'] ?></th>
	<?php endforeach ?>
	</tr>
	<?php foreach ($values as $value): ?>
	<tr>
		<?php foreach ($value as $key => $data): ?>
		<td><?php  $d=array_values($data);	echo $d[0];	?></td>
		<?php endforeach ?>
	</tr>		
	<?php endforeach ?>

</table>