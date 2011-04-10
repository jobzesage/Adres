$(function() {  
  $('#AffiliateAutocompleter, input.adres-contact-picker').autocomplete({
  		source: '/sites/contact_picker.json',
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

});
