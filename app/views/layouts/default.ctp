<?php echo $html->docType('XTHML') ?>

	<?php echo $this->element('layout/_header')?>
    
		<?php #echo $this->element('implementations/list') ?>
		<?php echo $this->element('main_navigation') ?>		
		<div id="content" class='clear'>

			<?php 
				if($session->check('Message'))	
					$session->flash();
			?>
			
			<?php echo $content_for_layout; ?>
		</div>

	<?php echo $this->element('layout/_footer')?>