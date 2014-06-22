<?php

class reg_model extends model{
    public function checkAuthData($login, $pass){
        if( !$login || !$pass ) return false;
        
    }
}
