<?php
class Affiliation extends AppModel {

    public $name = 'Affiliation';

    public $actsAs = array('Containable');

    public $belongsTo = array(
        'FatherContactType' => array(
            'className' => 'ContactType',
            'foreignKey' => 'contact_type_father_id'
        ),
        'ChildContactType'=>array(
            'className' =>'ContactType',
            'foreignKey' => 'contact_type_child_id'
        )
    );

    public $hasMany = array(
        'Contact' => array(
            'className' => 'Contact',
            'foreignKey' => 'affiliation_id'
        )
    );


    public function getList($contactTypeId){
        $fathers = $this->find('all',array(
            'conditions' => array(
                'Affiliation.contact_type_father_id'=>$contactTypeId
            ),
            'fields'=>array('Affiliation.id','Affiliation.father_name')
        ));

        $childs = $this->find('all',array(
            'conditions' => array(
                'Affiliation.contact_type_child_id'=>$contactTypeId
            ),
            'fields'=>array('Affiliation.id','Affiliation.child_name')
        ));

        $list1 = array();
        $list2 = array();

        foreach ($fathers as $father) {
            $list1[] = array('value'=>'f'.$father['Affiliation']['id'], 'option'=>$father['Affiliation']['father_name']);
            #$list1['f'.$father['Affiliation']['id']] = $father['Affiliation']['father_name'];
        }

        $empty_select = array("Select one ..");
        foreach ($childs as $child) {
            $list2[] = array('value'=>'s'.$child['Affiliation']['id'], 'option'=>$child['Affiliation']['child_name']);
            #$list2['s'.$child['Affiliation']['id']] = $child['Affiliation']['child_name'];
        }

        return am($list1,$list2);
	}


    public function getRelationship($affiliation){
        switch($affiliation['type']){
        case 'f':
            $relation = array(
                'contact_father_id' => $affiliation['current_contact_id'],
                'contact_child_id'  => $affiliation['contact_id'],
                'affiliation_id'    => $affiliation['id']
            );
            break;
        case 's':
            $relation = array(
                'contact_father_id' => $affiliation['contact_id'],
                'contact_child_id'  => $affiliation['current_contact_id'],
                'affiliation_id'    => $affiliation['id']
            );
            break;
        }

        return $relation;
    }
}
