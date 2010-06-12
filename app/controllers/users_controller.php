<?php
class UsersController extends AppController {
    
    public $name ='Users';
    
    public $uses=array('User','Contact','Filter','ContactSet','ContactType','Field','Group','Implementation');
    
    public $layout = "users";
    	
    public function index(){
    	
    	$this->set('users',$this->paginate());
    }

    public function register(){
        #$this-<br>>layout = null;
        if($this->data){                
            //TODO can improve the code here to use 
            if($this->data['User']['password']===$this->Auth->password($this->data['User']['confirm_password'])){
                #if($this->User->validate()){
                    $this->User->create();
                    $this->User->save($this->data);
                    $this->Session->setFlash(__("A email has been sent to your email address",true));
                #}
            }else{
                $this->Session->setFlash(__('Password mismatch',true));
            }
        }else{
            #$this->redirect('/login');
        }
    }



    public function login() {
    	$this->layout = null;
    	
    	if($this->Auth->user()){
    		$this->redirect(array('controller'=>'users','action'=>'home'));
    	}
	
    }

    public function logout() {
    	$this->Session->destroy();
        $this->redirect($this->Auth->logout());
        
    }
    

	public function delete($id=null){
		if (!$id) {
			$this->flash(__('Invalid User', true), array('action' => 'index'));
		}
		if ($this->User->del($id)) {
			$this->flash(__('Group deleted', true), array('action' => 'index'));
		}
		$this->flash(__('The Group could not be deleted. Please, try again.', true), array('action' => 'index'));
		
		
	}


    public function home(){
		if(!$this->isAuthenticated()){
			$this->flash('Something wrong','/');
		}
	
		$this->setImplementation();
		
		if(!$this->Session->check('Filter')){
		    //TODO have to implement Session filters
		}
        $this->set('types',$this->ContactType->getAllByImplementationId($this->Session->read('Implementation.id')));
    }
    	
	
	public function search(){
		$this->redirect_if_not_ajax_request();
		
		if(!isset($_GET['keyword'])){
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
		$this->Session->write('Filter.keyword',$_GET['keyword']);
		$this->set('status',true);
		$this->render('/elements/contacts');
	}
	
	public function advance_search(){
		debug($this->data);
		die();
	}
	
    public function edit_record($contact_id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($contact_id);
		
		$plugins = $this->Field->getPluginTypes($this->Session->read("Contact.contact_type_id"));
		$form_inputs = "";
		foreach ($plugins as $plugin) {
			$className = $plugin['Field']['field_type_class_name'];
			$form_inputs .= ClassRegistry::init($className)->renderEditForm($contact_id,$plugin);
		}
		$form_inputs .= "<input id='edit-contact-id' type='hidden' name='data[contact_id]' value='$contact_id'>";
		$this->set('form_inputs',$form_inputs);
		$this->set('contactId',$contact_id);
		$this->set('status',true);
    }


	public function show_record($id=null){
		//$this->redirect_if_not_ajax_request();
		//$this->redirect_if_id_is_empty($id);
		$contact = $this->Contact->read(null,$id);
		$value =array();
		$plugins = $this->Field->getPluginTypes($contact['Contact']['contact_type_id']);
		$output='';
		
		foreach($plugins as $field){
			//TODO refactoring is needed here
			// this can be put into the plugin model
			$pluginName 	= $field['Field']['field_type_class_name'];
			$field_name		= $field['Field']['name'];
			$field_id 		= $field['Field']['id'];
			$contact_field 	= ClassRegistry::init($pluginName)->getJoinContact();
			$join_field		= ClassRegistry::init($pluginName)->getJoinField();
			
			$value = ClassRegistry::init($pluginName)->find('first',array(
				//'contain'=>array('Field'),
				'conditions'=>array(
				$pluginName.'.'.$contact_field .' = '.$id,
				$pluginName.'.'.$join_field .' = '.$field_id 
				)	
			));
			
			if(empty($value)){
				ClassRegistry::init($pluginName)->save(
					array(
						$contact_field => $id,
						$join_field => $field_id
					)	
				);
								
			}
			$output.= ClassRegistry::init($pluginName)->renderShowDetail($field_name,$value);
		}
		$this->set('contact',$output); 
		$this->set('contactId',$id);
		$this->set('status',true);
    }
	
    public function delete_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		$this->Contact->id = $id;
		$this->Contact->ContactType->id = $this->Session->read('Contact.contact_type_id');
		
		if($this->Contact->delete($id)){
			$this->set('status',true);
		}
    }    
    

