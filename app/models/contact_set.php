<?php  

class ContactSet extends AppModel
{
	public $useTable =false;
	
    public $records = null;

    protected $_defaults = array(
 			'searchKeyword'=>null,
			'plugins'=>null,
			'page'=>1,	
			'sort'=>'id',
			'order'=>'asc',
			'paging'=>true,
			'include_trash'=>false
    );


	
	/**
	 * Generates the datagrid
	 *	
	 * @return array recordset of one contactype
	 * @author rajib ahmed
	 **/
	public function getContactSet($contact_type_id,$options=array())
	{
		$options = am($this->_defaults,$options);
		
		$ctype = ClassRegistry::init('ContactType')->read(null,$contact_type_id);
		
		$sql = $this->build_query($contact_type_id,$options);
        
        
		$contacts['data'] = $this->query($sql);
		
		//Counter Cache implementation
		if(empty($options['filters']) && empty($options['searchKeyword']))
		{
			$contacts['count'] = $ctype['ContactType']['contact_counter'];
		}
		else{
			$patterns[0] = "/DISTINCT\s/";
			$matches[0] = "COUNT";
			$patterns[1]="/order.+$/" ;
			$matches[1] = "";
			$sql = preg_replace($patterns,$matches,$sql);
			$data = $this->query($sql);
			$contacts['count']=$data[0][0]['id'];
		}
		
		
		$contacts = $this->after($contacts);
		
		return $contacts;
	}
	
	
	/**
	 * This function is a after filter it will apply after function on each plugin type
	 * ie. if a Column type is column TypeString_# it will call TypeString->after() with the 
	 * data
	 * @return mixed the string/integer/date value only formatted one
	 * @author Rajib
	 **/
	private function after(Array $results){
		$formatterData=array();
		foreach ($results['data'] as $data) {
			$keys = array_keys($data);
			foreach ($keys as $key) {
				$pluginType = preg_split('/_/',$key);
				if(preg_match('/Type\w/',$pluginType[0])){
					$pluginName = $pluginType[0];
					$column_info=array(
						'plugin' => $pluginType[0],
						'data'=>$data[$key],
						'key'=>$key,
						'field_id'=>$pluginType[1],
						'contact_type_id'=>$_SESSION['Contact']['contact_type_id'] 	
					);					
					$data[$key] = ClassRegistry::init($pluginName)->after($column_info);
				}
			}
			$formatterData[]=$data;
		}
		$results['data'] = $formatterData;
		return $results;
	}


