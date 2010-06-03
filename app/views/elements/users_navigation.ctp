<div id="main_navigation" class="adres-navigation span-24">
	
	<ul>
		
		<li ><?php echo $html->link(__('Home',true),array('controller'=>'users','action'=>'home')) ?></li>

		<li><?php echo $html->link(__('Administrator',true),array('controller'=>'data_structure','action'=>'index')) ?></li>
		
		<li><?php echo $html->link(__('Logout',true),array('controller'=>'users','action'=>'logout')) ?></li>
	</ul>
	
</div>