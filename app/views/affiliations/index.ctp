<div class="affiliations index">
	
<h2><?php __('Affiliations');?></h2>


<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('contact_type_father_id');?></th>
	<th><?php echo $paginator->sort('contact_type_child_id');?></th>
	<th><?php echo $paginator->sort('father_name');?></th>
	<th><?php echo $paginator->sort('child_name');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($affiliations as $affiliation):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $affiliation['Affiliation']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($affiliation['FatherContactType']['name'], array('controller' => 'contact_types', 'action' => 'view', $affiliation['FatherContactType']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($affiliation['ChildContactType']['name'], array('controller' => 'contact_types', 'action' => 'view', $affiliation['ChildContactType']['id'])); ?>
		</td>
		<td>
			<?php echo $affiliation['Affiliation']['father_name']; ?>
		</td>
		<td>
			<?php echo $affiliation['Affiliation']['child_name']; ?>
		</td>
		<td>
			<?php echo $affiliation['Affiliation']['created']; ?>
		</td>
		<td>
			<?php echo $affiliation['Affiliation']['modified']; ?>
		</td>
		<td class="actions">
			
<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>

<?php echo $html->link(__($img_view, true), array('action' => 'view', $affiliation['Affiliation']['id']), null, null, false)  ?> 
<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $affiliation['Affiliation']['id']), null, null, false)  ?> 
<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $affiliation['Affiliation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $affiliation['Affiliation']['id']), null, null, false)  ?>
			 
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
		<li><?php echo $html->link(__('New Affiliation', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Contact Types', true), array('controller' => 'contact_types', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Father Contact Type', true), array('controller' => 'contact_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
