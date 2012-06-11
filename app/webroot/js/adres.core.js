window.ADres={} ;
ADres.version=0.1;
var UI=null

ADres.SELECT = {
    affiliated_filters:function(e){
        if($('.adres-affiliation-switch').val() < 2){
            return false; // for advance search not to trigger ajax call
        }
        var $affiliation_select = $(this);
        var id = $(this).val();
        var source = $("#filters_template").html();
        var template = Handlebars.compile(source);

        $.getJSON('/filters/affiliations/'+id +'.json' ,function(data){
            $('#AffiliationFilterId')
              .replaceWith(template(data));
            $('#AffiliationFilterId')
              .bind('change',function(e){
                var filter = $(this).val();
                var affiliation = $('#AffiliationAffiliationId').val();
                ADres.SELECT.autocomplete_affliation(affiliation, filter);
            });
        });
    },
	update_contact_picker:function(e){
		ADres.SELECT.autocomplete_affliation($(this).val());
	},
	autocomplete_affliation:function(contact_id, filter){
        if(typeof filter === 'undefined') filter = 0;

		$('#AffiliateAutocompleter, input.adres-contact-picker').autocomplete({
	  		source: '/sites/contact_picker.json?affiliation_id='+ contact_id +'&filter='+ filter,
	  		select: function( event, ui ) {
	  			$('input#AffiliateContactId').val(ui.item.id);
	  		}
	  	});

	  	//ui autocomplete highlight hack
	   	$.ui.autocomplete.prototype._renderItem = function (ul, item) {
	  	     item.label = item.label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(this.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
	  	     return $("<li></li>")
	  	             .data("item.autocomplete", item)
	  	             .append("<a>" + item.label + "</a>")
	  	             .appendTo(ul);
	  	 };
	}
}

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
					}
					else if($form.hasClass('settings_form')){
						adresTabReload();
					}
					else if($form.is('#AdvanceSearchAddForm') || $form.is('#AffiliationAddForm') ){
						$('div#contacts').html(resp.data);
						ADres.DIALOG.close();
					}
					else if($form.is('.adres-save-filter')){
						$form.remove();
						$('#adres-saved-filters >.ajax-response').html(resp.data);
					}
					else if($form.is('#edit-contact')){
						ADres.DIALOG.close();
					    adresTabReload();
					}
					else if($form.is('#SearchAddForm')){
						$('div#contacts').html(resp.data);
					}
					else if($form.is('.adres-join-group')){
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
						var header_indx = parseInt($link.closest('th').index()) +1;
						$('#datagrid').replaceWith(resp.data);
						$.cookie("header_index",header_indx);
					}else if($link.is('#send_email')){
						$('#adres-dialog').html(resp.data);
						ADres.DIALOG.open();
                    }else if($link.hasClass('affiliation_delete')){
                    	$link.closest('tr').remove();
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
			width:800
		});
	},
	close:function(){
		$('#adres-dialog').dialog("close");
	}
}

ADres.i18n = {
	less: 'less',
	more: 'more',
	confirmDelete: 'Are you sure you want to delete?'
};


