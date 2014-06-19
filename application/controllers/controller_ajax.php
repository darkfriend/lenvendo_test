<?php

/**
 * Description of controller_ajax
 *
 * @author Виктор
 */
class controller_ajax extends controller {
    public $paramControllerLength = 1; //возможное кол-во принимаемых параметров (GET)
    private $flag = array(
                1=>'GIF',
                2=>'JPG',
                3=>'PNG',
            ),
            $typeImg;
    
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
        }
        
    }
    
    private function startRender(){
        $params = $this->params;
        $name = $params['name'];
        //echo $name;
        $this->view->render('ajax/ajax_view.php', 'ajax/ajax_temp.php' , $name);
    }


    private function getFile(){
        
        $name = md5($this->dataRequest);
        $file = "/$name.png";
        if (!file_exists($file)){
            
        } else {
            
        }
    }

    private function saveFile($data){
        $image = str_replace(" ", "+", $data);
        $image = substr($image, strpos($image, ","));
        file_put_contents(PATH_TO_SAVE_IMG.$file, base64_decode($image));
        $parentImgID = filter_input(INPUT_POST, 'imgid', FILTER_SANITIZE_NUMBER_INT);
    }
    
//    public function action_ajax(){
//        include 'ajax/';
//    }
}
