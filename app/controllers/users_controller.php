<?php
class UsersController extends AppController {

    public $name ='Users';

    public $uses=array(
    	'User',
    	'Contact',
    	'Filter',
    	'ContactSet',
    	'ContactType',
    	'Field',
    	'Group',
    	'Implementation'
    );
    public $layout = "users";

    public function index(){
    	$this->layout = "administrator";
    	$this->set('users',$this->paginate());
    }

    public function register(){
    	$this->layout = 'administrator';
        if($this->data){
            //TODO can improve the code here to use
            if($this->data['User']['password']===$this->Auth->password($this->data['User']['confirm_password'])){
                #if($this->User->validate()){
                    $this->User->create();
                    $this->User->save($this->data);
                    $this->setFlash(__("A email has been sent to your email address",true));
                #}
            }else{
                $this->setFlash(__('Password mismatch',true),'failure');
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


    public function edit($id=null){
		$user = $this->User->findById($id);

        if (!empty($this->data)){
			if($this->User->save($this->data)){
				$this->setFlash(__("User updated", true), array('action'=>"index"));
			}
		}
		if(!empty($user)){
			$this->data = $user;
		}

    }


	public function delete($id=null){
		if (!$id) {
			$this->flash(__('Invalid User', true), array('action' => 'index'));
		}
		if ($this->User->del($id)) {
			$this->flash(__('User deleted', true), array('action' => 'index'));
		}
		$this->flash(__('The User could not be deleted. Please, try again.', true), array('action' => 'index'));
	}


    public function home(){

		if(!$this->isAuthenticated()){
			$this->flash('Something wrong','/');
		}

		$this->setImplementation();

		//for implementing the date on session
		$this->Session->write('Contact.dates',array());
        $this->Session->write('Contact.encrytor_key',null);


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
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
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

		$this->set('sContact',$output);

		$contact = $this->Contact->getContact($contact_id);
		$groups = $this->Group->getList($contact);
		$this->set(compact('contact','groups'));
		$this->set('status',true);
    }

    //FIXME : delete this when trashing works
    /*public function delete_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		$this->Contact->id = $id;
		$this->Contact->ContactType->id = $this->Session->read('Contact.contact_type_id');

		if($this->Contact->delete($id)){
			$this->set('status',true);
		}
    }
    */

    public function display_contacts($contact_type_id=null){

		$types = $this->ContactType->getList($this->Session->read('Implementation.id'));

		if($contact_type_id){
            $this->Session->write('Contact.contact_type_id',$contact_type_id);
            $this->Cookie->write('contact_type_id',$contact_type_id,false);
            $this->Session->write('Contact.dates');
		}


        $options = array();
        if(array_key_exists('include_trash',$this->params['url'])){
            $include_trash= $this->params['url']['include_trash'];
            $this->Session->write('Contact.include_trash',(bool) $include_trash);
		}

		$search = $this->setContactSet($options);
		$values = $this->ContactSet->getContactSet($contact_type_id,$search);

		$count = $values['count'];
		$paging['pages'] = ceil($count/$this->ContactSet->page_size);
		$this->set('values',$values['data']);

		$filters = $this->Filter->getFilters($contact_type_id);

		$this->set('groups',$this->Group->getTree($contact_type_id));

//		$this->set('affs',$ = ClassRegistry::init('Affiliation')->getList($contact_type_id));

    	$this->set(compact(
    		'fields','filters','paging','count',
            'contact_types','contact_type_id',
            'include_trash'
    	));

		$this->render('/elements/contacts');
    }




	public function add_record($contact_type_id=null){
		$this->set('status',true);


		if(empty($this->data)){

			$this->Contact->user_id = $this->Auth->user('id');
			$this->Contact->ContactType->id = $contact_type_id ;


			$this->Contact->save(array(
				'contact_type_id'=>$this->Contact->ContactType->id
            ));

			$contact_id = $this->Contact->getLastInsertID();
			$plugins = $this->Field->getPluginTypes($contact_type_id);

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
                $form_inputs .= ClassRegistry::init($className)->renderEditForm($contact_id,$plugin,array(
                        'contact_type_id'=>$contact_type_id
                    ));
			}
			$form_inputs .= "<input id='edit-contact-id' type='hidden' name='data[contact_id]' value='$contact_id'>";
			$form_inputs .= "<input id='edit-contact-id' type='hidden' name='data[contact_type_id]' value='$contact_type_id'>";

			$this->set('form_inputs',$form_inputs);
			$this->set('contactId',$contact_id);

			$this->set('affiliations',$this->Contact->Affiliation->getList($this->Contact->ContactType->id));
			$this->render('edit_record');
		}

	}


    public function new_record(){

        $aff = $this->params['url']['affiliation'];
        $affiliation_id = (int) substr($aff,1);
        $affiliation_type = substr($aff,0,1);
        $affiliation = $this->Contact->Affiliation->read(null,$affiliation_id);
        $contact_type_id = $affiliation['Affiliation']['contact_type_father_id'];
        if($affiliation_type=='f'){
            $contact_type_id = $affiliation['Affiliation']['contact_type_child_id'];
        }
        $this->add_record($contact_type_id);
    }

	public function show_details($contact_id){
		$contact = $this->Contact->getContact($contact_id);
		$groups = $this->Group->getList($contact);
		$this->set(compact('contact','groups','contact_id'));
		$this->set('status',true);
	}


	public function edit_details($contact_id){
		$this->set('status',true);
		$contact = $this->Contact->getContact($contact_id);

		$this->set(compact('contact','contact_id'));
	}

	public function update_contact(){
		$this->layout = "users";
		$this->set('status',true);
		if(!empty($this->data)){
			$plugins = $this->Field->getPluginTypes($this->data['contact_type_id']);
			//clear unparsable data
			$data = $this->data;
			unset($data['_Token']);
			unset($data['contact_id']);
			unset($data['contact_type_id']);

			foreach ($plugins as $field) {
				$field_name = $field['Field']['name'];
				$className = $field['Field']['field_type_class_name'];
				ClassRegistry::init($className)->processEditForm(array(
					'field_id'=> $field['Field']['id'],
					'contact_id'=> $this->data['contact_id'],
					'form'=>$data,
					'className'=>$className,
					'field_name'=>$field_name,
					'user_id'=> $this->Auth->user('id')
				));
			}
		}
		//$this->redirect(array('controller'=>'users','action'=>'home'));
	}


	public function add_keyword(){
		$this->set('status',true);
		$this->Session->write('Filter.keyword',$this->params['url']['keyword']);
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));
	}


