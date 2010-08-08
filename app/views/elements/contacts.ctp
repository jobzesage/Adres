<div class="adres-left-sidebar adres-column-sp span-5 ">
	<?php echo $this->element('left_sidebar') ?>
</div>

<?php  
/*-------------------------------
| Adres ContactSet panle 
| displays contacts
|--------------------------------*/
?>
<div class="adres-contacts-panel last span-17">

		 
	<?php
	/*-------------------------------
	| Stored as a element to call on
	| ajax requset
	|--------------------------------*/
	?>		
	<?php echo $this->element('adres_data_grid') ?>	
	
</div>
<script type="text/javascript">
	$(function(){
		$('div#adres-saved-group div#group-tree').jstree({
			'themes':{
				'theme':'apple'
			},
			'plugins':['themes','html_data']
		});
		
	});
</script>