<?php

class Application_Model_DbTable_users extends Zend_Db_Table_Abstract
{
    protected $_name = 'Zend_form_users';
    
    public function getAll(){
        return $this->fetchAll()->toArray();
    }
    
    /**
     *Funkcja do zapisywania użytkownika
     *@param array $data info uzytkownika
     *@author Szymon O
    */
    public function save($data){
        $result = false;
        if (empty($data)) return $result;
        
        $result = $this->insert($data);
        return $result;
    }
    
    public function check_if_exists ($what, $name){
        $result= false;
        $where = trim($what).' = "'.trim($name).'"';
        if($this->fetchRow($where) <> null) $result = true;
        
        return $result;
    }
}
