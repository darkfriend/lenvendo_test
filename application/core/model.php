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
    
    /*public function getRequestQuery($val=null, $method='POST'){
        if($_SERVER['REQUEST_METHOD']==$method){
            return $this->clearanceValues($_POST[$val]);
        }
    }

    public function clearanceValues($array){
        //if($_SERVER['REQUEST_METHOD']=='POST'){
            foreach ($array as $key=>$value){
                if(is_array($value)){
                    #делаю рекурсию
                    $newArray[$key][] = $this->getAllPost( $value );
                } else {
                    $newArray[$key] = $this->clearSpecSym( $value );
                }
            }
            return $newArray;
        //}
    }
    
    private function clearSpecSym($data){
        if (get_magic_quotes_gpc()) $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
        return $data;
    }*/
    
    
}