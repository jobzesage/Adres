<?php 
require (LIBS . 'model' . DS . 'datasources' . DS . 'dbo' . DS . 'dbo_mysql.php');

class DboMysqlEx extends DboMysql {

    var $description = "MySQL DBO Extension Driver";

    function read(&$model, $queryData = array(), $recursive = null)
    {
        // only handle queries for the SQL
        if ( empty($queryData['returnSQL']) ){
            return parent::read($model, $queryData, $recursive);
        }

        // the following is just copied from the /cake/libs/model/datasources/dbo_source.php read function
        $queryData = $this->__scrubQueryData($queryData);
        $null = null;
        $array = array();
        $linkedModels = array();
        $this->__bypass = false;
        $this->__booleans = array();

        if ($recursive === null && isset($queryData['recursive'])) {
            $recursive = $queryData['recursive'];
        }

        if (!is_null($recursive)) {
            $_recursive = $model->recursive;
            $model->recursive = $recursive;
        }

        if (!empty($queryData['fields'])) {
            $this->__bypass = true;
            $queryData['fields'] = $this->fields($model, null, $queryData['fields']);
        } else {
            $queryData['fields'] = $this->fields($model);
        }

        foreach ($model->__associations as $type) {
            foreach ($model->{$type} as $assoc => $assocData) {
                if ($model->recursive > -1) {
                    $linkModel =& $model->{$assoc};
                    $external = isset($assocData['external']);

                    if ($model->useDbConfig == $linkModel->useDbConfig) {
                        if (true === $this->generateAssociationQuery($model, $linkModel, $type, $assoc, $assocData, $queryData, $external, $null)) {
                            $linkedModels[] = $type . '/' . $assoc;
                        }
                    }
                }
            }
        }

        $query = $this->generateAssociationQuery($model, $null, null, null, null, $queryData, false, $null);

        // restore the recursive level
        if (!is_null($recursive)) {
            $model->recursive = $_recursive;
        }

        // but return this query instead of fetching it
        return $query;
    }
}