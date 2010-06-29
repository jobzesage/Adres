<div class="affiliations index">
<h2><?php __('Affiliations');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table class="adres-datagrid">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('contact_type_father_id');?></th>
	<th><?php echo $paginator->sort('contact_type_child_id');?></th>
	<th><?php echo $paginator->sort('father_name');?></th>
	<th><?php echo $paginator->sort('child_name');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($affiliations as $affiliation):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
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
			<?php echo $html->link(__('View', true), array('action' => 'view', $affiliation['Affiliation']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $affiliation['Affiliation']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $affiliation['Affiliation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $affiliation['Affiliation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Affiliation', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Contact Types', true), array('controller' => 'contact_types', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Father Contact Type', true), array('controller' => 'contact_types', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Contacts', true), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Contact', true), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