	public function add_criteria($criteria=null){

		$this->set('status',true);
		$criterias = array();

		if(!empty($this->data)){

			$searchKeys = $this->data['AdvanceSearch'];
			$searchKeys = Set::filter($searchKeys);

			foreach($searchKeys as $field_id => $value)
			{
				if(isset($value))
				{
					$pluginName = $this->Field->read(array('field_type_class_name','name'),$field_id);
					$plugin = $pluginName['Field']['field_type_class_name'];
					$column_name = $pluginName['Field']['name'];
					$criterias[] = ClassRegistry::init($plugin)->processAdvancedSearch($field_id,$column_name,$value);
				}
			}

			## cleaning up for boolean to work
			$criterias = Set::filter($criterias);

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
		$this->redirect_if_not_ajax_request();
		$this->layout = 'users';
		$filter = ClassRegistry::init('Filter')->read(null,$id);
		$filter['Filter'] = Set::filter($filter['Filter']);

		if(!empty($filter)){
			$this->Session->write($filter);
		}
		$this->set('status',true);
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));
	}

	public function load_group($id=null){
		if($id){
			$group = $this->Group->read(null,$id);
			$group_children = $this->Group->children($id);
		    // leaf node of the group tree
			$ids = $id;
			if(!empty($group_children))
			{
				$children_ids = Set::extract('/Group/id',$group_children);
				$children_ids[] = $id;
				$ids = implode($children_ids, ',' );
            }

			$group_filter =array();
			//add to stack
			$previous_criterias = $this->Session->check('Filter.criteria') ? unserialize($this->Session->read('Filter.criteria')) : array();
			$group_filter = array('name'=>'Group : '.$group['Group']['name'],'sql'=>"ContactGroup.group_id IN($ids)");
			if(!in_array($group_filter,$previous_criterias)){
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

		$this->render('/elements/ajax/save_filter');
	}


	public function export()
	{
		$this->layout= 'default';
		$this->helpers = array('Csv');
		$contact_type_id = $this->Session->read('Contact.contact_type_id');
		$search = $this->setContactSet();

		$search['paging'] = false;		#to export all the records filtered or not filtered have to disable the paging
	    $search['include_trash']=false;
		$values = $this->ContactSet->getContactSet($contact_type_id,$search);
		$this->set('values',$values['data']);
	}

	public function paging()
	{
		$this->set('status',true);
		$paging = $this->params['named'];
		$search = $this->setContactSet($paging);
		$contact_type_id = $this->Session->read('Contact.contact_type_id');

		$contacts = $this->ContactSet->getContactSet($contact_type_id, $search);

		$count = $contacts['count'];

		$paging['pages'] = ceil($count/$this->ContactSet->page_size);

		$values = $contacts['data'];

		$this->set(compact('values','paging','count'));
		$this->render('/elements/adres_data_grid');
	}



	// generates the links for tabs panel
	public function show_contact_panel($id)
	{
		$this->set('contact_id',$id);
    }



    //private functions

    private function setImplementation(){
    	if(!$this->Session->check('Implementation')){
    		$implementation = ClassRegistry::init('Implementation')->find(
    			'first',array(
    				'fields'=>array('id','name')
    			));
			$this->Session->write('Implementation',$implementation['Implementation']);
    	}
    }


    public function add_to_group()
    {
	    $contact_type_id = $this->Session->read('Contact.contact_type_id');
	    if ($this->data) {
			$search = $this->setContactSet();
	        $search['group_id'] = $this->data['Group']['group_id'];
	        $grp = array();
	        $grp = $this->ContactSet->getContactIds($contact_type_id,$search);
	        $this->Group->ContactsGroup->saveAll($grp);
	    }

        $this->set('status',true);
    }

    public function search_by_affiliation()
	{
		$this->set('status',true);
		$affiliation_id = substr($this->data['Affiliation']['affiliation_id'],1);
		$affiliation_type = substr($this->data['Affiliation']['affiliation_id'],0,1);

		$af = ClassRegistry::init('Affiliation')->findById($affiliation_id);

		$contact_father_id  = $this->data['Affiliation']['contact_id'] ;
		$sql = "";

        $text = $af['Affiliation']['child_name'];
		if($affiliation_type == 'f'){
			$text = $af['Affiliation']['father_name'];
		}


        if ( (int) $this->data['Affiliation']['filter_id']) {
            $filter = $this->Filter->read(null,$this->data['Affiliation']['filter_id']);
            $criteria = !empty($filter['Filter']['criteria']) ? $filter['Filter']['criteria'] : array();
            $search = $this->setContactSet(array(
                    'searchKeyword' => $filter['Filter']['keyword'],
                    'filters'       => $criteria
                ),
                $filter['Filter']['contact_type_id']
            );
            $this->ContactSet->_group = false;
            $ids = $this->ContactSet->getContactIds($filter['Filter']['contact_type_id'],$search);

            $contact_child_ids = array();
            foreach ($ids as $k => $v){
                $contact_child_ids[] = $v['contact_id'];
            }
        }

		if( !empty($contact_father_id) ){
            $sql = ' SELECT * FROM affiliations_contacts AffiliationContact
                WHERE affiliation_id ='.$affiliation_id .' and contact_father_id ='.$contact_father_id;
			$affiliations= $this->User->query( $sql );
			$contact_ids = Set::extract($affiliations,'/AffiliationContact/contact_child_id');
			$tmp= $text;
			$text = "contact ".$contact_father_id;
            $text .=" ".$tmp;

        }elseif(isset($contact_child_ids) && !empty($contact_child_ids)){
            $current_contact_type_id = $this->Session->read('Contact.contact_type_id');
            $column_name = 'contact_father_id';
            $extract_by_depth = '/AffiliationContact/contact_child_id';
            if((int) $aff['contact_type_father_id'] == (int) $current_contact_type_id ){
                $column_name = 'contact_child_id';
                $extract_by_depth = '/AffiliationContact/contact_father_id';
            }

            $sql = ' SELECT * FROM affiliations_contacts AffiliationContact
                WHERE affiliation_id ='.$affiliation_id.'
                AND '.$column_name.' in ('.implode(',', $contact_child_ids).')';
            $affiliations = $this->User->query($sql);
            $contact_ids = Set::extract($affiliations,$extract_by_depth);
            $text .=' affiliated';
		}else{
			$sql = ' SELECT * FROM affiliations_contacts AffiliationContact WHERE affiliation_id ='.$affiliation_id ;
			$affiliations= $this->User->query( $sql );
            $contact_ids = Set::extract($affiliations,'/AffiliationContact/contact_father_id');
		}

		$ids = implode($contact_ids,',');

		$group_filter =array();
		//add to stack
		$previous_criterias = $this->Session->check('Filter.criteria') ? unserialize($this->Session->read('Filter.criteria')) : array();
        $group_filter = array('name'=>$text,'sql'=>"Contact.id IN ($ids)");
		if(!in_array($group_filter,$previous_criterias)){
			$previous_criterias[]=$group_filter;
		}

		$this->Session->write('Filter.criteria',serialize($previous_criterias));
		$this->display_contacts($this->Session->read('Contact.contact_type_id'));
    }

 }
