<?php echo $this->element("affiliations/_affiliate") ?>

<table>
	<tr>
		<th><?php echo $descriptiveFields ?></th>	
		<th>Affiliations</th>
	</tr>	

	<?php foreach ($contact as $affiliation): ?>
	<tr>
		<td>
			<?php 
			echo $name ." &nbsp";	
		 	?>
		</td>
		<td> 
			<div class="adres-affiliations">
				<?php echo $affiliation['affiliation_type'] ?>
				
				<?php $pid = $affiliation['affiliated_contact_id'] ?>
				<?php echo $html->link($affiliation['affiliated_to'],array(
					'controller'=>'users',
					'action' => 'show_record', 
					$pid
				),array(
					'class'=>'adres-ajax-anchor adres-show',
				)) ?>
			</div>
		</td>
	</tr>
	<?php endforeach ?>

</table>
<script type="text/javascript" src="/js/adres-contact-autocompleter.js.php"></script>
