<?if(!defined("START") || START!==true)die();?>
<?php
/**
 * Ядро для всех моделей
 *
 * @author darkfriend
 */
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
}