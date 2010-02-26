<div id="main_navigation" class="span-24 adres_navigation">
	
	<ul>
		
		<li ><?php echo $html->link(__('Home',true),array('controller'=>'users','action'=>'home')) ?></li>
		
		<li><?php echo $html->link(__('Implementations',true),array('controller'=>'implementations','action'=>'index')) ?></li>
		<li><?php echo $html->link(__('Contacts',true),array('controller'=>'contacts','action'=>'index')) ?></li>

		
		<li><?php echo $html->link(__('Contact Types',true),array('controller'=>'contact_types','action'=>'index')) ?></li>
		
		<li><?php echo $html->link(__('Groups',true),array('controller'=>'groups','action'=>'index')) ?></li>
			
		<li><?php echo $html->link(__('Data Structure',true),array('controller'=>'fields','action'=>'index')) ?></li>
		
		<li><?php echo $html->link(__('Field Types',true),array('controller'=>'field_types','action'=>'index')) ?></li>
		
		<li><?php echo $html->link(__('Filters',true),array('controller'=>'filters','action'=>'index')) ?></li>
		
		<li><?php echo $html->link(__('Users',true),array('controller'=>'users','action'=>'index')) ?></li>
		
		<li><?php echo $html->link(__('Logout',true),array('controller'=>'users','action'=>'logout')) ?></li>
	</ul>
	
</div>