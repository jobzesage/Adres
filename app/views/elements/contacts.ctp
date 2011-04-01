<div class="adres-left-sidebar">
	<?php echo $this->element('left_sidebar') ?>
</div>

<?php  
/*-------------------------------
| Adres ContactSet panle 
| displays contacts
|--------------------------------*/
?>
<div class="adres-contacts-panel">

	<?php
	/*-------------------------------
	| Stored as a element to call on
	| ajax requset
	|--------------------------------*/
	?>		
	<?php echo $this->element('adres_data_grid') ?>
	
</div>

<script src="/js/adres-contacts.js" type="text/javascript"></script>
