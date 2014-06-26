<?php

class pictures_model extends model{
    public function start_module() {
        
    }
    
    public function set_data($data) {
        if(!$data['user_id'] || !$data['picture_name']) return false;
        $data['picture_name'] = $data['picture_name'][0]=='/' ? substr($data['picture_name'], 1) : $data['picture_name'];
        //$DB_responce = array();
        $result = $this->db->query("INSERT INTO user_pictures (id_user,name_file,last_edit,create_date) VALUES ( ?i, ?s, ?s, ?s )", $data['user_id'], $data['picture_name'], date('Y-m-d H:i:s'), date('m.Y'));
        return $result;
    }
    
    public function check_permisssion_edit($param) {
        return $this->db->getRow('SELECT * FROM user_pictures WHERE ID=?i AND id_user=?i', $param['id_img'], $param['user_id']);
        //return $this->db->getOne('SELECT ID FROM user_pictures WHERE ID=?i AND id_user=?i', $param['id_img'], $param['user_id']);
    }
    
    public function get_data($isParams=false, $param=null) {
        if($isParams){
            return $this->db->getAll('SELECT * FROM user_pictures WHERE ?u', $param);
        } else {
           return $this->db->getAll('SELECT * FROM user_pictures'); 
        }
    }
    
    public function update_data($id, $nameFile) {
        if(!$id || !$nameFile) return false;
        $dateToday = array( 
            'last_edit' => date('Y-m-d H:i:s'),
            'name_file' => $nameFile
        );
        if(!USER_IMAGE_EDIT_MARGE){ //если не мержить
            $dateToday['create_date'] = date('m.Y');
        }
        $result = $this->db->query("UPDATE user_pictures SET ?u WHERE ID=?i", $dateToday, $id);
        return $result;
    }
    
    public function delete_data($id) {
        $result = $this->db->query("DELETE FROM user_pictures WHERE ID=?i", $id);
        return $result;
    }
}
