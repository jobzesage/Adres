<?php
App::import('Model','Plugin');

class TypeEmail extends Plugin{
    public $useTable = 'type_email';
    public $actsAs = array('Containable');

    public $_adresValidate=array(
        'email'=>array(
            'rule'=>'regex',
            'message'=>'Email is not validate',
            'pattern'=>'/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/'
        ),
        'emailNotEmpty'=>array(
            'rule'=>'notEmpty',
            'message'=>'Email can not be blank'
        )
    );

	public function renderEditForm($contact_id,$plugin,$wrapper=array()){

        $wrapper = am($wrapper, array('tag'=>'div'));
		$data = $this->find('first',array('conditions'=>array(
				'contact_id' 	=> $contact_id,
				'field_id'		=>$plugin['Field']['id']
			)));

		$data 	= $data[$this->name][$this->getDisplayFieldName()];

		$label 	= '<'.$wrapper['tag'].' class="input text">';
		$label .='<label for="'.$plugin['Field']['name'].'">'.$plugin['Field']['name'];

		$label .= (int)$plugin['Field']['required'] ? " * " : "" ;
		$label .= '</label>';

		$output  = '<input ';

		$output .= (int)$plugin['Field']['required'] ? " class ='required text ui-corner-all' " : " class='text ui-corner-all'" ; # for jquery validtion
		$output .= 'name="data['.$this->getJoinField().']['.$plugin['Field']['id'].']"';
		$output .= ' value="'.$data.'"';
		$output .='/>';
		$output .='</'.$wrapper['tag'].'>';

		return $label.$output;
	}
}
?>
