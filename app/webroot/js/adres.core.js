var ADres={};
ADres.version=0.1;


ADres.AJAX={
	call:function(e){
		console.log('test');
	}
}


ADres.ERROR={
	call:function(e){
		console.log('test');
	}
}


jQuery(document).ready(function() {
	$('.adres-link-ajax').bind('click',ADres.AJAX.call)
	$('.adres-selection-ajax').bind('change',ADres.AJAX.call);
});