<div class="adres-contacts-details">
	<ul>
		<li><?php echo $html->link(__('Show Details',true),array(
			'controller'=>'users',
			'action' => 'show_details',
			$contactId 
		),
		array(
			'class'	=>'adres-ajax-anchor	adres-contats-show-details'
		)) ?> </li>
		<li><?php echo $html->link(__('Edit Details',true),array(
			'controller' => 'users',
			'action' => 'edit_details' ,
			$contactId 
			),
			array(
				'class'	=>'adres-ajax-anchor	adres-contats-show-details'
			)) ?> </li>
	</ul>
</div>
