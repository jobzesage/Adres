<h1>Edit page</h1>

<?php echo $form->create('User') ?>
	<?php echo $this->element('_user_fields') ?>
	<?php echo $form->input("id") ?>
<?php echo $form->end("submit") ?>
