<div class="adres-contacts-panel span-24">
	<div id="adres-tabs">
		<ul>
			<?php foreach ($types as $type	): ?>
			<li><?php echo $html->link($type['ContactType']['name'],array(
				'controller' => 'users', 
				'action' => 'display_contacts', 
				$type['ContactType']['id']),array(
					'title'=>'contacts',
					'class' => 'adres-tabs-button'	
				)) ?></li>
			<?php endforeach ?>
		</ul>
		<div id="contacts"></div>

	</div> 
</div>

