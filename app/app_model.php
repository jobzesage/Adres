<?php

class AppModel extends Model {

	/**
	 * sql date format 
	 */
	const SQL_DTF = 'Y-m-d H:i:s';
	
	const CONTACT_SAVED = "Contact saved";
	
	public $recursive = -1;
	
	public $useDbConfig='development';
	
	public $page_size = 20;
	


	/**
	 * Removes All associations
	 *
	 * @return void
	 * @author CraZyLegs
	 */
    public function unbindModelAll() {
        foreach(array(
                'hasOne' => array_keys($this->hasOne),
                'hasMany' => array_keys($this->hasMany),
                'belongsTo' => array_keys($this->belongsTo),
                'hasAndBelongsToMany' => array_keys($this->hasAndBelongsToMany)
        ) as $relation => $model) {
                $this->unbindModel(array($relation => $model));
        }
	} 
	
}
?>
