<?php $contacts = array() ?>
<?php foreach ($values as $value): ?>
	<?php $csv_line = array()?>
	<?php foreach ($value as $key => $data): ?>
		<?php  
			$k = array_keys($data);
			$d= array_values($data);
			$csv_line['Contact'][$k[0]]= $d[0];	
		?>
	<?php endforeach ?>
	<?php $contacts[] = $csv_line; 
	?>
	<?php endforeach ?><?php $csv->addGrid($contacts); echo $csv->render();?>