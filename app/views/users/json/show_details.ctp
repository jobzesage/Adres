	<script type="text/javascript">
		$('#adres-details').tabs();
	</script>

	<ul>
		<li><a href="#adres-groups" class="adres-tab-header">Groups</a></li>
		<li><a href="#adres-affiliation" class="adres-tab-header">Affiliation</a></li>
		<li><a href="#adres-logs" class="adres-tab-header">History</a></li>
	</ul>

		
	<div id="adres-groups">
		<?php echo $this->element('contact_groups') ?>	
	</div>
	
	
	<div id="adres-affiliation">
		<?php //echo $html->tag('h3',__('Affiliations',true)) ?>
		
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
		
	</div>
	
	<div id="adres-logs">
		<?php //echo $html->tag('h3',__('Modification Logs',true)) ?>
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
		
	</div>

