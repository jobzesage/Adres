<?php foreach ($filters as $filter): ?>
	<div class='adres-filter clear'>
		<?php echo $html->link($filter['Filter']['name'],array(
			'controller'=>'users',
			'action' => 'load_filter',
			$filter['Filter']['id']
		),array(
			'class'=>'adres-ajax-anchor filter-bullet'			
		)
		) ?>
		<?php $img = $html->image("/css/theme1/images/cross.png") ?>
		
		<?php echo $html->link($img,array(
			'controller'=>'filters',
			'action' => 'delete',
			$filter['Filter']['id']
		),array(
			'class'=>'adres-ajax-anchor adres-delete-filter'			
		),null,null,false
		) ?>			
	</div>
<?php endforeach ?>	