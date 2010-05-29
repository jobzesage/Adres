var ADres={};
ADres.version=0.1;


ADres.AJAX={
	selectImplementation:function(e){
		e.stopPropagation();
		e.preventDefault();
		var $select = $(this);
		var $form = $select.closest('form');
		var action = $form.attr('action')+'.json';
			
		$.ajax({
			url:action,
			dataType:'json',
			data:$form.serialize(),
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				if(resp.status){
					/*
						TODO have initiate ajax call like ODESK
					*/
				}
			},
			complete:ADres.AJAX.disable
		});
	},
	form_submit:function(e){
		e.stopPropagation();
		e.preventDefault();

		var $form = $(this);
		var action = $form.attr('action')+'.json';

		$.ajax({
			url:action,
			dataType:'json',
			type:'POST',
			data:$form.serialize(),
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				if(resp.status){
					if ($form.hasClass('')) {
						$('#adres-record').html(resp.data);
					}else if($form.is('#AdvanceSearchAddForm')){
						$('div#contacts').html(resp.data);
					}else if($form.is('#FilterAddForm')){
						alert(resp.data);
					}
				}
			},
			complete:ADres.LOADER.disable
		});
	},
	form_search:function(e){
		
		e.stopPropagation();
		e.preventDefault();

		var $form = $(this);
		var action = $form.attr('action')+'.json';

		$.ajax({
			url:action,
			dataType:'json',
			data:$form.serialize(),
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				if(resp.status){
					$('div#contacts').html(resp.data);
				}
			},
			complete:ADres.LOADER.disable
		});		
	},
	
	link:function(e){
		e.stopPropagation();
		e.preventDefault();
		var $link = $(this);
		var action = $link.attr('href')+'.json';
		
		$.ajax({
			url:action,
			dataType:'json',
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				if(resp.status){
					if($link.hasClass('adres-delete')){
						$link.closest('tr').animate({'backgroundColor':'red'},300);
						$link.closest('tr').fadeOut(200,function(){ 
							$(this).remove();	
						});
					}else if($link.hasClass('adres-show')){
						$('#adres-record').html(resp.data);
					}else if($link.hasClass('adres-edit')){
						$('#adres-record').html(resp.data);
					}else if($link.hasClass('adres-add')){
						$('#adres-record').html(resp.data)
					}else if($link.hasClass('adres-contats-show-details')){
						$('#adres-details').html(resp.data);
					}else if ($link.hasClass('adres-delete-keyword')) {
						$('div#contacts').html(resp.data);
					};
				}
			},
			complete:ADres.LOADER.disable
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
	
	//$('.adres-link-ajax').bind('click',ADres.AJAX.call)
	$('.adres-ajax-implementation').bind('change',ADres.AJAX.selectImplementation);
	$('.adres-datagrid tr:even').addClass('zebra');
	$('form.adres-ajax-form').live('submit',ADres.AJAX.form_submit);
	$('form.adres-ajax-search').live('submit',ADres.AJAX.form_search);
	$('a.adres-ajax-anchor').live('click',ADres.AJAX.link);

	// $('form#ContactAddForm').live('submit',ADres.AJAX.form_submit);
	
	
	$('#adres-tabs').tabs({
		load: function(event, ui) {
        	$('a.adres-tabs-button', ui.panel).click(function(e) {
        	$(ui.panel).load(this.href);
        	e.stopPropagation();
        	return false;
        });	}
	});
	
});