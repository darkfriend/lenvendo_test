<?php
class model{
    
    protected $db,
            $data;


    public function __construct() {
        include 'safemysql_class.php';
        $this->db = new SafeMySQL(array(
            'user'    => DB_USER,
            'pass'    => DB_USER_PASSWORD,
            'db'      => DB_NAME
        ));
    }

    public function get_data(){
        
    }
    
    public function set_data(){
        
    }
    
    protected function queryRender($arrayQuery){
        $query = array();
        foreach ($arrayQuery as $key => $value){
            if(is_array($value)){
                $query[] = $this->queryRender($value);
            } else {
                $query = $value;
            }
        }
        return $query;
    }
}