<?php
class ContactType extends AppModel {

	public $name = 'ContactType';

	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'Implementation'=>array(
			'className'=>'Implementation',
			'foreignKey'=>'implementation_id'
		)
	);
	
	public $hasMany = array(
		'FatherAffiliation' => array(
			'className' => 'Affiliation', 
			'foreignKey' => 'contact_type_father_id'
		),
		'ChildAffiliation'=>array(
			'className'=>'Affiliation',
			'foreignKey'=>'contact_type_child_id'
		),
		'Contact'=>array(
			'className'=>'Contact',
			'foreignKey'=>'contact_type_id',
                        'fields'=>array('DISTINCT Contact.id')
		),
		'Field'=>array(
			'className'=>'Field',
			'foreignKey'=>'contact_type_id'
		),
		'Form'=>array(
			'className'=>'Form',
			'foreignKey'=>'contact_type_id'	
		),
		'CurrentGroup'=>array(
			'className'=>'Group',
			'foreignKey'=>'contact_type_id',
			'conditions'=>array('CurrentGroup.parent_id'=>0)
		),
		'Filter'=>array(
			'className'=>'Filter',
			'foreignKey'=>'contact_type_id'
		)
	);
	
	/**
	 * Generates the main array of contactType containing RecordSet and etc
	 *
	 * @param array $plugin_type i.e TypeString,TypeInteger
	 * @param integer $session_implementation_id 
	 * @return Array
	 * @author Rajib
	 */	
	public function getInfo($contact_type_id){
		return $this->find('all',array(
    		'contain'=>array(
    			'CurrentGroup',
    			'Filter',
    		),
    		'conditions'=>array(
    			'ContactType.id'=>$contact_type_id
    		)
		));
	}
	

	/**
	 * generates list for selection boxes
	 *
	 * @param integer $implementation_id 
	 * @return array
	 * @author Rajib
	 */
	public function getList($implementation_id=null){
		$conditions = null;
		if(isset($implementation_id) && !empty($implementation_id) ){
			$conditions = array('ContactType.implementation_id'=>$implementation_id);
		}
		return $this->find('list',array('conditions'=>$conditions));
	}

	/**
	 * gets all contact types of implementation
	 *
	 * @param integer $implementation_id 
	 * @return array
	 * @author Rajib
	 */	
	public function getAllByImplementationId($implementation_id = null){
		$conditions = null;
		if(isset($implementation_id) && !empty($implementation_id) ){
			$conditions = array('ContactType.implementation_id'=>$implementation_id);
		}
		return $this->find('all',array('conditions'=>$conditions));	
	}
	
	
	
	
	public function contacts($contact_type_id,$generated_conditions){

		return $this->find('all',array(
		    		'contain'=>array(
		    			'CurrentGroup',
		    			'Field',
		    			'Filter',
		    			'Contact'=>$generated_conditions
		    		),
		    		'conditions'=>array(
		    			'ContactType.id'=>$contact_type_id
		    		)
				));		
	}	
}
?>