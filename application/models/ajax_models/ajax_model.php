<?if(!defined("START") || START!==true)die();?>
<?php
/**
 * Модель для ajax-контроллера.
 *
 * @author darkfriend
 */
class ajax_model extends model {
    
    private $dataRequest,
            $editFile;
    
    public function start_module(){
        $this->getRequest();
        userExeption::startException(true, 'setErrorException');
        if($this->dataRequest['edit_file']){
            $this->getEditFile($this->dataRequest['edit_file'], controller::getUser());
        }
        return $this->dataRequest;
    }
    
    private function getRequest(){
        $this->dataRequest = $this->getRequestQuery(null, 'POST');
    }
    
    private function getEditFile($idFile, $userID){
        //отправляю запрос на поиск картинки у данного юзера
        $result = $this->db->getRow( 'SELECT * FROM user_pictures WHERE ?a', array( 'ID'=>$idFile, 'id_user'=>$userID) );
        
        var_dump($result);
    }
}
