<?php echo $html->link($data['Group']['name'], array(
	'controller' => 'users', 
	'action' => 'load_group',
	$data['Group']['id']
),array(
	'class' => 'adres-ajax-anchor load_group'
)) ?>