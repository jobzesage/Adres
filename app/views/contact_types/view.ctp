<div class="contactTypes view">
<h2><?php  __('ContactType');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactType['ContactType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactType['ContactType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Implementation Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactType['ContactType']['implementation_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ContactType', true), array('action' => 'edit', $contactType['ContactType']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ContactType', true), array('action' => 'delete', $contactType['ContactType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contactType['ContactType']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ContactTypes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New ContactType', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
