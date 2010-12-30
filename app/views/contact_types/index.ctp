<div class="contactTypes index">
<h2><?php __('ContactTypes');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('implementation_id');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($contactTypes as $contactType):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $contactType['ContactType']['id']; ?>
		</td>
		<td>
			<?php echo $contactType['ContactType']['name']; ?>
		</td>
		<td>
			<?php echo $contactType['Implementation']['name']; ?>
		</td>
		<td class="actions">
			
			<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
			<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>
			
			<?php echo $html->link(__($img_view, true), array('action' => 'view', $contactType['ContactType']['id']), null, null, false)  ?>
			<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $contactType['ContactType']['id']), null, null, false)  ?>
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $contactType['ContactType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contactType['ContactType']['id']), null, null, false)  ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 	<span>|</span> 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('New ContactType', true), array('action' => 'add')); ?></li>
	</ul>
</div>
