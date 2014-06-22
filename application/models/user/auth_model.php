<?php
/**
 * Description of auth_model
 *
 * @author dark
 */
class auth_model extends model{
    
    //проверка введённых данных
    public function checkAuthData($login, $pass){
        if( !$login || !$pass ) return false;
        return $this->get_data($login, $pass);
    }
    public function get_data($login, $pass){
        $result = $this->db->getOne('SELECT ID FROM users WHERE login=?s AND pass=?s', $login, $pass);
        //var_dump('$result='.$result);
        if($result){
            return array('check_auth'=>true,'msg'=>'Пользователь с такими данными не найден!','id_user'=>$result);
        } else {
            return array('check_auth'=>false,'msg'=>'Пользователь с такими данными не найден!');
        }
    }
}
