<div id="adres-contacts-holder" class="span-24">
	<div id="adres-tabs">
		<ul>
			<?php foreach ($types as $type	): ?>
			<li><?php echo $html->link('<span>'.$type['ContactType']['name'].'</span>',array(
				'controller' => 'users', 
				'action' => 'display_contacts', 
				$type['ContactType']['id']),array(
					'title'=>'contacts',
					'class' => 'adres-tabs-button'	
				),
				null,null,false) ?></li>
			<?php endforeach ?>
		</ul>
		<div id="contacts"></div>

	</div> 
</div>

