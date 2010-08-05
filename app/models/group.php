<?php  
class Group extends AppModel {
	
	public $name='Group';
	
	public $useTable='groups';
	
	public $actsAs=array('Containable','Tree');
	
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group', 
			'foreignKey' => 'parent_id'
		),
		'ContactType'=>array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id',
		)
	);
	
	public $hasMany = array(
		'SubGroup' => array(
			'className' => 'Group', 
			'foreignKey' => 'parent_id'
		));
	
	public $hasAndBelongsToMany = array(
		'Contact' => array(
			'className' => 'Contact', 
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'contact_id'
	));
	
	
	
	protected function getGroupsRecrusively($group){
		
		$subgroups = $this->find('all',array(
			'conditions' => array(
				'Group.parent_id' => $group['Group']['id'], 
			) 
		));
		
		$result = array();
		
		foreach ($subgroups as $subgroup) {
			$result[$subgroup['Group']['id']] = array(
				'Group'=> $subgroup['Group'] , 
				'SubGroup'=>$this->getGroupsRecrusively($subgroup)
			);
		}
			
		return $result;
	}
	
	public function getCurrentGroups($contact_type_id){
		
		$currentGroups = $this->find('all',array(
			'conditions'=>array(
				'Group.parent_id'=>0,
				'Group.contact_type_id'=>$contact_type_id
			)			
		));
		
		$list = array();
		foreach ($currentGroups as $group) {
			$list[$group['Group']['id']] = array(
				'Group' => $group['Group'],
				'SubGroup' =>	$this->getGroupsRecrusively($group)
			);
		}
		
		//FireCake::fb($list)
		//return $currentGroups; # return $list which holds all the n nested groups	
		return $list;
	}

	
	public function getList($contact){
		
		$list = $this->find('list',array('conditions'=>array(
			'Group.contact_type_id'=>$contact['Contact']['contact_type_id']	
		)));
		foreach ($contact['Group'] as $group) {
			unset($list[$group['id']]);
		}
		
		return $list;
	}
	
	/**
	 * This function generates group tree data from nested data model
	 * this will generate the cakephp array result set first
	 * then the tree helper is used to wrap the tree nodes with proper html
	 *
	 * http://dev.mysql.com/tech-resources/articles/hierarchical-data.html
	 *
	 * @param integer $contact_type 
	 * @return void
	 * @author Rajib
	 */
	public function getTree($contact_type_id=null){
		$conditions = array();
		if($contact_type_id){
			$conditions = array(
				'Group.contact_type_id' => $contact_type_id
			);
		}
		
		return $this->find('all',array(
			'conditions' => $conditions,
			'fields'=>array('name','lft','rght'),
			'order' => 'Group.lft asc'
		));
		
	}
		
}
?>