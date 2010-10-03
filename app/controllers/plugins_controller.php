<?php
/**
 * sController
 * 
 * [Short Description]
 *
 * @package default
 * @author Rajib
 * @version $Id$
 * @copyright 
 **/

class PluginsController extends AppController {
/**
 * The name of this controller. Controller names are plural, named after the model they manipulate.
 *
 * @var string
 * @access public
 */
	var $name = 'Plugins';




	public function index() {

	}


	public function view($id = null) {
	}
	
	public function add(){
		
		if (!$this->data) {
			$params = $this->params['named'];
			$className = $this->getFieldClassType($params['field_id']);
			$optionsName = $className.'Option';
			$this->set('input_field',ClassRegistry::init($optionsName)->add($params));
		}
		else{
			$className = $this->getFieldClassType($this->data['field_id']);
			$optionsName = $className.'Option';
			ClassRegistry::init($optionsName)->processAdd($this->data);
			$this->redirect(array(
				'controller' => 'sites', 
				'action' => 'plugin_options', 
				'contact_type_id'=>$this->data['contact_type_id'],
				'field_id' => $this->data['field_id'] 
			));
		}
	
	}
}
?>