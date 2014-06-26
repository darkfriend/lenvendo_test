<?if(!defined("START") || START!==true)die();?>
<?php
/**
 * Модель для install-контроллера.
 * Используется при установке
 * 
 * @author darkfriend
 */
class install_model extends model{
    
    private $_tableName = array( 'users', 'user_pictures', 'user_privileges' ), // список проверяемых таблиц
            $_errorTable = false,
            $_nameCreateTables = array(),
            $_statusMsg = array();
    
    public function start_module() {
        userExeption::startException(true, 'setErrorException');
        if ($this->table_check()){
            for($i=0, $cnt=count($this->_nameCreateTables); $i<$cnt; $i++){
                $func = 'createDBTable_'.$this->_nameCreateTables[$i];
                if($this->$func()){
                    $this->_statusMsg[]='Создана таблица '.$this->_nameCreateTables[$i];
                } else {
                    throw new Exception('Не получилось создать таблицу: '.$this->_nameCreateTables[$i]);
                }
            }
            return array('status'=>true, 'msg'=>$this->_statusMsg);
        } else {
            return array('status'=>false, 'msg'=>'База в порядке');
        }
    }
    
    #проверка целостности таблиц БД
    private function table_check(){
        $result_tables = $this->db->getAll('SHOW TABLES FROM ?n', DB_NAME);
        $result_tables = $this->queryRender($result_tables);
        
        #var_dump($this->_tableName==$result_tables); //почему-то не правильно сравнивает
        for($i=0, $cnt=count($this->_tableName); $i<$cnt; $i++){
            if( !(in_array( $this->_tableName[$i], $result_tables )) ){
                $this->_errorTable = true;
                $this->_nameCreateTables[] = $this->_tableName[$i];
            }
        }
        if( !$this->_errorTable ){
            return false;
        }
        
        return true;
       
    }

    private function createDBTable_users(){
        $result_create = $this->db->query('
            CREATE TABLE IF NOT EXISTS users (
                ID int(11) NOT NULL AUTO_INCREMENT,
                login varchar(255) NOT NULL,
                pass varchar(255) NOT NULL,
                data_auth date NOT NULL,
                privilege_id int(11) NOT NULL DEFAULT "2",
                PRIMARY KEY (ID)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
            INSERT INTO users (login, pass, data_auth, privilege_id) VALUES ("admin", "21232f297a57a5a743894a0e4a801fc3", "2014-06-22", 1);
        ');
        return $result_create;
    }
    
    private function createDBTable_user_pictures(){
        $result_create = $this->db->query('
            CREATE TABLE IF NOT EXISTS user_pictures (
                ID int(11) NOT NULL AUTO_INCREMENT,
                id_user int(11) NOT NULL,
                name_file varchar(255) NOT NULL,
                last_edit datetime NOT NULL,
                create_date varchar(100) NOT NULL,
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
            INSERT INTO user_privileges (ID, name) 
                                        VALUES ("admin"), ("user");
        ');
        return $result_create;
    }
}
