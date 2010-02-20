<div class="fields form">
	<?php echo $this->element('fields/_form') ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Field.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Field.id'))); ?></li>
		<li><?php echo $html->link(__('List Fields', true), array('action' => 'index'));?></li>
	</ul>
</div>