    public function display_contacts($contact_type_id=null){
		
		$types = $this->ContactType->getList($this->Session->read('Implementation.id'));
		if($contact_type_id){
			$this->Session->write('Contact.contact_type_id',$contact_type_id);
		}
    	
		$fields   = $this->Field->getPluginTypes($contact_type_id);
		$keyword  = "";
		$criteria = "";
		
		if($this->Session->check('Filter.criteria')) 
		{
			$criteria = $this->getSQL(unserialize($this->Session->read('Filter.criteria')));
		}
		
		if($this->Session->check('Filter.keyword')) $keyword = $this->Session->read('Filter.keyword');
		
		$search=array(
			'searchKeyword'=>$keyword,
			'filters'=>$criteria,
			'plugins'=>$fields
		);
				
		$values = $this->ContactSet->getContactSet($contact_type_id,$search);
		
		$this->set('values',$values);
		
		$filters = $this->Filter->getFilters($contact_type_id);
		
		$this->set('groups',$this->Group->getCurrentGroups($contact_type_id));
		
    	$this->set(compact('fields','filters','contact_type_id'));
    	$this->set(compact('contact_types','contact_type_id'));

		$this->render('/elements/contacts');
    }
    

	public function test(){
		if(!empty($this->data)){
			$this->Contact->user_id = $this->Auth->User('id');
			$contact_type_id = $this->data['Contact']['contact_type_id'];
			$plugins = $this->Field->getPluginTypes($contact_type_id);
			$contact = $this->data;
			$this->Contact->update_record($contact, $plugins);
			$this->set(compact('plugins'));
		}
	}


	public function add_record(){
		$this->set('status',true);		
		if(!empty($this->data)){
			
		}else {
			$this->Contact->user_id = $this->Auth->user('id');
			$this->Contact->ContactType->id = $this->Session->read('Contact.contact_type_id');
			
			$this->Contact->save(array(
				'contact_type_id'=>$this->Session->read('Contact.contact_type_id')
			));
			$contact_id = $this->Contact->getLastInsertID();
			$plugins = $this->Field->getPluginTypes($this->Session->read("Contact.contact_type_id"));
			
			$data = array();
			foreach($plugins as $field){
				//TODO refactoring is needed here
				// this can be put into the plugin model
				$pluginName 	= $field['Field']['field_type_class_name'];
				$field_name		= $field['Field']['name'];
				$field_id 		= $field['Field']['id'];
				$contact_field 	= ClassRegistry::init($pluginName)->getJoinContact();
				$join_field		= ClassRegistry::init($pluginName)->getJoinField();
				

				$data[$pluginName][] =array(
					$contact_field => $contact_id,
					$join_field => $field_id
				);	
			}
			foreach ($data as $pluginName => $value) {
				ClassRegistry::init($pluginName)->saveAll($value);
			}
			$form_inputs = "";
			foreach ($plugins as $plugin) {
				$className = $plugin['Field']['field_type_class_name'];
				$form_inputs .= ClassRegistry::init($className)->renderEditForm($contact_id,$plugin);
			}
			$form_inputs .= "<input id='edit-contact-id' type='hidden' name='data[contact_id]' value='$contact_id'>";
			$this->set('form_inputs',$form_inputs);
			$this->set('contactId',$contact_id);
			$this->render('edit_record');

		}

	}



	public function show_details($contact_id){
		
		$contact = $this->Contact->find('first',array(
			'contain'=>array(
				'Group',
				'ParentAffiliation',
				'ChildAffiliation',
				'Log'=>array('User')
			),
			'conditions'=>array(
				'Contact.id'=>$contact_id
			)	
		));
		$groups = $this->Group->getList($contact);
		$this->set(compact('contact','groups','contact_id'));
		$this->set('status',true);
	}
	

	public function edit_details($contact_id){
		$this->set('status',true);
		$plugins = $this->Field->getPluginTypes($this->Session->read("Contact.contact_type_id"));
		$form_inputs = "";
		foreach ($plugins as $plugin) {
			$className = $plugin['Field']['field_type_class_name'];
			$form_inputs .= ClassRegistry::init($className)->renderEditForm($contact_id,$plugin);
		}
		$form_inputs .= "<input type='hidden' name='data[contact_id]' value='$contact_id'>";
		$this->set('form_inputs',$form_inputs);
	}
	
