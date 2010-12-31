<div class="implementations view">
<h2><?php  __('Implementation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $implementation['Implementation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $implementation['Implementation']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="add_action">
	<ul>
		<li><?php echo $html->link(__('Edit Implementation', true), array('action' => 'edit', $implementation['Implementation']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Implementation', true), array('action' => 'delete', $implementation['Implementation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $implementation['Implementation']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Implementations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Implementation', true), array('action' => 'add')); ?> </li>
	</ul>
	<div class="clear"></div>
</div>
