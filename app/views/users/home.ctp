<div id="adres-contacts-holder">

	<div id="adres-tabs">
    
		<ul>
			<?php foreach ($types as $type	): ?>
			<li><?php echo $html->link('<span>'.$type['ContactType']['name'].'</span>',array(
				'controller' => 'users', 
				'action' => 'display_contacts', 
					$type['ContactType']['id']
				),
				array(
					'title'=>'#contacts',
					'class' => 'adres-tabs-button'	
				),
				false,false,false) ?></li>
			<?php endforeach ?>
            <li class="create-contact"><a href="#">&nbsp;</a></li>
		</ul>
        
		<div id="contacts"></div>
        
	</div> 
    
</div>

