<div class="adres-left-sidebar span-5">
	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'search'
		))) ?>
		<?php echo $form->input('contact') ?>
		
	<?php echo $form->end('Search') ?>
	
	<?php echo $form->create('AdvanceSearch',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'advance_search'
		))) ?>
		
		<?php echo $form->input('contact') ?>
			
	<?php echo $form->end('Advance Search') ?>
</div>

<div class="adres-contacts-panel span-13">
	<table border="0">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>test</th>
			<th>test</th>
			<th>test</th>
		</tr>
		<tr>
			<td>Data</td>
			<td>data</td>
			<td>data</td>
			<td>data</td>
			<td>data</td>
		</tr>
	</table>
</div>

<div class="adres-right-sidebar span-5">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</div>