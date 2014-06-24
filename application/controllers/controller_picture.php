<?php

class controller_picture extends controller {
    public $paramControllerLength = 1,
            $hashFile,
            $msg;
    
    private $flag = array( //поддерживаемые расширения
                1=>'GIF',
                2=>'JPG',
                3=>'PNG',
            );


    public function action_index(){
        
    }
    
    public function action_add($json=false){
        //var_dump($this->getRequestQuery('data'));
        if($this->isAuth()){
            if(!$this->getRequestQuery('data')){
                $this->msg = 'Хэш не найден';
            } elseif( $format = $this->getRequestQuery('format') ) {
                $name = md5($this->getRequestQuery('data').time());
                $file = "/$name.".$format;
                //var_dump($format);
                if (!file_exists($file)){
                    $pathToFile = $this->saveRequestFile($file , $this->getRequestQuery('data'));
                    if (file_exists($pathToFile)){
                        //инициализация модели картинок
                        $this->initModule('pictures');
                        if($resultInsert = $this->getModel()->set_data( array( 'picture_name'=>$file, 'user_id'=>$this->getUser() ) )){
                            $data = $file;
                            $this->msg = 'file created';
                        } else {
                            $this->msg = 'Ошибка добавления';
                        }
                        //echo 'file created';
                    } else {
                        $this->msg = 'file NOT created';
                        //echo 'file NOT created';
                    }
                } else {
                    $this->msg = 'file уже есть!';
                }
            } else {
                $this->msg = 'формат не найден';
            }
        } else {
            $this->msg  = 'Авторизуйтесь или зарегистрируйтесь!';
            $result_msg_html = '<a href="/user/auth/">Авторизуйтесь</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        if($json){
            //$mainBlock = '../picture/ajax_view.php';
            //$template = 'ajax/ajax_temp.php';
            return array( 'result' => $data, 'result_msg'=>$this->msg );
        } else {
            $mainBlock = 'picture/add_view.php';
            $template = EX_TEMPLATE;
            $data = array( 'result' => $data, 'result_msg'=>$this->msg, 'result_msg_html'=>$result_msg_html );
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
            
            $this->view->render( $mainBlock, $template, $data );
        }
    }
    
    public function action_edit($json=false){
        #Объявляю свой обработчик ошибок
        userExeption::startException();
        if( !$id_picture = $this->clearanceValues($this->params['id']) ){
            throw new Exception('no params in edit picture');
        }
        var_dump($this->params);
        if($this->isAuth()){
            //инициализация модели картинок
            $this->initModule('pictures');
            if( !$rowResult=$this->getModel()->check_permisssion_edit( array( 'id_img' => $id_picture, 'user_id' => $this->getUser() ) ) ){
                $this->msg = 'Вам нельзя редактировать данный файл!';
                $result = 'error';
            } elseif ( !$this->getRequestQuery('data') ){
                var_dump($rowResult);
                $this->msg = 'Хэш не найден';
            } elseif( $format = $this->getRequestQuery('format') ) {
                
                //$name = md5($this->getRequestQuery('data').time());
                //$file = "/$name.".$format;
                //var_dump($format);
                $pathFile = $this->mergePictures($pict1, $pict2, USER_IMAGE_EDIT_MARGE);
                if (!file_exists($file)){
                    //$pathToFile = $this->saveRequestFile( array($file , $this->getRequestQuery('data')) );
                    if (file_exists($pathToFile)){
                        
                        if($resultInsert = $this->getModel()->set_data( array( 'picture_name'=>$file, 'user_id'=>$this->getUser() ) )){
                            $data = $file;
                            $this->msg = 'file created';
                        } else {
                            $this->msg = 'Ошибка добавления';
                        }
                        //echo 'file created';
                    } else {
                        $this->msg = 'file NOT created';
                        //echo 'file NOT created';
                    }
                } else {
                    $this->msg = 'file уже есть!';
                }
            } else {
                $this->msg = 'формат не найден';
            }
        } else {
            $this->msg  = 'Авторизуйтесь или зарегистрируйтесь!';
            $result_msg_html = '<a href="/user/auth/">Авторизуйтесь</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        if($json){
            //$mainBlock = '../picture/ajax_view.php';
            //$template = 'ajax/ajax_temp.php';
            return array( 'result' => $data, 'result_msg'=>$this->msg );
        } else {
            $mainBlock = 'picture/add_view.php';
            $template = EX_TEMPLATE;
            $data = array( 'result' => $data, 'result_msg'=>$this->msg, 'result_msg_html'=>$result_msg_html );
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
           
            $this->view->render( 'picture/add_view.php', EX_TEMPLATE, $data );
            //$this->view->render( $mainBlock, $template, $data );
        }
        //$this->view->render( 'picture/add_view.php', EX_TEMPLATE, $data );
        
        /*if(!$this->getRequestQuery('data')){
            $this->msg = 'Хэш не найден';
        } elseif( $format = $this->getRequestQuery('format') ) {
            $name = md5($this->getRequestQuery('data').time());
            $file = "/$name.".$format;
            //var_dump($format);
            if (!file_exists($file)){
                $pathToFile = $this->saveRequestFile($file , $this->getRequestQuery('data'));
                if (file_exists($pathToFile)){
                    $data = $file;
                    $this->msg = 'file created';
                    //echo 'file created';
                } else {
                    $this->msg = 'file NOT created';
                    //echo 'file NOT created';
                }
            } else {
                $this->msg = 'file уже есть!';
            }
        } else {
            $this->msg = 'формат не найден';
        }
        if($json){
            //$mainBlock = '../picture/ajax_view.php';
            //$template = 'ajax/ajax_temp.php';
            return array( 'result' => $data, 'result_msg'=>$this->msg );
        } else {
            $mainBlock = 'picture/add_view';
            $template = EX_TEMPLATE;
            $data = array( 'result' => $data, 'result_msg'=>$this->msg );
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
            
            $this->view->render( $mainBlock, $template, $data );
        }*/
    }
    
