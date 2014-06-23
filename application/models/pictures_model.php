<?php

class pictures_model extends model{
    public function start_module() {
        
    }
    public function set_data($data) {
        if(!$data['user_id'] || !$data['picture_name']) return false;
        $data['picture_name'] = $data['picture_name'][0]=='/' ? substr($data['picture_name'], 1) : $data['picture_name'];
        $result = $this->db->query("INSERT INTO user_pictures (id_user,name_file,last_edit,create_date) VALUES ( ?i, ?s, ?s, ?s )", $data['user_id'], $data['picture_name'], date('d.m.Y H:i:s'), date('m.Y'));
        return $result;
    }
}
