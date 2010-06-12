<?php if ($paging['pages'] != 1): ?>
	<?php for($i=1 ;$i<= $paging['pages'] ;$i++): ?>
		<?php  $options = array(
			'controller' => 'users', 
			'action' => 'test_paging',
			'page'=>$i,
			'sort'=> array_key_exists('sort',$paging)	?	$paging['sort']		:null,
			'order'=>array_key_exists('order',$paging)	?	$paging['order']	:null
		);
			$options = array_filter($options);
		 ?>
		<?php echo $html->link($i,$options,array('class'=>'adres-ajax-anchor sort')) ?>	
	<?php endfor ?>
<?php endif ?>
		