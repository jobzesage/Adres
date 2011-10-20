
	<?php  
	/*-------------------------------
	| Keyword Search Section
	|--------------------------------*/
	?>
	
<div class="adres-left-sidebar-box" style="margin-top: 0;">

		<div class="adres-left-sidebar-head">
			
				<a href="#"><img src="/css/theme1/images/help.png" alt="" title="help text here"></a>
				<!--a href="#"><img src="/css/theme1/images/add.png" alt="" title="add text here"></a-->
				<p>Search</p>
			
		</div>
		
		<div class="adres-left-sidebar-content">
					
				<div class="adres-search">

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
				
				<?php if(isset($this->params["url"]["include_trash"])): ?>
					<?php echo $html->link("Show contact",array("{$contactTypeId}"),array(
						'id' => 'show_trashed',
						'class' => 'advance adres-trash-icon' 
					)) ?>
				<?php else: ?>
					<?php echo $html->link("Show trashed",array("{$contactTypeId}?include_trash=true"),array(
						'id' => 'show_trashed',
						'class' => 'advance adres-trash-icon' 
					)) ?>
				<?php endif ?>
				
				<div class="clear"></div>
				</div>	
	
		</div>
		
</div>
		

	<?php  
	/*-------------------------------
	| Groups Filter Section
	|--------------------------------*/
	?>
	
<div class="adres-left-sidebar-box">

		<div class="adres-left-sidebar-head">
			
				<a href="#"><img src="/css/theme1/images/help.png" alt="" title="help text here"></a>
				<!--a href="#"><img src="/css/theme1/images/add.png" alt="" title="add text here"></a-->
				<p>Groups</p>
			
		</div>
		
		<div class="adres-left-sidebar-content">

				<?php if (isset($groups) and !empty($groups)): ?>
			
					<div id="adres-saved-group">
							
						<div id="group-tree" style="float: left; width: 184px; overflow: hidden; margin-bottom: 5px;">
							<?php echo $tree->generate($groups,array(
								'model' => 'Group',
								'element'=>'group_link',
							)) ?>
						</div>
					
					</div>
			
				<?php endif ?>
								
				<div class="clear"></div>		
			
		</div>
		
</div>


							
	<?php  
	/*-------------------------------
	| Keyword Filter Section
	|--------------------------------*/
	?>
	
<div class="adres-left-sidebar-box">

		<div class="adres-left-sidebar-head">
			
				<a href="#"><img src="/css/theme1/images/help.png" alt="" title="help text here"></a>
				<!--a href="#"><img src="/css/theme1/images/add.png" alt="" title="add text here"></a-->
				<p>Criterias</p>
			
		</div>
		
		<div class="adres-left-sidebar-content">
					
						<div class="adres-filter-hold">
	
								<?php if ($session->check('Filter.keyword') || $session->check('Filter.criteria')): ?>
						
								<?php $keyword = $session->read('Filter.keyword') ?>
						
								<?php if ($session->check('Filter.keyword')): ?>
									<div class="adres-criteria">
										<?php echo $html->link("Keyword : {$keyword}", array(
											'controller'=>'users',
											'action' => 'delete_keyword', 
											$keyword
										), array(
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
            		'div' => false,
            		'class'=>'group_list'
            	)) ?>

			<?php echo $form->end(array('label'=>'Add to group','class'=>'filter-add adres-button')) ?>


	<?php  
	/*-------------------------------
	| Filter Section
	|--------------------------------*/
	?>
	
						<div class="filter_line"></div>
					
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
								
						</div>
						
								<?php endif ?>
						
						<div class="clear"></div>

						</div><!-- adres-filter-hold -->

		</div>

</div>	
	
						<?php  
						/*-------------------------------
						| Saved Filter Section
						|--------------------------------*/
						?>
						
<div class="adres-left-sidebar-box">

		<div class="adres-left-sidebar-head">
			
				<a href="#"><img src="/css/theme1/images/help.png" alt="" title="help text here"></a>
				<!--a href="#"><img src="/css/theme1/images/add.png" alt="" title="add text here"></a-->
				<p>Filters</p>
			
		</div>
		
		<div class="adres-left-sidebar-content">
			
						<div class="adres-filter-hold">
								
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
		
</div>	

<script type="text/javascript">
$('.adres-left-sidebar-head a img[title]').qtip({ style: { name: 'blue', tip: true } })
</script>
