<div class="fieldTypes view">
<h2><?php  __('FieldType');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Class Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldType['FieldType']['class_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nice Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fieldType['FieldType']['nice_name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit FieldType', true), array('action' => 'edit', $fieldType['FieldType']['class_name'])); ?> </li>
		<li><?php echo $html->link(__('Delete FieldType', true), array('action' => 'delete', $fieldType['FieldType']['class_name']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fieldType['FieldType']['class_name'])); ?> </li>
		<li><?php echo $html->link(__('List FieldTypes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New FieldType', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