	private function build_query($contact_type_id,$options)
	{
		/**
		* this one is important
		*/
		extract($options); # generates variables like $searchKeyword , $plugins, $filter,$page ,$sort , $order
			
			
			
		$select = 'SELECT DISTINCT (Contact.id) AS id ';
		
		$from = ' FROM contacts AS Contact 
			LEFT JOIN contacts_groups AS ContactGroup 
			ON Contact.id = ContactGroup.contact_id '; 
		
		$where =' WHERE Contact.contact_type_id = '.$contact_type_id .' ';
		
		if(is_array($contact_type_id)){
			$ids = implode(',',$contact_type_id);
			$where =' WHERE Contact.contact_type_id IN ('.$ids.') ';
		}
		
		
		if(!$include_trash){
			$trash = " AND Contact.trash_id=0  "; #gets all the active contacts 
		}else{
			$trash = " AND Contact.trash_id !=0  "; #get all the trashed contacts
		}
		
		//include trash will toggle between trashed contact and active contacts
		$where .=$trash;
		
			
		
		
		$keyword = "";		
		
		if(empty($plugins)){
			return "SELECT (Contact.id) AS id  FROM contacts as Contact
			LEFT JOIN contacts_groups as ContactGroup 
			ON (Contact.id = ContactGroup.contact_id )
			WHERE Contact.contact_type_id = ".$contact_type_id ." ".$filters;		
		}
			

		
		$models =array();
		foreach ($plugins as $field) {
			$models[]=$field['Field']['field_type_class_name'];
		}

		$this->bindModel(array('belongsTo'=>$models));
		
		//Custom fields
		$i=0;
		$orders['id'] = 'id';
		foreach($plugins as $field){
			
			$pluginName = $field['Field']['field_type_class_name'];
			
			$plugin = $this->$pluginName;
			
			$metaOptions = array(
				'custom_table' => $plugin->name.'_'.$field['Field']['id'],
				'field_id' =>$field['Field']['id']	
			);
			
			$select .= ' , '.$plugin->getDisplayFieldName($metaOptions) ;
			
			
			$select .= '  AS "'.$field['Field']['name'].'"';
			
			$from.= ' LEFT JOIN '.$plugin->useTable .' AS ';
			$from.= $plugin->name.'_'.$field['Field']['id'];
			
			#change it to a func
			$from.= ' ON (Contact.id ='.$plugin->name.'_'.$field['Field']['id'].'.contact_id';
			#change it to a func
			$from.= ' AND '.$plugin->name.'_'.$field['Field']['id'].'.field_id = '.$field['Field']['id'] .' )';
			
			//Adds up to the from clause as extension
			$from.= $plugin->joinExt($metaOptions);
			
			
			//stores the Types undersore name and data column to the field name association
			//ie $order['name'] = 'TypeString_4.data'
			$orders[$field['Field']['name']] = $pluginName.'_'.$field['Field']['id'].'.'. $plugin->getDisplayFieldName(); 
			
			if($searchKeyword!=null){
				#change it to session keyword
				if($i != 0)	$keyword = $keyword." OR ";
				$keyword = $keyword.$pluginName.'_'.$field['Field']['id'].'.'.$plugin->getDisplayFieldName();
				//$pluginName.'_'.$field['Field']['id'].'.'. $plugin->getDisplayFieldName();
				$keyword = $keyword." LIKE \"%".$searchKeyword."%\" ";
			}
			
			$i++;
		}
		
		//For adding search by global contact ID
		if (!empty($searchKeyword) && is_numeric($searchKeyword)) {
			$contact_id = (int) $searchKeyword;
			//Had clear number search on data column
			// Because with OR sections contact id search does not work
			if($contact_id > 0)	{
				$keyword =" Contact.id=".$contact_id;
			}
		}		
		
		$where = $where.$filters;
		
		//Add keyword search to where clause
		if($keyword != "")	$where = $where." AND ( ".$keyword." ) ";


		
			
		//Adds extention to the where clause from plugin
		$where.=$plugin->whereExt();	
		
		//sorting options
		$ordering = " ";
		$ordering  = " order by ".$orders[$sort]." ".$order;
		
		//paging options 
		$limit = " ";
		if($paging){
			$limit  = '  limit ' .($page - 1) * $this->page_size	.',' . $this->page_size; 		
		}
		
		
		//Build the SQL query that can display the contacts
		$sql = $select.$from.$where.$ordering.$limit;
		
		return $sql;
    }


    public function getContactIds($contact_type_id, Array $options =array()){
        $options = am($this->_defaults,$options);
	    $options['paging'] = 0;	
		$sql = $this->build_query($contact_type_id,$options);
        $contacts = $this->query($sql);
        $ids =array();
        $i = 0;

        foreach ($contacts as $contact){
            $ids[$i]['contact_id'] = $contact['Contact']['id'];
            $ids[$i]['group_id']   = $options['group_id'];
            $i++;
        }
        return $ids;
    }  


    public function beforeSQLExecute($sql)
    {
        return $sql;
    }  

		
	
	public function getByIdAndType($contact_id,$contact_type_id,$plugins){
		return $this->getContactSet($contact_type_id, array('searchKeyword'=>(int) $contact_id, 'filters'=>null,'plugins'=>$plugins, 'affiliation'=>null ));
	}
}