<?php
class Field extends AppModel {

	public $name = 'Field';
	
	public $actsAs = array('Containable');
	
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id',
		)
	);
	
	
	public $hasAndBelongsToMany = array(
		'Form' => array(
			'className' => 'Form', 
			'foreignKey' => 'field_id',
			'associationForeignKey' => 'form_id',
			'joinTable'=>'forms_fields'
		)
	);
	

	/**
	 * This function gives all the Fields of secific contact beside giving the user specific hidden 
	 *	column.
	 *
	 * @param integer $contactType 
	 * @param mixed $hidden_fields 
	 * @return array It generates a associative array of fields that are viewable by the user
	 * @author Rajib
	 */
	public function getPluginTypes($contactType,$hidden_fields=array()){
		
		$conditions = array(
			'Field.contact_type_id'=>$contactType 
		) ;
		
		if(!empty($hidden_fields)){
			$hidden = array(
				'NOT'=>array('Field.id' => $hidden_fields) 
			);
			$conditions = am($conditions,$hidden);
		}
		
		$fields = $this->find('all',array(
			'conditions' =>$conditions,
		));

		return $fields;
	}	


	public function getFieldTypes($contactType){
		$fields = $this->find('all',array(
			#'fields'=>array('Field.field_type_class_name, Field.name'),
			'conditions' => array('Field.contact_type_id'=>$contactType ) 
		));		

		$field_list = array();
		foreach ($fields as $plugin) {
			//$className = $plugin['Field']['field_type_class_name'];
			$field_list[$plugin['Field']['name']] = $plugin['Field']['id'];				
		}
		return $field_list;
	}
	
	
	public function getList($ids=array())
	{
		return $this->find('list',array(
			'conditions' => array(
				'Field.id' => $ids 
			) 
		));	
	}
}
?>