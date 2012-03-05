<?php
class SitesController extends AppController {

    public $name ='Sites';

    public $uses=array(
    	'Contact',
    	'User',
    	'Filter',
    	'ContactSet',
    	'ContactType',
    	'Field',
    	'Group',
    	'Affiliation',
    	'Log'
    );

    public $layout = "users";

    public function edit_record($contact_id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($contact_id);

                $contact_type_id =$this->Session->read("Contact.contact_type_id");
                $plugins = $this->Field->getPluginTypes($contact_type_id);
                $option= array('contact_type_id'=>$contact_type_id);
		$form_inputs = "";
		foreach ($plugins as $plugin) {
			$className = $plugin['Field']['field_type_class_name'];
			$form_inputs .= ClassRegistry::init($className)->renderEditForm($contact_id,$plugin,$option);
		}
		$form_inputs .= "<input id='edit-contact-id' type='hidden' name='data[contact_id]' value='$contact_id'>";
		$form_inputs .= "<input id='edit-contact-id' type='hidden' name='data[contact_type_id]' value='$contact_type_id'>";
		$this->set('form_inputs',$form_inputs);
		$this->set('contactId',$contact_id);
    }


	public function show_record($id=null){
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($id);
		$contact = $this->Contact->read(null,$id);
		$value =array();

		$plugins = $this->Field->getPluginTypes($contact['Contact']['contact_type_id']);
		$output='';

		//Some metaprogramming is goin on the getTitle
		$output = $this->getTitle($id,$plugins,"renderShowDetail");

		$this->set('contact',$output);
		$this->set('contactId',$id);
		$this->set('status',true);
    }


	public function update_contact(){
		$this->set('status',true);
		if(!empty($this->data)){
		    $plugins = $this->Field->getPluginTypes($this->Session->read("Contact.contact_type_id"));
            ClassRegistry::init('Plugin')->processEditForm($this->data,$plugins,$this->Auth->User('id'));
		}
		$this->render(false);
	}


	public function group($contact_id)
	{
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($contact_id);
		$contact = $this->Contact->getContactGroups($contact_id);
		$groups = $this->Group->getList($contact);
		$this->set(compact('contact','groups'));
		//$this->render('/elements/contact_groups');
	}


	public function affiliate($contact_id)
	{
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($contact_id);

		$contact = $this->Contact->read(null,$contact_id);
		$contact_type_id = $contact['Contact']['contact_type_id'];

		$plugins = $this->Field->getPluginTypes($contact_type_id,null,array(
			'Field.is_descriptive'=>1
		));

		$contact_types = $this->Contact->ContactType->find('list');

		$descriptive_fields = "";
		foreach ($plugins as $field) {
			$descriptive_fields .= $field['Field']['name']. " ";
		}

		$name = $this->getTitle($contact_id,$plugins);

		if( $this->data){
			$affiliation_id = substr($this->data['Affiliate']['affiliation_id'],1);

			switch (substr($this->data['Affiliate']['affiliation_id'],0,1)) {
				case 'f':
					$this->Contact->log_message ='Contact '.$this->data['Affiliate']['contact_id'] .' and '.$this->data['Affiliate']['current_contact_id']. ' are now affiliated';

					$affiliation = array(
							'contact_father_id'=>$this->data['Affiliate']['current_contact_id'],
							'contact_child_id' => $this->data['Affiliate']['contact_id'],
							'affiliation_id'=>$affiliation_id
					);

					break;

				case 's':
					$affiliation = array(
							'contact_father_id'=>$this->data['Affiliate']['contact_id'],
							'contact_child_id' => $this->data['Affiliate']['current_contact_id'],
							'affiliation_id'=>$affiliation_id
					);

					break;
			}
			if($affiliation){
				$this->Contact->saveAfilliation($affiliation);
			}
		}// used to affiliate

		$this->set('affiliations',$this->Affiliation->getList($contact_type_id));
		$this->set("contact", $this->affiliationContacts($contact_id,$plugins));
		$this->set(compact("contact_types",'descriptive_fields','name','contact_id'));

	}


	public function history($contact_id)
	{
		$this->redirect_if_not_ajax_request();
		$this->redirect_if_id_is_empty($contact_id);
		$contact = $this->Contact->getContactLogs($contact_id);
		$this->set(compact('contact'));
	}

    public function delete_record($id=null){
		//$this->redirect_if_not_ajax_request();
		//$this->redirect_if_id_is_empty($id);
		$this->set('status',true);
		$log = array();
		if (!empty($this->data)){

			$this->Log->save(array(
				'log_dt' 		=> date(AppModel::SQL_DTF),
				'contact_id' => $this->data['ContactDelete']['contact_id']
			));
			$trash_id = $this->Log->id;
			$contact = $this->Contact->read(null,$this->data['ContactDelete']['contact_id']);
			$contact['Contact']['trash_id']= $trash_id;

			$this->Contact->counter_cache($contact['Contact']['contact_type_id'],-1);


			/**
			 * this is done here because of afterSave call back is
			 * used for record updating. So after saving a contact
			 * generates a empty description and trash id
			 * this is a work around for this problem
			 */
			$contact_log = $this->Contact->getCSVContact($contact);
			$this->Contact->log_message =  $this->data['ContactDelete']['description'];
			$this->Contact->user_id  = $this->Auth->user('id');
			$this->Contact->cdata = $contact_log;
			$this->Contact->save($contact);

			$this->redirect(array('controller'=>'users','action'=>'home'));
		}
		$this->set('id',$id);
    }






