<div class="affiliations form">
	<?php echo $this->element('affiliations/_form'); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Affiliations', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Contact Types', true), array('controller' => 'contact_types', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Father Contact Type', true), array('controller' => 'contact_types', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Contacts', true), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Contact', true), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
