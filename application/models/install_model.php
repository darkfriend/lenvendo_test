<?php
/**
 * Description of install_models
 *
 * @author dark
 */
class install_model extends model{
    
    //private $db;
    
//    public function __construct(){
//        $this->table_check();
//        //$this->inslallTable();
//    }
//    
//    static function set_data() {
//        $this->db->query('');
//        //parent::set_data();
//    }
    
    public function __construct() {
        parent::__construct();
        $this->start_module();
    }
    
    public function start_module() {
        $this->table_check();
    }
    
    #проверка целостности таблиц БД
    private function table_check(){
        //$this->db->query()
        var_dump('result_tables');
        //var_dump(DB_NAME);
        //$dbName = DB_NAME;
        $result_tables = $this->db->getAll('SHOW TABLES FROM ?n', DB_NAME);
        $result_tables=$this->queryRender($result_tables);
        var_dump($result_tables);
       
    }

    private function createDBTable_users(){
        $result_create = $this->db->query('
            CREATE TABLE IF NOT EXISTS users (
                ID int(11) NOT NULL AUTO_INCREMENT,
                login int(11) NOT NULL,
                pass varchar(36) NOT NULL,
                data_auth date NOT NULL,
                privilege_id int(11) NOT NULL,
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
        ');
        return $result_create;
    }
    
    private function createDBTable_user_pictures(){
        $result_create = $this->db->query('
            CREATE TABLE IF NOT EXISTS user_pictures (
                ID int(11) NOT NULL AUTO_INCREMENT,
                id_user int(11) NOT NULL,
                name_file varchar(255) NOT NULL,
                last_edit date NOT NULL,
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
        ');
        return $result_create;
    }
    
    private function createDBTable_user_privileges(){
        $result_create = $this->db->query('
            CREATE TABLE IF NOT EXISTS user_privileges (
                ID int(11) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
        ');
        return $result_create;
    }

    private function inslallTable(){
        
    }
}