	public function update_contact(){
		$this->set('status',true);
		if(!empty($this->data)){
			$plugins = $this->Field->getPluginTypes($this->Session->read("Contact.contact_type_id"));
						
			ClassRegistry::init('Plugin')->processEditForm($this->data,$plugins,$this->Auth->User('id'));
		}
		$this->render(null);
	}
	
	
	public function add_keyword($keyword=null){
		$this->set('status',true);
		$this->Session->write('Filter.keyword',$this->params['url']['keyword']);
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));

	}
	
	
	public function add_criteria($criteria=null){
		
		$this->set('status',true);
		$criterias = array();
		
		if(!empty($this->data)){
			$searchKeys = $this->data['AdvanceSearch'];
			foreach($searchKeys as $field_id => $value)
			{

				if(!empty($value))
				{
					$pluginName = $this->Field->read(array('field_type_class_name','name'),$field_id);
					$plugin = $pluginName['Field']['field_type_class_name'];
					$column_name = $pluginName['Field']['name'];
					$criterias[] = ClassRegistry::init($plugin)->renderAdvancedSearch($field_id,$column_name,$value);					
				}
									
			}
			if(!empty($criterias)){
				if($this->Session->check('Filter.criteria')){
					//add to stack
					$previous_criterias = unserialize($this->Session->read('Filter.criteria'));
					
					foreach ($criterias as $criteria) {
						if(!in_array(array('name'=>$criteria['name'],'sql'=>$criteria['sql']),$previous_criterias))
						{
							$previous_criterias[]=$criteria;
						}
					}					
				}
				else {

					$previous_criterias = $criterias;
				}
				
				$this->Session->write('Filter.criteria',serialize($previous_criterias));
			}
		}
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));

	}
	
	

	public function delete_keyword($keyword=null){
		$this->set('status',true);
		$this->Session->del('Filter.keyword');
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));
	}
	
	public function delete_criteria(){
		$this->set('status',true);
		
		if($this->Session->check('Filter.criteria')){
			$criterias = unserialize( $this->Session->read('Filter.criteria'));
			$params= $this->params['named'];
			
			if(!empty($params)){
				unset($criterias[$params['id']]);
			}
			
			if(!empty($criterias)){
				$this->Session->write('Filter.criteria',serialize($criterias));
			}else{
				$this->Session->del('Filter.criteria');
			}
		}	
		//$this->redirect(array('controller'=>'users','action'=>'home'));
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));
	}		
	
	public function load_filter($id=null){
		//$this->redirect_if_not_ajax_request();
		$filter = ClassRegistry::init('Filter')->read(null,$id);
		$filter = Set::filter($filter);
		if(!empty($filter)){
			$this->Session->write($filter);
		}
		$this->set('status',true);
		$this->set('test',$filter);

		$this->display_contacts($this->Session->read('Contact.contact_type_id'));

	}
	
	public function load_group($id=null){
		if($id){
			$group = $this->Group->read(null,$id);
			$group_filter =array();
			//add to stack
			$previous_criterias = $this->Session->check('Filter.criteria') ? unserialize($this->Session->read('Filter.criteria')) : array();
			$group_filter = array('name'=>'Group :'.$group['Group']['name'],'sql'=>"ContactGroup.group_id=$id");
			if(!in_array($group_filter,$previous_criterias))
			{
				$previous_criterias[]=$group_filter;
			}
		}
		$this->Session->write('Filter.criteria',serialize($previous_criterias));
		$this->set('status',true);
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));
		
	}	
	
	public function save_filter()
	{
		
		$keyword 	= $this->Session->check('Filter.keyword')	? $this->Session->read('Filter.keyword')	:'';
		$criteria 	= $this->Session->check('Filter.criteria')	? $this->Session->read('Filter.criteria')	:'';
		$group		= $this->Session->check('Filter.group') 	? $this->Session->read('Filter.group') 	: null;
		
		$contact_type_id = $this->Session->read('Contact.contact_type_id');
		if ($this->Session->check('Filter') AND !empty($this->data)) {
			$this->set('status',true);
			ClassRegistry::init('Filter')->save(
				array(
					'name'=>$this->data['Filter']['name'],
					'keyword'=>$keyword,
					'criteria'=>$criteria,
					'contact_type_id' => $contact_type_id
			));
			$filters = ClassRegistry::init('Filter')->find('all',array('conditions'=>array(
				'contact_type_id'=>$contact_type_id
			)));
			
			$this->set('filters',$filters);
		}
	}
	
	
	public function export()
	{
		$this->layout= 'default';
		$this->helpers = array('Csv');		

		$search = $this->setContactSet();
		$values = $this->ContactSet->getContactSet($contact_type_id,$search);
		$this->set('values',$values);
	}

	public function test_paging()
	{
		$paging = $this->params['named'];
		$this->set('test',	$this->setContactSet($paging));
	}
	
    //private functions
    
    private function getSQL($criterias){
    	$where = ' ';
		foreach($criterias as $value){
			$where = $where.' AND '.$value['sql'];
		}
		return $where;
	}

    private function setImplementation(){
    	if(!$this->Session->check('Implementation')){
    		$implementation = ClassRegistry::init('Implementation')->find(
    			'first',array(
    				'fields'=>array('id','name')
    			));
			$this->Session->write('Implementation',$implementation['Implementation']);
    	}
    }
    
    
    
    private function setContactSet($options = array())
    {
		$contact_type_id = $this->Session->read('Contact.contact_type_id');
		$fields   = $this->Field->getPluginTypes($contact_type_id);
		$keyword  = "";
		$criteria = "";
		
		if($this->Session->check('Filter.criteria')) 
		{
			$criteria = $this->getSQL(unserialize($this->Session->read('Filter.criteria')));
		}
		
		if($this->Session->check('Filter.keyword')) $keyword = $this->Session->read('Filter.keyword');
		
		$search=array('searchKeyword'=>$keyword,'filters'=>$criteria,'plugins'=>$fields);
		
		return am($search,$options); 
		
    }    
}
?>