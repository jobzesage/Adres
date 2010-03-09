<div class="adres-left-sidebar span-5">
	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'search'
		),
		'type'=>'get'
		)) ?>
		<?php echo $form->input('contact') ?>
		
	<?php echo $form->end('Search') ?>
	
	<?php echo $form->create('AdvanceSearch',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'advance_search'
		),
		'type'=>'get'
		)) ?>
		
		<?php echo $form->input('contact') ?>
			
	<?php echo $form->end('Advance Search') ?>
	
	<?php foreach ($contactTypes as $contactType): ?>
		<?php echo $html->tag('h3',__('Types',true)) ?>
		<?php echo $html->link($contactType['ContactType']['name'],'#')."<br />" ?>

		<?php echo $html->tag('h3',__('Groups',true)) ?>
		<?php foreach ($contactType['CurrentGroup'] as $currentGroup): ?>
			<?php echo $html->link($currentGroup['name'],'#')."<br />" ?>
		<?php endforeach ?>
	<?php endforeach ?>

</div>

<div class="adres-contacts-panel span-13">
<?php foreach ($contactTypes as $contactType): ?>	
	<?php echo $html->link('Add Record','#') ?><br/>
	<table border="0" class="adres-datagrid">
		<tr>
            <th>ID</th>
			<?php foreach ($contactType['Field'] as $field): ?>
			<th><?php echo $field['name'] ?></th>
			<?php endforeach ?>
		</tr>
        <?php foreach($contactType['Contact'] as $contact):?>
        
        <tr>
            <td><?php echo $contact['id'] ?></td>
            <?php foreach($contact['TypeString'] as $tps_string):?>
            <td>
            	<?php echo $html->link( $tps_string['data'], array(
                    'controller'=>'users',
                    'action'=>'show_record',
                    $contact['id']
                )) ?>
             </td>
            <?php endforeach ?>
        </tr>
        <?php endforeach ?>
	</table>
<?php endforeach ?>
</div>

<div class="adres-right-sidebar span-5">
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</div>