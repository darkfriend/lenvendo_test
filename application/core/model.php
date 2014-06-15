<?php
class model{
    
    protected $db,
            $data;


    private function __construct() {
        include './safemysql_class.php';
        $this->db = new SafeMySQL(array(
            'user'    => DB_USER,
            'pass'    => DB_USER_PASSWORD,
            'db'      => DB_NAME,
            'charset' => 'utf-8'
        ));
    }

        public function get_data(){
        
    }
}