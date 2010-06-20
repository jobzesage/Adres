<style type="text/css">
	#adres-contact-window ul li a{
		padding:0.2em 0.5em;
	}
</style>

<div id="adres-contact-window" class="adres-tabs">
	<ul>
		<li><?php echo $html->link('<span>Display</span>', array(
			'controller' => 'sites', 
			'action' => 'show_record',
			$contact_id 
			  ),
			array(
				'title' =>'contact-window',
				'class' =>'adres-tab-link'  	
			),
			null,null,false
			) ?></li>
			
		<li><?php echo $html->link('<span>Edit</span>', array(
			'controller' => 'sites', 
			'action' => 'edit_record',
			$contact_id 
			  ),
			array(
				'title' =>'contact-window',
				'class' =>'adres-tab-link'  	
			),
			null,null,false
			) ?></li>
		<li><?php echo $html->link('<span>Group</span>', array(
			'controller' => 'sites', 
			'action' => 'group',
			$contact_id 
			  ),
			array(
				'title' =>'contact-window',
				'class' =>'adres-tab-link'  	
			),null,null,false
			) ?></li>
		<li><?php echo $html->link('<span>Affiliation</span>', array(
			'controller' => 'sites', 
			'action' => 'affiliate',
			$contact_id 
			  ),
			array(
				'title' =>'contact-window',
				'class' =>'adres-tab-link'  	
			),null,null,false) ?></li>

		<li><?php echo $html->link('<span>History</span>', array(
			'controller' => 'sites', 
			'action' => 'history',
			$contact_id 
			  
			),
			array(
				'title' =>'contact-window',
				'class' =>'adres-tab-link'  	
			),null,null,false) ?></li>
	</ul>
	
	<div id="contact-window">
	</div>

</div>


<script type="text/javascript">

	$(function(){
		$('#adres-contact-window').tabs({
			spinner: ADres.AJAX.loaderImageSmall,
			ajaxOptions:{
				beforeSend:function(){
					//TODO
				}
				,
				complete:function(){
					//TODO
				}
			},
			load: function(event, ui) {
	        	$('a.adres-tab-link', ui.panel).click(function(e) {
		        	$(ui.panel).load(this.href);
		        	e.stopPropagation();
		        	return false;
		        });
		    }
		});
	});
</script>