	
	<?php  
	/*-------------------------------
	| Keyword Search Section
	|--------------------------------*/
	?>
	
<div class="adres-left-sidebar-box" style="margin-top: 0;">

		<div class="adres-left-sidebar-head">
			
				<div class="adres-left-sidebar-head-left"></div>
				<div class="adres-left-sidebar-head-mid">
					
					<a href="#"><img src="/css/theme1/images/help.png" alt=""></a>
					<a href="#"><img src="/css/theme1/images/add.png" alt=""></a>
					<p>Search</p>
					
				</div>
				<div class="adres-left-sidebar-head-right"></div>
				<div class="clear"></div>
			
		</div>
		
		<div class="adres-left-sidebar-content">
			
				<div class="adres-left-sidebar-content-mid" style="padding-bottom: 0;">
					
						<div class="adres-search">
					
	<?php //echo $html->tag('h6',"Search",array('class'=>'adres-button small ui-state-default ui-corner-all')) ?>

	<?php echo $form->create('Search',array(
		'url'=>array(
			'controller'=>'users',
			'action'=>'add_keyword'
		),
		'type'=>'get',
		'class' => 'adres-ajax-search', 
		)) ?>
		
		<div class="text input">
			<?php echo $form->input('keyword',array(
				'class'=>'text ui-corner-all',
				'value'=>'', # can set the inital value
				'label'=>false,
				'div'=>false
			)) ?>
			<?php echo $form->hidden('contact_type_id',array(
				'value' => 5
			)); ?>

			<input type="submit" value="submit" class="search-submit" />

			<?php echo $form->end() ?>
			
		</div>

	<?php  
	/*-------------------------------
	| Advance Search Section
	|--------------------------------*/
	?>
	
	<?php echo $html->link('Advance Search',array('#'),array(
			'id' => 'toggle-search', 			
			'class' => 'advance', 
		)) ?>
								
						<div class="clear"></div>
						</div>			
		
				</div>
				<div class="adres-left-sidebar-content-bottom"></div>
			
		</div>
		
</div>
		

	<?php  
	/*-------------------------------
	| Groups Filter Section
	|--------------------------------*/
	?>
	
<div class="adres-left-sidebar-box">

		<div class="adres-left-sidebar-head">
			
				<div class="adres-left-sidebar-head-left"></div>
				<div class="adres-left-sidebar-head-mid">
					
					<a href="#"><img src="/css/theme1/images/help.png" alt=""></a>
					<a href="#"><img src="/css/theme1/images/add.png" alt=""></a>
					<p>Groups</p>
					
				</div>
				<div class="adres-left-sidebar-head-right"></div>
				<div class="clear"></div>
			
		</div>
		
		<div class="adres-left-sidebar-content">
			
				<div class="adres-left-sidebar-content-mid">

	<?php if (isset($groups) and !empty($groups)): ?>

		<div id="adres-saved-group">
		<?php //echo $html->tag('h6',__('Groups',true),array('class'=>'adres-button small ui-state-default ui-corner-all')) ?>		
			<div id="group-tree" style="float: left; width: 184px; overflow: hidden;">
				<?php echo $tree->generate($groups,array(
					'model' => 'Group',
					'element'=>'group_link',
				)) ?>
			</div>
		</div><!-- adres-groups -->

	<?php endif ?>
								
						<div class="clear"></div>		
		
				</div>
				<div class="adres-left-sidebar-content-bottom"></div>
			
		</div>
		
