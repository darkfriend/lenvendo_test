<?php

/**
 * Description of controller_ajax
 *
 * @author Виктор
 */
class controller_ajax extends controller {
    public $paramControllerLength = 0; //возможное кол-во принимаемых параметров (GET)
    private $flag = array(
                1=>'GIF',
                2=>'JPG',
                3=>'PNG',
            ),
            $typeImg,
            $parentImgID;
    public $newImg;


    public function __construct() {
        parent::__construct();
        $this->initModule('ajax');
    }
    
    public function action_index(){
        
        #запускаю модель
        //$arData['name_img'] = $this->getModel()->start_module();
        $arData['REQUEST'] = $this->getModel()->start_module();
        var_dump($arData);
        exit;
        //if($arData['REQUEST']['name_img'])
        list($width,$height,$type)= getimagesize($arData['name_img']);
        if( in_array( $type, array(1,2,3)) ){
            $this->typeImg = $this->flag[$type];
        } else {
            $this->params = 'Ошибка! Изображение не создано!';
        }
        
    }
    
    private function startRender(){
        $params = $this->params;
        $name = $params['name'];
        //echo $name;
        $this->view->render('ajax/ajax_view.php', 'ajax/ajax_temp.php' , $name);
    }


    private function getFileNewFile(){
        
        $name = md5($this->dataRequest.time());
        $file = "/$name.png";
        $this->saveRequestFile($file);
        if (!file_exists($file)){
            
        } else {
            
        }
    }
    
    #сохраняет нарисованную картинку
    private function saveRequestFile($data){
        $image = str_replace(" ", "+", $data);
        $image = substr($image, strpos($image, ","));
        //$dirDateMonth = date('m.Y');
        $path_file = PATH_TO_SAVE_IMG.'/'.date('m.Y').$data;
        file_put_contents($path_file, base64_decode($image));
        return $path_file;
    }
    
    //возвращаю родительскую картинку
    private function getParentFile(){
        $this->parentImgID = filter_input(INPUT_POST, 'imgid', FILTER_SANITIZE_NUMBER_INT);
        if($this->parentImgID){
            $this->mergePictures($this->parentImgID);
        }
        
    }
    
    private function mergePictures($pict1, $pict2){
        if($pict1['typeImg']!==$pict2['typeImg']) return false;
        switch($pict1['typeImg']){
            case 'jpg' :
                $src1 = imagecreatefromjpeg($pict1['path']);
                $src2 = imagecreatefromjpeg($pict2['path']);
                break;
            case 'png' :
                $src1 = imagecreatefrompng($pict1['path']);
                $src2 = imagecreatefrompng($pict2['path']);
                break;
        }
        if(!$src1 || !$src2) return false;
        if(imagecopy($src1, $src2)){
            return $pict1['path'];
        } else {
            return false;
        }
    }
    
    public function action_auth() {
        echo 'action_auth';
    }
    
    public function action_mergeimg() {
        echo 'action_mergeimg';
    }
    
//    public function action_ajax(){
//        include 'ajax/';
//    }
}
