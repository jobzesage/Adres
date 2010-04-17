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
	public function retriveAssociationsBy($plugin_type,$session_implementation_id){
		return $this->find('all',array(
    		'contain'=>array(
    			'CurrentGroup',
    			'Field',
    			'Filter',
    			'Contact'=>$plugin_type
    		),
    		'conditions'=>array(
    			'ContactType.implementation_id'=>$session_implementation_id
    		)
		));
	}
	
	/**
	 * generate associated array recordset from the array provided
	 *
	 * @param array $contact_type 
	 * @param array $plugins 
	 * @return array
	 * @author Rajib
	 */
	public function generateRecordSet($contact_types,$plugins){
		$values=array();
		$data = array();
		$plugins = array_unique($plugins);
		foreach ($contact_types as $recordSet) {
			foreach ($recordSet['Contact'] as $contact) {
				foreach ($plugins as $key => $value) {
					$data[]= $contact[$value];
				}
			}//recordSet
		}//contactTypes
		
		//TODO sort have take place here or it wont work
		foreach ($data as $key) {
			foreach ($key as $value) {
				$values[ $value['contact_id'] ] ['id'] =  $value['contact_id']; 				
				$values[ $value['contact_id'] ] ['record'][] = $value; 
			}
		}
		return !empty($values) ? $values : false;
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
	
	
	
	/**
	 * This heart of search and listing contacts it only provides array retrived from the
	 * database to generateRecordSet for generating the record set
	 *
	 * @param array $plugin_type 
	 * @param integer $contact_type_id 	
	 * @return array
	 * @author Rajib
	 */
	public function retriveAssociationsByContactType(
		$plugin_type,
		$contact_type_id,
		$searchKey=null,
		$fields=array())
	{
		$plugins= array_unique($plugin_type);
		$pluginWithCondition =array(); 
		if(!empty($searchKey)){
			foreach ($plugins as $plugin) {

				//some improvements can be implementated by switch and preg
				$pluginWithCondition[$plugin]=array(
					'conditions'=>array(
						$plugin.'.data LIKE ?'=>'%'.$searchKey.'%'
					)
				);
			}//end foreach
			
			$search = $this->find('all',array(
	    		'contain'=>array(
	    			'Contact'=>$pluginWithCondition
	    		),
	    		'conditions'=>array(
	    			'ContactType.id'=>$contact_type_id
	    		)
			));

			$ids = $this->iterator($search,$plugins);
			
			$plugins = am($plugins,array('conditions'=>array('Contact.id'=>$ids)));
			$output = $this->find('all',array(
	    		'contain'=>array(
	    			'CurrentGroup',
	    			'Field',
	    			'Filter',
	    			'Contact'=>$plugins
	    		),
	    		'conditions'=>array(
	    			'ContactType.id'=>$contact_type_id
	    		)
			));	
			
		}elseif(!empty($fields)){
			$pg = array();
			$fields = Set::filter($fields);
			
			foreach ($plugins as $plugin) {
				$i=0;
				foreach ($fields as $field_id => $val) {
					$pg = Set::insert($pg,$plugin.'.conditions.OR.'.$i,
						array(
							'field_id'=>$field_id,
							'data LIKE ?'=>'%'.$val.'%'
						));
					$i++;
				}
			}
			//debug($pg);
			$search = $this->find('all',array(
				'contain'=>array(
					'Contact'=>$pg
				),
				'conditions'=>array(
					'ContactType.id'=>$contact_type_id
				)
			));

			$ids = $this->iterator($search,$plugins);
			$plugins = am($plugins,array('conditions'=>array('Contact.id'=>$ids)));
			$output = $this->find('all',array(
					'contain' => array(
		    			'CurrentGroup',
		    			'Field',
		    			'Filter',
		    			'Contact'=>$plugins	
		    		),
					'conditions' => array(
						'ContactType.id' => $contact_type_id, 
				)));
		}else{
			$output = $this->find('all',array(
	    		'contain'=>array(
	    			'CurrentGroup',
	    			'Field',
	    			'Filter',
	    			'Contact'=>$plugins
	    		),
	    		'conditions'=>array(
	    			'ContactType.id'=>$contact_type_id
	    		)
			));	
		}
		
		return $output; 
	}
	
	
	private function iterator($data,$plugins){
		$ids = array();
		//optimize this with cake Set utilities
		foreach ($data as $con) {
			foreach ($plugins as $plugin) {
				foreach ($con['Contact'] as $contact) {
					foreach($contact[$plugin] as $type)
						{$ids[]= $type['contact_id'];}
				}
			}
		}
		return $ids;		
	}
	
	
	public function loadFilter(){
		
	}
}
?>