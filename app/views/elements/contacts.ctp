<div class="adres-left-sidebar">
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
<div class="adres-contacts-panel">

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
		
		
		$('.adres-contacts-panel table tr').each(function(i,d){
   			 $(d).find('td:last').css({borderRight:'1px solid #e2dfdf'});
   			 $(d).find('th:last').css({borderRight:'1px solid #ccc'});
		});
		
		$('.adres-contacts-panel table tr:last td').css({borderBottom:'1px solid #e2dfdf'});

		$('.adres-contacts-panel').css({
			width: ($(window).width() - 213).toString() + "px"	
		})
		
		$(window).resize(function(e){
			$('.adres-contacts-panel').css({
				width: ($(window).width() - 213).toString() + "px"	
			});
		});
		
		$('.adres-contacts-panel table tr').hover(function(e){
			$(this).toggleClass("tr-select");
		});
		
		$('.adres-contacts-panel table tr:even').addClass("tr-even");
	});
	

	
	
</script>