jQuery(document).ready(function() {

	var ajax_options={
		beforeSend:ADres.LOADER.enable,
		complete:ADres.LOADER.disable
	};


	//$('.adres-link-ajax').bind('click',ADres.AJAX.call)
	$('.adres-ajax-implementation').bind('change',ADres.AJAX.selectImplementation);
	$('form.adres-ajax-form').live('submit',ADres.AJAX.form_submit);
	$('form.adres-ajax-search').live('submit',ADres.AJAX.form_search);
	$('a.adres-ajax-anchor').live('click',ADres.AJAX.link);

	// $('form#ContactAddForm').live('submit',ADres.AJAX.form_submit);

	// Hash Change Plugin integration
	// http://benalman.com/code/projects/jquery-bbq/examples/fragment-jquery-ui-tabs



	$('#adres-tabs').tabs({
		spinner: ADres.AJAX.loaderImageSmall,
		ajaxOptions:{
			complete:ADres.LOADER.disable
		}
	});


	$('a.adres-contact-tabs-panel').live('click',function(e){
		e.stopPropagation();
		e.preventDefault();
		var $link = $(this);
		var action = $link.attr('href');
		$.ajax({
			url:action,
			beforeSend:function(){
				$link.closest('tr').addClass("adres-row-highlight");
			},
			success:function(resp){
				$('#adres-dialog').html(resp);
				ADres.DIALOG.open();
			}
			//complete:AJAX.LOADER.disable
		});
	});



	$('#toggle-search').live('click',function(e){

		// $(this).closest(':header').toggleClass("ui-state-highlight");
		// $('#adres-advance-search').toggle('blind',{},500);

		$.ajax({
			url:'/sites/advance_search',
			beforeSend:ADres.LOADER.enable,
			success:function(resp){
				$('#adres-dialog').html(resp);
				ADres.DIALOG.open();
			},
			complete:ADres.LOADER.disable
		});
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

	$('input.date_time').live('click',function(e){
		$(this).datetime({value:'+1min', format: 'yy-mm-dd hh:ii:ss' });
	});


    $('.adres-trash').live("click",function(e){
        var link = $(this).attr('href');
        $('form#adres-restore-form').attr('action',link);
        $('#trash-dialog').dialog({title:'Restore Window'});
        return false;
    });

	$("a.adres-trash-icon").live("click",function(e){
		var $link= $(this);
		$.ajax({
			url: this.href,
			beforeSend:ADres.LOADER.enable,
			success:function(data){
				$("#contacts").html(data);
			},
			complete: ADres.LOADER.disable
		});
		return false;
	});

	$('.adres-tabs').tabs();

	$('form#goto_page').live("submit",function(e){
		e.stopPropagation();
		e.preventDefault();
		var action = "/users/paging/page:";
		var page = parseInt($("input#page_val").val());
		if(typeof page==="undefined"){
			$("input#page_val").css({border:"1px red"});
		}else{
			$.ajax({
				url: action+page,
				success:function(data){
					$('div#datagrid').replaceWith(data);
				}
			});
		}
	});

	//For the setting on per field column
	$('a.settings').live('click',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).next('.holders').toggle();
	});

	$('table.adres-datagrid tr').each(function(i,d){
			 $(d).find('td:last').css({borderRight:'1px solid #e2dfdf'});
			 $(d).find('th:last').css({borderRight:'1px solid #ccc'});
	});

	$('table.adres-datagrid tr:last td').css({borderBottom:'1px solid #e2dfdf'});



    $('.adres-affiliation-switch').live('click',function(e){
        var $radio = $(this);
        switch ( parseInt($radio.val()) ){
            case 0: $('.adres-affiliation-input').hide().prev('label').hide();
                    $('select#AffiliationAffiliationId').show().prev('label').show();
                    break;
            case 1: $('.adres-affiliation-input').hide().prev('label').hide();
                    $('select#AffiliationAffiliationId,input#AffiliationContactId').show().prev('label').show();
                    break;
            case 2: $('.adres-affiliation-input').hide().prev('label').hide();
                    $('select#AffiliationAffiliationId,select#AffiliationFilterId').show().prev('label').show();
                    ;break;
        }
    });

	setTimeout(function(){ $("#flashMessage").fadeOut() }, 5000);


    //need to use this after a new one gets created to solve this
	$("a.adres-affiliate").live("click",function(e){
		e.preventDefault();
		var $link = $(this);
        var source = $("#affilliation_temp").html();
        var template = Handlebars.compile(source);
        var splited_url = $link.closest('td').siblings('td').find('a').eq(0).attr('href').split("/");
        var contact_id = splited_url[splited_url.length - 1];
        $.getJSON($link.attr('href')+'.json', function(data){
            data.contact_id = contact_id;
            $link
            .siblings("div.adres-affiliate-box")
            .append(template(data))
            .show("slow");
        });
	});

	$("a.adres-box-closer").live("click",function(e){
		e.preventDefault();
		$(this).parent("div").hide("slow");
	});


    Handlebars.registerHelper('select', function(items, options) {
        var out = "<select name="+options.hash.name+" id="+options.hash.id+">";
        out +="<option> Select ...</option>";
        for(var i=0, l=items.length; i<l; i++) {
            out = out + "<option value="+items[i].value+">" + items[i].option + "</option>";
        }
        return out + "</select>";
    });

    $('select#select_affiliation').live('change',function(e){

        var $select = $(this);
        var params = $select.val();
        var contact_id = $select.next('input').val();
        $.getJSON('/users/new_record.json?affiliation='+params,function(response){
            $select.closest('div.affiliations').find('input.related_to_id').val(
                $(response.data).find('#edit-contact-id').val()
            );
		    $select.parent().siblings('.new_record').html(response.data);
        });
    });

});


function adresTabReload() {
    var contact_type_id = $.cookie('CakeCookie[contact_type_id]');
    var $link=null
    $.each($('#adres-tabs a.adres-tabs-button'),function(i,link){
        $link = $(link);
        if($link.data('href.tabs') === '/users/display_contacts/'+ contact_type_id)
        {
            $('#contacts').load($link.data('href.tabs'));
        }
    });
}
