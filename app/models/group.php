<?php  
class Group extends AppModel {
	
	public $name='Group';
	
	public $useTable='groups';
	
	public $actsAs=array('Containable','Tree');
	
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id'
	));
	
	public $hasAndBelongsToMany = array(
		'Contact' => array(
			'className' => 'Contact', 
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'contact_id'
	));
	//This constructor aims at creating a virtualField for the list of groups
	//sadly this feature only comes with CakePHP 1.3, it might be useful after the migration
	/*
	function __construct($id = false, $table = null, $ds = null) {
    	parent::__construct($id, $table, $ds);
    	$this->virtualFields['group_list'] = sprintf('GROUP_CONCAT(%s.name SEPARATOR ", ")', $this->alias);
    	echo("ALIAS:".$this->alias."   TABLE:".$table."    ID:".$id."    DS:".$ds."</br>");
    	debug($id);debug($table);debug($ds);
    	//debug($this);
    }
    */
	
	//Returns a flat list of the ids of all the children of a parent
	//Jonathan Bigler Nov. 2011
	public function getSubgroups($parentGroupId){
	
		$subgroups = $this->find('all',array(
			'conditions' => array(
				'Group.parent_id' => $parentGroupId, 
			)
		));
		
		$result = array();
		
		foreach ($subgroups as $subgroup) {
			
			$result = array_merge($result, array($subgroup['Group']['id']), $this->getSubgroups($subgroup['Group']['id']));
		}
			
		return $result;
		
	}
	
	
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
	 * @return mixed
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
			'fields'=>array('id','name','lft','rght'),
			'order' => 'Group.lft asc'
		));
		
	}
		
}
?>