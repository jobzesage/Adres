<?php
class Affiliation extends AppModel {

	public $name = 'Affiliation';
	
	public $actsAs = array('Containable');
			
	public $belongsTo = array(
		'FatherContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_father_id'
		),
		'ChildContactType'=>array(
			'className' =>'ContactType',
			'foreignKey' => 'contact_type_child_id'
		)
	);
	
	public $hasMany = array(
		'Contact' => array(
			'className' => 'Contact', 
			'foreignKey' => 'affiliation_id'
		)
	);
	
	
	public function getList($contactTypeId){
		return $this->find('list',array(
			'conditions' => array(
				'OR'=>array(
					'Affiliation.contact_type_father_id'=>$contactTypeId,
					'Affiliation.contact_type_child_id'=>$contactTypeId
		))));
	}	
}
?>