	public function advance_search()
	{

		$contact_type_id = $this->Session->read('Contact.contact_type_id');

		$this->User->id = $this->Auth->user('id');

		$hidden_fields = $this->User->getHiddenFieldsByContactType($contact_type_id);

		$fields   = $this->Field->getPluginTypes($contact_type_id,$hidden_fields);

		# query optimization
		$hidden_fields_list = !empty($hidden_fields) ? $this->Field->getList($hidden_fields): array();

		$this->set('fields',$fields);

		$affiliations = ClassRegistry::init('Affiliation')->getList($contact_type_id);

		$this->set('affiliations',$affiliations);

		$this->set('hidden_fields',$hidden_fields_list);

		$advance_search_form = "";

		foreach ($fields as $field) {
			$className = $field['Field']['field_type_class_name'];
			$advance_search_form .= ClassRegistry::init($className)->advanceSearchFormField($field);
		}

        $this->set('filters', $this->Filter->getList($contact_type_id));
		$this->set('advance_search_form',$advance_search_form);
		$this->set('status',true);
	}


	public function plugin_options()
	{
		$params = $this->params['named'];
		if(isset($params['contact_type_id']) && isset($params['field_id'])){

			$className = $this->getFieldClassType($params['field_id']);
			$optionsName = $className.'Option';
			$output = ClassRegistry::init($optionsName)->displayOptions($params);
			$this->set('output',$output);
		}
    }

    public function contact_picker()
    {
      	$this->layout=null;
		#$this->disableDebugger();

		if($this->RequestHandler->isAjax() || !empty($this->params['url']['term'])){
			$affiliation_id = (int) substr($this->params['url']['affiliation_id'],1);
			$affiliation_type = substr($this->params['url']['affiliation_id'],0,1);
			$affiliation = $this->Affiliation->read(null,$affiliation_id);

			$contact_type_id = $affiliation['Affiliation']['contact_type_father_id'];

			if($affiliation_type=='f'){
				$contact_type_id = $affiliation['Affiliation']['contact_type_child_id'];
			}

			$plugin_classes = $this->ContactType->Field->getDescriptivePluginNames($contact_type_id);
			$search_term = $this->params['url']['term'];

            $result = ClassRegistry::init('TypeString')->search(array(
				'term'=>$search_term,
				'fields'=>$plugin_classes['TypeString']['field_ids']
			)) ;


			$p = array();
			$i=0;
			foreach ($result as $data) {
				$p[$i]['label']=$data['TypeString']['contact_id'].": ".$data[0]['data'];
				$p[$i]['id']=$data['TypeString']['contact_id'];
				$i++;
			}


			$this->set('hello',$p);

		}else{
			$this->redirect('/');
		}
    }


    public function interact(){
    	if($this->RequestHandler->isPost()){
    		$field_id = $this->data['Contact']['field_id'];
    		$this->Session->write("Contact.encrytor_key.{$field_id}.key",$this->data['Contact']['key']);
    	}
    	$this->set("status",true);
    }








 	protected function getTitle($id,$plugins,$function_name="")
	{
		$output= "";
		foreach($plugins as $field){
			//TODO refactoring is needed here
			// this can be put into the plugin model
			$pluginName 	= $field['Field']['field_type_class_name'];
			$field_name		= $field['Field']['name'];
			$field_id 		= $field['Field']['id'];
			$contact_field 	= ClassRegistry::init($pluginName)->getJoinContact();
			$join_field		= ClassRegistry::init($pluginName)->getJoinField();
			$useTable		= ClassRegistry::init($pluginName)->useTable;


			if($useTable){ //Workaround from Jonathan Bigler - Nov 2011, for plugins not using tables
				$value = ClassRegistry::init($pluginName)->find('first',array(
					//'contain'=>array('Field'),
					'conditions'=>array(
					$pluginName.'.'.$contact_field .' = '.$id,
					$pluginName.'.'.$join_field .' = '.$field_id
					)
				));
			}

			if(empty($value)){
				ClassRegistry::init($pluginName)->save(
					array(
						$contact_field => $id,
						$join_field => $field_id
					)
				);
			}
			//META-programming like RUBY
			//dynamic function name
			if(!empty($function_name)){
				$output.= ClassRegistry::init($pluginName)->{$function_name}($field_name,$value);
			}else{
				$output.= $value[$pluginName][ClassRegistry::init($pluginName)->getDisplayFieldName()] . " ";
			}
		}
		return $output;
	}



	protected function affiliationContacts($contact_id,$p){

		$contact= $this->Contact->getContactAffiliations($contact_id);
		$affiliations = array();

		foreach ($contact as $data) {
			$c = $this->Contact->read(null,$data['affiliated_contact_id']);
			$plugins = $this->Field->getPluginTypes($c['Contact']['contact_type_id'],null,array(
				'Field.is_descriptive'=>1
			));

			$data['affiliated_to'] = $this->getTitle($data['affiliated_contact_id'],$plugins);
			$affiliations[] = $data;
		}

		return $affiliations;
	}
}
