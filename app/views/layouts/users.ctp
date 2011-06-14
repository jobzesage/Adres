<?php echo $html->docType() ?>

	<?php echo $this->element('layout/_header')?>

		<?php #echo $this->element('implementations/list') ?>
		<?php //echo $this->element('users_navigation') ?>		
		<div id="content" class='clear'>

			<?php 
				if($session->check('Message'))	
					$session->flash();
			?>
			
			<?php echo $content_for_layout; ?>
			
			<div id="adres-dialog" title="Contact Window" style="display:none"></div>
			
		</div>

	<?php echo $this->element('layout/_footer')?>
