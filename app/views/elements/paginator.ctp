<?php
/**
 *  There is better ways to achive this
 *  http://book.cakephp.org/view/249/Custom-Query-Pagination
 */
?>
<?php if ($paging['pages'] != 1): ?>
	<?php 
		if (!isset($paging['page'])) {
			$paging['page'] =1;
		}
	?>

<div class="adres-paginator last ">
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
		<span class="<?php echo ($paging['page']==$i)? "selected":"" ?>">
			<?php echo $html->link($i,$options,array('class'=>'adres-ajax-anchor sort')) ?>
		</span>	
	<?php endfor ?>
</div>
<?php endif ?>