    public function action_delete(){
        
    }
    
    protected function picture_merge() {
        echo 'picture_merge';
    }
    
    public function getHashFile(){
        $this->hashFile = $this->getRequestQuery('data', 'POST');
        return $this->hashFile;
        /*$name = md5($this->dataRequest.time());
        $file = "/$name.png";
        $this->saveRequestFile($file);
        if (!file_exists($file)){
            
        } else {
            
        }*/
    }
    
    /*
     * сохраняет нарисованную картинку
     * @param string $file - имя файла с расширением
     * @param string $data - base64 картинки
     * @param string $path_file - абсолютный путь до сохраняемого файла
     * @return string $path_file - абсолютный путь до сохраняемого файла
     */
    protected function saveRequestFile($file,$data,$path_file){
        $image = str_replace(" ", "+", $data);
        $image = substr($image, strpos($image, ","));
        //$dirDateMonth = date('m.Y');
        if(!$path_file){
            $path_file = PATH_ROOT.PATH_TO_SAVE_IMG.date('m.Y').$file;
        } else {
            $path_file.=$file;
        }
        file_put_contents($path_file, base64_decode($image));
        return $path_file;
    }
    
    /*
     * совмещает 2 картинки в 1 новую или перезаписывает имеющуюся
     * @param array $pict1 - 'typeImg'=>'расширение картинки', 'path'=>'абсолютный путь до картинки'
     * @param array $pict2 - 'typeImg'=>'расширение картинки', 'path'=>'абсолютный путь до картинки'
     * @param boolean $merge true|false (false default) - совместить с $pict1 или создать новую
     * @return string $path_file - абсолютный путь до совмещенного файла
     */
    private function mergePictures($pict1, $pict2, $merge=false){
        //if($pict1['typeImg']!==$pict2['typeImg']) return false;
        $sizePict1 = $this->getSizeTypeImage($pict1['path']);
        $sizePict2 = $this->getSizeTypeImage($pict2['path']);
        
        if($sizePict1['type'] !== $sizePict2['type']) return false;
        
        //list($sizePict1['width'], $sizePict1['height']) = getimagesize($pict1['path']);
        //list($sizePict2['width'], $sizePict2['height']) = getimagesize($pict2['path']);
        //$sizePict1['type'] = 'png';
        switch($sizePict1['type']){
            case 'jpg' :
                $src1 = imagecreatefromjpeg($pict1['path']);
                    imagealphablending($src1, true);
                $src2 = imagecreatefromjpeg($pict2['path']);
                    imagealphablending($src2, true);
                break;
            case 'png' :
                $src1 = imagecreatefrompng($pict1['path']);
                    imagealphablending($src1, true);
                    imagesavealpha($src1, true);
                $src2 = imagecreatefrompng($pict2['path']);
                    imagealphablending($src2, true);
                    imagesavealpha($src2, true);
                break;
        }
        
        if(!$src1 || !$src2) return false;
        
        if($merge){
            $genFile = $pict1['path'];
        } else {
            $genFile = PATH_ROOT.PATH_TO_SAVE_IMG.date('m.Y').md5(time()).'.'.$sizePict1['type'];
        }
        
        if(imagecopy($src1, $src2, 0, 0, 0, 0, $sizePict1['width'], $sizePict1['height'])){
            
            switch($sizePict1['type']){
                case 'jpg' :
                    imagejpeg($src1, $genFile );
                    break;
                case 'png' :
                    imagepng($src1, $genFile );
                    break;
            }
            
            imagedestroy($src1);
            imagedestroy($src2);
            
            return $genFile;
        } else {
            return false;
        }
        
        /*switch($pict1['typeImg']){
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
        }*/
        
    }
    
    /*
     * возвращает расширение картинки
     * @param string $path - путь до картинки
     * @param boolean $absolute - абсолютный ли путь указан в $path
     * @return string|false - расширение файла
     */
    public function getSizeTypeImage($path, $absolute = true, $return=array('width','height','type')) {
        if(!$absolute){
            $path = PATH_ROOT.$path;
        }
        list($img['width'],$img['height'],$img['type'])= getimagesize($path);
        $result = array();
        foreach($return as $key=>$val){
            switch ($val){
                case 'type' :   
                    if(!empty($this->flag[$img['type']])){
                        $result['type'] = $this->flag[$img['type']];
                    } else {
                        $result = false;
                        break;
                    }
                default : $result[$val] = $img[$val];
            }
        }
        return $result;
    }
}
