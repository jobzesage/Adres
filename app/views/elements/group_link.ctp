<?php echo $html->link($data['Group']['name'], array(
	'controller' => 'sites', 
	'action' => 'load_group',
	$data['Group']['id']
),array(
	'class' => 'adres-ajax-anchor load_group'
));
FireCake::fb($numberOfTotalChildren);
 ?>