<div id="adres-groups">
	<?php echo $this->element('contact_groups') ?>	
</div>





<?php echo $html->tag('h3',__('Affiliations',true)) ?>

<?php foreach ($contact['ParentAffiliation'] as $parentAffiliation): ?>
	<?php echo $parentAffiliation['father_name'] ?>
	<?php $pid = $parentAffiliation['AffiliationsContact']['contact_child_id'] ?>
	<?php echo $html->link($pid,array(
		'controller'=>'users',
		'action' => 'show_record', 
		$pid
	),array(
		'class'=>'adres-ajax-anchor adres-show',
	)) ?>
<?php endforeach ?>

<?php foreach ($contact['ChildAffiliation'] as $childAffiliation): ?>
	<?php echo $childAffiliation['child_name'] ?>
	<?php $pid = $childAffiliation['AffiliationsContact']['contact_father_id'] ?>
	<?php echo $html->link($pid,array(
		'controller'=>'users',
		'action' => 'show_record', 
		$pid
	),array(
		'class'=>'adres-ajax-anchor adres-show',
	)) ?>
		
<?php endforeach ?>

<?php echo $html->tag('h3',__('Modification Logs',true)) ?>
<table>
	<tr>
		<th>Date</th>
		<th>Desciption</th>
		<th>Author</th>
	</tr>
	<?php foreach ($contact['Log'] as $log): ?>
	<tr>
		<td><?php echo $log['log_dt'] ?> </td>
		<td><?php echo $log['description'] ?> </td>
		<td><?php echo $log['User']['username'] ?> </td>
	</tr>
	<?php endforeach ?>
</table>