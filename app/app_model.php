<?php

class AppModel extends Model {
	
	/**
	 * contact save text for description field
	 */
	const CONTACT_SAVE = "Created";
	
	
	/**
	 * sql date format 
	 */
	const SQL_DTF = 'Y-m-d H:i:s';
	
	public $recursive = -1;
	
	public $useDbConfig='development';

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
