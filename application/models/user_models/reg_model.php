<?php

/*class reg_model extends model{
    public function checkAuthData($login, $pass){
        if( !$login || !$pass ) return false;
        
    }
}*/
class reg_model extends model{
    
    //метод регистрации пользователя
    public function register_user($login, $pass){
        if( !$login || !$pass ) return false;
        if(!$this->check_login($login)){
            return $this->set_data($login, $pass);
        } else {
            return array('check_auth'=>false,'msg'=>'Пользователь с таким логиным уже зарегистрирован!');
        }
        
    }
    
    public function set_data($login, $pass){
        $result = $this->db->query("INSERT INTO users (login,pass,data_auth,privilege_id) VALUES ( ?s, ?s, ?s, ?i )", $login, $pass, date('d.m.Y H:i:s'), USER_GROUP_DEFAULT); //getOne('SELECT ID FROM users WHERE login=?s AND pass=?s', $login, $pass);
        var_dump('$result='.$result);
        if($result){
            return array('check_auth'=>true,'msg'=>'Пользователь с такими данными не найден!','id_user'=>$result);
        } else {
            return array('check_auth'=>false,'msg'=>'Пользователь с такими данными не найден!');
        }
    }
    
    protected function check_login($login){
        return $this->db->getOne('SELECT ID FROM users WHERE login=?s', $login);
    }
}
