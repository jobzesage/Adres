<div class="fields view">
<h2><?php  __('Field');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $field['Field']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $field['Field']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact Type  Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $field['Field']['contact_type__id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $field['Field']['order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field Type Class Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $field['Field']['field_type_class_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Descriptive'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $field['Field']['is_descriptive']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Field', true), array('action' => 'edit', $field['Field']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Field', true), array('action' => 'delete', $field['Field']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $field['Field']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Fields', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Field', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
