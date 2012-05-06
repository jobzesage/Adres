<?php


class Filter extends AppModel {

	public $actsAs = array('Containable');

	public $name = 'Filter';

	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType',
			'foreignKey' => 'contact_type_id'
		));



	public function getFilters($contact_type_id)
	{
		return $this->find('all',array(
			'conditions'=>array(
				'Filter.contact_type_id'=>$contact_type_id
			)
		));
    }


    public function getList($contact_type_id){
  		return $this->find('list',array(
			'conditions'=>array(
				'Filter.contact_type_id'=>$contact_type_id
			)
		));
    }
}
