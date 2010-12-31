<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 		<?php echo $paginator->numbers(array("before"=>"<span>|</span>",'after'=>'<span>|</span>','separator'=>'<span>|</span>'));?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>