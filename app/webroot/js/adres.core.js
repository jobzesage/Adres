var ADres={};
ADres.version=0.1;


ADres.AJAX={
	call:function(e){
		console.log('test');
	},
	select:function(e){
		e.stopPropagation();
		e.preventDefault();
		var $select = $(this);
		var $form = $select.closest('form');
		var action = $form.attr('action')+'.json';
			
		$.ajax({
			url:action,
			dataType:'json',
			data:$form.serialize(),
			beforeSend:function(){},
			success:function(resp){
				if(resp.status){
					/*
						TODO have initiate ajax call like ODESK
					*/
				}
			},
			complete:function(){
				
			}
		});
	}
}


ADres.ERROR={
	call:function(e){
	}
}

ADres.LOADER={
	enable:function(){
		
	},
	disable:function(){
		
	}
}


jQuery(document).ready(function() {
	var ajax_options={
		beforeSend:ADres.LOADER.enable,
		complete:ADres.LOADER.disable
	};
	$('.adres-link-ajax').bind('click',ADres.AJAX.call)
	$('.adres-ajax-select').bind('change',ADres.AJAX.select);
});