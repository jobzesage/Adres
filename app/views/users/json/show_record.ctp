<?php foreach ($record as $value): ?>
	<?php foreach ($value as $dataum): ?>
		<div><span> <?php echo $dataum['Field']['name']  ?></span>: <?php echo $dataum['data'] ?></div>
	<?php endforeach ?>
<?php endforeach ?>
<?php echo $this->element('contacts_details'); ?>