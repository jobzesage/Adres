<?php foreach ($test as $column): ?>
	<?php  $columnType = $text->getPluginName($column['Field']['field_type_class_name'])?>
	<div>
		<span class='adres-attr name'><?php echo $column['Field']['name'] ?> :</span> 
		<span class = 'adres-attr value'><?php echo $column[$columnType]['data'] ?></span><br/>
	</div>
<?php endforeach ?>
