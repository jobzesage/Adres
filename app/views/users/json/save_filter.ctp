<?php foreach ($filters as $filter): ?>
	<div class="adres-filter">
		<?php echo $html->link($filter['Filter']['name'],array(
			'controller'=>'users',
			'action' => 'load_filter', 
			$filter['Filter']['id'],
		),array('class'=>'adres-ajax-anchor')
		) ?>
		
		<?php echo $html->link('(x)',array(
			'controller'=>'filters',
			'action' => 'delete', 
			$filter['Filter']['id'],
		),array('class'=>'adres-ajax-anchor adres-delete-filter')
		) ?>		
	</div>
<?php endforeach ?>