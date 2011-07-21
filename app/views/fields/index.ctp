<!--
<div class="adres-contacts-panel span-24">
	<div id="data-structure-tabs" class="adres-tabs">
		<ul>
			<?php foreach ($contactTypes as $id => $type	): ?>
			<li><?php echo $html->link($type,array(
				'controller' => 'users',
				'action' => 'display_contacts',
				$id),array(
					'title'=>'contacts',
					'class' => 'adres-tabs-button'
				)) ?></li>
			<?php endforeach ?>
		</ul>
		<div id="contacts"></div>

	</div>
</div>
-->

<div class="fields index">
<h2><?php __('Fields');?></h2>
<!-- .adres-search -->
<div class="adres-search">
    <form method="get" action="/fields">
        <input type="text" name="name" value="" id="adres-search-name"/>
        <input type="submit" name="submit" value="" id=""/>
    </form>
</div>
<!-- /.adres-search -->
<table class="adres-datagrid ui-widget">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('ContactType.name');?></th>
	<th><?php echo $paginator->sort('order');?></th>
	<th><?php echo $paginator->sort('field_type_class_name');?></th>
	<th><?php echo $paginator->sort('is_descriptive');?></th>
	<th class="actions" style="font-size: 13px; padding-left: 10px;"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($fields as $field):
	$class = null;
	if ($i++ % 2 == 1) {
		$class = ' class="tr-even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $field['Field']['id']; ?>
		</td>
		<td>
			<?php echo $field['Field']['name']; ?>
		</td>
		<td>
			<?php echo $field['ContactType']['name']; ?>
		</td>
		<td>
			<?php echo $field['Field']['order']; ?>
		</td>
		<td>
			<?php

				echo $html->link($field['Field']['field_type_class_name'],
					array(
						'controller' => 'plugins',
						'action' =>'show',
						'contact_type_id' =>$field['ContactType']['id'],
						'field_id' => $field['Field']['id']
					)
			)?>
		</td>
		<td>
			<?php echo $field['Field']['is_descriptive']; ?>
		</td>
		<td class="actions">

			<?php $img_view = $html->image("/css/theme1/images/view.gif", array("title"=>"View")) ?>
			<?php $img_edit = $html->image("/css/theme1/images/edit.png", array("title"=>"Edit")) ?>
			<?php $img_delete = $html->image("/css/theme1/images/delete.png", array("title"=>"Delete")) ?>

			<?php echo $html->link(__($img_view, true), array('action' => 'view', $field['Field']['id']), null, null, false)  ?>
			<?php echo $html->link(__($img_edit, true), array('action' => 'edit', $field['Field']['id']), null, null, false)  ?>
			<?php echo $html->link(__($img_delete, true), array('action' => 'delete', $field['Field']['id']), null,
			sprintf(__('Are you sure you want to delete # %s?', true), $field['Field']['id']), null, null, false)  ?>

		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<?php echo $this->element('layout/_default_paging') ?>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('New Field', true), array('action' => 'add')); ?></li>
	</ul>
	<div class="clear"></div>
</div>
