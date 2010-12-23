<div class="adres-left-sidebar adres-column-sp">
	<div class="adres-left-sidebar-top"></div>
	<div class="adres-left-sidebar-mid">
	<?php echo $this->element('left_sidebar') ?>
    </div>
	<div class="adres-left-sidebar-bottom"></div>
</div>

<?php  
/*-------------------------------
| Adres ContactSet panle 
| displays contacts
|--------------------------------*/
?>
<div class="adres-contacts-panel last">

	<div class="adres-right-sidebar-mid">
	<?php
	/*-------------------------------
	| Stored as a element to call on
	| ajax requset
	|--------------------------------*/
	?>		
	<?php echo $this->element('adres_data_grid') ?>
    </div>	
	<div class="adres-right-sidebar-bottom"></div>
	
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