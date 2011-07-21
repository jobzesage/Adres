<?php

App::import('Helper', 'Helper', false);

class AppHelper extends Helper {

    public function getPluginName($className){
    	return 'Type'.ucwords($className);
    }


    public function generateDataGrid($columns,$contacts)
    {
    	$output = "<table class='adres-datagrid' border='0'>\n ";
    	$output .= "\t<th>ID</th>\n";
    	foreach ($columns as $column) {
			$output.= "\t<th>".$column['Field']['name']."</th>\n";
    	}

    	foreach ($contacts as $contact) {
    		$output.= "\t<tr>\n";
			foreach ($contact as $key => $data) {
				$d = array_values($data);
				$output.= "\t\t<td>".$d[0]."</td>\n";
			}
    		$output.= "\t</tr>\n";
    	}
    	$output .= "</table>\n ";
    	return $output;
    }


	public function generateGroupList($groups){
		$list = array();
		foreach ($groups as $group) {
			$list[$group['Group']['id']]=$group['Group']['name'];
		}
		return $list;
	}


    /* This function should add css class to stortable column
     *
     */
    public function addSortingClassToColumn(){
        // code...
    }
}