</div>
	
	
<div class="adres-left-sidebar-box">

		<div class="adres-left-sidebar-head">
			
				<div class="adres-left-sidebar-head-left"></div>
				<div class="adres-left-sidebar-head-mid">
					
					<a href="#"><img src="/css/theme1/images/help.png" alt=""></a>
					<a href="#"><img src="/css/theme1/images/add.png" alt=""></a>
					<p>Criterias</p>
					
				</div>
				<div class="adres-left-sidebar-head-right"></div>
				<div class="clear"></div>
			
		</div>
		
		<div class="adres-left-sidebar-content">
			
				<div class="adres-left-sidebar-content-mid">
					
						<div class="adres-filter-hold">
							
	<?php  
	/*-------------------------------
	| Keyword Filter Section
	|--------------------------------*/
	?>
	
	<?php if ($session->check('Filter.keyword') || $session->check('Filter.criteria')): ?>

		<?php $keyword = $session->read('Filter.keyword') ?>

		<?php if ($session->check('Filter.keyword')): ?>
			<div class="adres-criteria">
				<?php echo $html->link("Keyword : {$keyword}",array(
					'controller'=>'users',
					'action' => 'delete_keyword', 
					$keyword
				),array(
					'class'=>'adres-ajax-anchor adres-delete-keyword filter-bullet'
				)) ?>				
            </div>
            

		<?php endif ?>
	    
		
	<?php  
	/*-------------------------------
	| Criteria Filter Section
	|--------------------------------*/
	?>
			
		
		<?php if ($session->check('Filter.criteria')): ?>
			<?php $criterias = unserialize($session->read('Filter.criteria')) ?>
			
				
			<?php foreach ($criterias as $idx => $criteria): ?>
			<div class="adres-criteria">					
				<?php echo $html->link($criteria['name'],array(
					'controller'=>'users',
					'action'    =>'delete_criteria',
					'id:'.$idx
					),
					array(
					'class'=>'adres-ajax-anchor filter-bullet'	
					)
				) ?>
			</div>				
			<?php endforeach ?>
		<?php endif ?>
		
            <!-- <?php echo $html->link('Add Result Set To Group',array(
                'controller'=>'users',
                'action'=>'add_to_group'     
            ),array(
                'class'=>'adres-ajax-anchor'    
            )) ?> -->
            
            <?php echo $form->create('Group',array(
            	'url' => array(
            		'controller' => 'users', 
            		'action' => 'add_to_group'
            	),
            	'class' => 'adres-ajax-form' 
            )) ?>
            
            	<?php echo $form->input('group_id',array(
            		'options' => $html->generateGroupList($groups),
            		'label' => false,
            		'div' => false  
            	)) ?>
            <?php echo $form->end('Add to group') ?>
            
            

		
						<div class="clear"></div>
						
						
						</div><!-- adres-filter-hold -->
				</div>
				<div class="adres-left-sidebar-content-bottom"></div>
			
		</div>
		
</div>	


			
<div class="adres-left-sidebar-box">

		<div class="adres-left-sidebar-head">
			
				<div class="adres-left-sidebar-head-left"></div>
				<div class="adres-left-sidebar-head-mid">
					
					<a href="#"><img src="/css/theme1/images/help.png" alt=""></a>
					<a href="#"><img src="/css/theme1/images/add.png" alt=""></a>
					<p>Filters</p>
					
				</div>
				<div class="adres-left-sidebar-head-right"></div>
				<div class="clear"></div>
			
		</div>
		
		<div class="adres-left-sidebar-content">
			
				<div class="adres-left-sidebar-content-mid">
					
						<div class="adres-filter-hold">
		
		<?php echo $form->create('Filter',array(
			'url'=>array(
				'controller'=>'users',
				'action' => 'save_filter'
			),
			'class' => 'adres-ajax-form adres-save-filter',
		)) ?>
		
			<?php echo $form->input('name',array(
				'class'=>'text ui-corner-all',
				'lable'=>array('text'=>'Write a Name')
			)) ?>
			
		<?php echo $form->end(array('label'=>'save','class'=>'filter-save adres-button')) ?>
		
	<?php endif ?>	
	
	
	
	<?php  
	/*-------------------------------
	| Saved Filter Section
	|--------------------------------*/
	?>
			
	<div id="adres-saved-filters">
	
		<div class="ajax-response" style="margin-left: 10px;">
			
		<?php 
			/*-------------------------------
			| Shows the filters list from same element
			|--------------------------------*/			
			echo $this->element('ajax/save_filter') 
		?>
		
		
		</div>	
	</div><!-- // adres-saved-filters -->	
								
						<div class="clear"></div>
						</div>			
		
				</div>
				<div class="adres-left-sidebar-content-bottom"></div>
			
		</div>
		
</div>	
