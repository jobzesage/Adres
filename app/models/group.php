<?php  
class Group extends AppModel {
	
	public $name='Group';
	
	public $useTable='groups';
	
	public $actsAs=array('Containable');
	
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
	
	public function getCurrentGroups()
	{
		return	$this->find('all',array(
			'conditions'=>array('Group.parent_id'=>0)			
		));
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
	
}
?>