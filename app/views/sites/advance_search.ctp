<div class="adres-tabs">
		<ul>
		<li><a href="#tabs-1">Avd Search</a></li>
		<li><a href="#tabs-2">Aff Search</a></li>
		<li><a href="#tabs-3">Customize</a></li>
	</ul>
	<div id="tabs-1">
		<?php echo $form->create('AdvanceSearch',array(
			'url'=>array(
				'controller'=>'users',
				'action'=>'add_criteria'
			),
			'class' => 'adres-ajax-form'
			)) ?>
			<?php
			/*-------------------------------
			| Advance Search generated form 
			| the plugin
			|-------------------------------*/
			?>
			<?php echo $advance_search_form ?>
			
		<?php echo $form->end(array('label'=>'Advance Search','class'=>'adres-button')) ?>	
	</div>
	<div id="tabs-2">
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
	
	<div id="tabs-3">
		
	</div>

</div>
<script type="text/javascript">

	$(function(){
		$('.adres-tabs').tabs({
			// spinner: ADres.AJAX.loaderImageSmall,
			// ajaxOptions:{
			// 	beforeSend:function(){
			// 		//TODO
			// 	}
			// 	,
			// 	complete:function(){
			// 		//TODO
			// 	}
			// },
			// load: function(event, ui) {
			// 	        	$('a.adres-tab-link', ui.panel).click(function(e) {
			// 		        	$(ui.panel).load(this.href);
			// 		        	e.stopPropagation();
			// 		        	return false;
			// 		        });
			// 		    }
		});
	});
</script>