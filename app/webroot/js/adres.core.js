var ADres={};
ADres.version=0.1;


ADres.AJAX={
	loaderImageSmall:'<img src="/img/loader_small.gif"/>',
	loaderImageLarge:'<img src="/img/loader_large.gif"/>',
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

		var contact_id = $form.find('input#edit-contact-id').val();
				
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
					}else if($form.is('.adres-save-filter')){
						$form.remove();
						$('#adres-saved-filters >.ajax-response').html(resp.data);
					}else if($form.is('#edit-contact')){
						//$('<a class="adres-button adres-ajax-anchor adres-edit" href="/users/show_record/'+contact_id+'">edit</a>').trigger('click');
						ADres.DIALOG.close();
					}
					else if($form.is('#SearchAddForm')){
						$('div#contacts').html(resp.data);
					}else if($form.is('.adres-join-group')){
						$('#adres-groups').html(resp.data);
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
		if($link.hasClass('adres-delete-group')){
			if(!confirm('sure you want to delete this group')){
				return false;
			}
		}
		
		
		$.ajax({
			url:action,
			dataType:'json',
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				if(resp.status){
					if($link.hasClass('adres-delete')){

						$('#adres-dialog').html(resp.data);						
						ADres.DIALOG.open();
						
					}else if($link.hasClass('adres-trash')){
						$link.closest('tr').animate({'backgroundColor':'red'},300);
						$link.closest('tr').fadeOut(200,function(){ 
							$(this).remove();	
						});
					}
					else if($link.hasClass('adres-show')){
						$('#adres-dialog').html(resp.data);
						ADres.DIALOG.open();
					}else if($link.hasClass('adres-edit')){
						$('#adres-dialog').html(resp.data);
						ADres.DIALOG.open();
					}else if($link.hasClass('adres-add')){
						$('#adres-dialog').html(resp.data);
						ADres.DIALOG.open();
					}else if($link.hasClass('adres-contats-show-details')){
						$('#adres-details').html(resp.data);
					}else if ($link.hasClass('adres-delete-keyword')) {
						$('div#contacts').html(resp.data);
					}else if($link.hasClass('adres-delete-filter')){
						$link.closest('.adres-filter').remove();
					}else if($link.hasClass('adres-delete-group')){
						$link.closest('.adres-group').remove();
					}else if($link.hasClass('adres-leave-group')){
						$('#adres-groups').html(resp.data);
					}else if($link.is('.sort')){
						$('#datagrid').replaceWith(resp.data);
					}
					else{
						$('div#contacts').html(resp.data);
					}
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
		$('#adres-contacts-holder').block({
			message:ADres.AJAX.loaderImageLarge,
			centerY:1
		});
	},
	disable:function(){
		//var empty = {}
		//var defaults = { title:"hellp", message:'test' };
		//var settings = $.extend(empty, defaults, options);
		$('#adres-contacts-holder').unblock();
		//$.growlUI(settings.title,settings.message);
	}
}

ADres.DIALOG={
	open:function(){
		$('#adres-dialog').dialog({
			modal:true,
			width:380
		});
	},
	close:function(){
		$('#adres-dialog').dialog("close");		
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
		spinner: ADres.AJAX.loaderImageSmall,
		ajaxOptions:{
			beforeSend:ADres.LOADER.enable,
			complete:ADres.LOADER.disable
		},
		load: function(event, ui) {
        	$('a.adres-tabs-button', ui.panel).click(function(e) {
        	$(ui.panel).load(this.href);
        	e.stopPropagation();
        	return false;
        });	}
	});
	
	
	$('a.adres-contact-tabs-panel').live('click',function(e){
		e.stopPropagation();
		e.preventDefault();
		var $link = $(this);
		var action = $link.attr('href');
		$.ajax({
			url:action,
			//beforeSend:AJAX.LOADER.enable,
			success:function(resp){
				$('#adres-dialog').html(resp);
				ADres.DIALOG.open();
			}
			//complete:AJAX.LOADER.disable	
		});		
	});
	
	$('#toggle-search').live('click',function(e){
		$(this).closest(':header').toggleClass("ui-state-highlight");
		$('#adres-advance-search').toggle('blind',{},500);
		return false;
	});	
	
	$('form#adres-affiliate-form').live('submit',function(e){
		e.stopPropagation();
		e.preventDefault();
		var $form = $(this);
		var action = $form.attr('action');
		$.ajax({
			url:action,
			type:'POST',
			data:$form.serialize(),
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				$form.closest('#adres-affiliation').replaceWith(resp);
			},
			complete:ADres.LOADER.disable			
		});
			
	});
	
	$('.adres-tabs').tabs();
});