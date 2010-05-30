<?php


class Filter extends AppModel {

	public $actsAs = array('Containable');
    
	public $name = 'Filter';
    
	public $belongsTo = array(
		'ContactType' => array(
			'className' => 'ContactType', 
			'foreignKey' => 'contact_type_id'
		));



	/*
			TODO have to implement filters serach methods written below
		*/	
	// 	public function addCriteria($name, $condition){
	// 	
	// 	$criteria = Filter::getCriteria();
	// 	
	// 	//Check that the criteria doesn't already exists
	// 	if(!in_array(array('name' => $name, 'condition' => $condition), $criteria)){
	// 		//Add it
	// 		$criteria[] = array('name' => $name, 'condition' => $condition);
	// 	}
	// 		
	// 	$_SESSION['criteria'] = serialize($criteria);
	// }
	// 
	// public function deleteCriteria($id){
	// 	$criteria = Filter::getCriteria();
	// 	unset($criteria[$id]);
	// 	$_SESSION['criteria'] = serialize($criteria);
	// }
	// 
	// 
	// public function addKeyword($keyword){
	// 	$_SESSION['keyword'] = $keyword;
	// }
	// 
	// public static function getKeyword(){
	// 	if(isset($_SESSION['keyword'])===false) {
	// 		return null;
	// 	}
	// 	else {
	// 		return $_SESSION['keyword'];
	// 	}
	// }
	// 
	// public function deleteKeyword(){
	// 	unset($_SESSION['keyword']);
	// }
	// 
	// public static function getCurrent()
	// {
	// 	$crit = new CDbCriteria();
	// 	$crit->addCondition("fil_imp_id = ".Implementation::getCurrentImplementation()->imp_id);
	// 	return Filter::model()->findAll($crit);
	// }
	// 
	// public static function loadFilter($fil_id)
	// {
	// 	$filter = Filter::model()->findByPk($fil_id);
	// 	$_SESSION['keyword'] = $filter->fil_keyword;
	// 	$_SESSION['criteria'] = $filter->fil_criteria;
	// 	return $filter;
	// }
	// 
	// public function saveFilter()
	// {
	// 	if(isset($_SESSION['keyword']))
	// 		$this->fil_keyword = $_SESSION['keyword'];
	// 	if(isset($_SESSION['criteria']))
	// 		$this->fil_criteria = $_SESSION['criteria'];
	// 	return $this->save();
	// }
	
	public function getFilters($contact_type_id)
	{
		return $this->find('all',array(
			'conditions'=>array(
				'Filter.contact_type_id'=>$contact_type_id				
			)
		));
	}	
}
?>