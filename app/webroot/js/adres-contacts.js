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
			width: ($(window).width() - 215).toString() + "px"	
		})
		
		$(window).resize(function(e){
			$('.adres-contacts-panel').css({
				width: ($(window).width() - 215).toString() + "px"	
			});
		});
		
		// $('.adres-contacts-panel table tr').hover(function(){
		// 		$(this).addClass("highlight");
		// 	},
		// 	function(){
		// 		$(this).removeClass("highlight");
		// });
		
		$('.adres-contacts-panel table tr:even').addClass("tr-even");
		
		$("select").selectmenu({width:150});
				
	});
