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
		$next = "next";
		$pervious = "previous";
		$page_count = $paging['pages'];
		$start_at = $paging['page'];
		$page_links = 9;
	?>

<div class="adres-paginator last ">
	
	<?php  $options = array(
		'controller' => 'users', 
		'action' => 'paging',
		'sort'=> array_key_exists('sort',$paging)	?	$paging['sort']		:null,
		'order'=>array_key_exists('order',$paging)	?	$paging['order']	:null
	);
		$options = array_filter($options);
		$style=array('class'=>'adres-ajax-anchor sort');
	?>
	<?php if ($start_at!=1): ?>
		<?php $n = $start_at -1 ?>
		<?php $options = am($options,array('page'=>$n))	?>
		<?php echo $html->link($pervious,$options,$style) ?>
	<?php endif ?>
		
	<?php for($i=$start_at ;$i<= $start_at+$page_links ;$i++): ?>
		<?php $options = am($options,array('page'=>$i))	?>
		<span class="<?php echo ($paging['page']==$i)? "selected":"" ?>">
			<?php echo $html->link($i,$options,$style) ?>
		</span>	
	<?php endfor ?>
	
	<?php if ($page_count > 10): ?>
		<?php $p = $start_at+1 ?>
		<?php $options = am($options,array('page'=>$p))	?>
		<?php echo $html->link($next,$options,$style) ?>
	<?php endif ?> of total <span><?php echo $page_count ?></span>
</div>
<?php endif ?>