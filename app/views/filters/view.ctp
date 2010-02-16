<div class="filters view">
<h2><?php  __('Filter');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filter['Filter']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filter['Filter']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Criteria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filter['Filter']['criteria']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Keyword'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filter['Filter']['keyword']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact Types Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filter['Filter']['contact_types_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Filter', true), array('action' => 'edit', $filter['Filter']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Filter', true), array('action' => 'delete', $filter['Filter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $filter['Filter']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Filters', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Filter', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
