<?php

class controller_picture extends controller {
    public $paramControllerLength = 1,
            $hashFile,
            $msg;
    
    public $flag = array( //поддерживаемые расширения
                1=>'GIF',
                2=>'JPG',
                3=>'PNG',
            );


    public function action_index(){
        //инициализация модели картинок
        $this->initModule('pictures');
        $data['resultAll'] = $this->getModel()->get_data();
//        echo '<pre>';
//        print_r($resultAll);
//        echo '</pre>';
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render( 'picture/index_view.php', EX_TEMPLATE, $data );
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
                            $this->msg = 'Файл создан и сохранён';
                        } else {
                            $this->msg = 'Ошибка добавления';
                        }
                        //echo 'file created';
                    } else {
                        $this->msg = 'Файл не создан';
                        //echo 'file NOT created';
                    }
                } else {
                    $this->msg = 'Такой файл уже есть!';
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
        
        if($json){
            $id_picture = $this->getRequestQuery('imgid');
        } else {
            $id_picture = $this->clearanceValues($this->params['id']);
        }
        
        #Объявляю свой обработчик ошибок
        userExeption::startException();
        if( !$id_picture ){
            throw new Exception('no params in edit picture');
        }
        
        //var_dump($this->params);
        
        if($this->isAuth()){
            //инициализация модели картинок
            $this->initModule('pictures');
            if( !$rowResult=$this->getModel()->check_permisssion_edit( array( 'id_img' => $id_picture, 'user_id' => $this->getUser() ) ) ){
                $this->msg = 'Вам нельзя редактировать данный файл или файл не найден.';
                $result = 'error';
            } elseif ( !$pictNew = $this->getRequestQuery('data') ){
                //var_dump($rowResult);
                //$result = array();
                $sizePictMain = $this->getSizeTypeImage( PATH_ROOT.PATH_TO_SAVE_IMG.$rowResult['create_date'].'/'.$rowResult['name_file'] );
                //var_dump($sizePictMain);
                $fileEdit = true;
                $this->msg = 'Хэш не найден';
            } elseif( $format = $this->getRequestQuery('format') ) {
                //[\\](\w+\.png|jpg)$  2 - [\\](\w+\.\w+)
                
                $nameNew = md5($pictNew.time());
                $fileNew = '/'.$nameNew.'.'.$format;
                $pathToNewFile = $this->saveRequestFile($fileNew , $pictNew);
                $pict1 = PATH_ROOT.PATH_TO_SAVE_IMG.$rowResult['create_date'].'/'.$rowResult['name_file'];
                        
                $pathFile = $this->mergePictures($pict1, $pathToNewFile, USER_IMAGE_EDIT_MARGE);
                //echo $pathFile;
                preg_match('/(\w+\.\w+)$/', $pathFile, $nameFile);
                $nameFile = $nameFile[1];
                if (file_exists($pathFile)){
                    if($this->getModel()->update_data($id_picture, $nameFile)){
                        $data = $nameFile;
                        $this->msg = 'Файл успешно отредактирован.';
                        $isEdit = true;
                    } else {
                        $this->msg = 'Ошибка редактирования. БД не обновлена!';
                    }
                } else {
                    $this->msg = 'Ошибка редактирования. Файл не найден!';
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
            $res = array( 'result' => $data, 'result_msg'=>$this->msg, 'edit'=>$isEdit );
            if($fileEdit){
                $res['arrResult']=$rowResult;
                $res['arrResult']['id']=$id_picture;
                $res['arrResult']['size'] = $sizePictMain;
            }
            return $res;
        } else {
            //$mainBlock = 'picture/add_view.php';
            //$template = EX_TEMPLATE;
            $data = array( 'result' => $data, 'result_msg'=>$this->msg, 'result_msg_html'=>$result_msg_html );
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
            
            if($isEdit){
                $data['edit'] = true;
            }
            
            if($result=='error'){
                $data['error'] = true;
            }
            
            if($fileEdit){
                $data['arrResult']=$rowResult;
                $data['arrResult']['id']=$id_picture;
                $data['arrResult']['size'] = $sizePictMain;
            }
            
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
    
    public function action_delete($json=false){
        
        if($json){
            $id_picture = $this->getRequestQuery('imgid');
        } else {
            $id_picture = $this->clearanceValues($this->params['id']);
        }
        
        #Объявляю свой обработчик ошибок
        userExeption::startException();
        if( !$id_picture ){
            throw new Exception('no params in edit picture');
        }
        
        if($this->isAuth()){
            //инициализация модели картинок
            $this->initModule('pictures');
            if( !$rowResult=$this->getModel()->check_permisssion_edit( array( 'id_img' => $id_picture, 'user_id' => $this->getUser() ) ) ){
                $this->msg = 'Вам нельзя удалять данным файлом или файл не найден.';
                $result = 'error';
            } else {
                if( $removed = $this->removeFile( PATH_ROOT.PATH_TO_SAVE_IMG.$rowResult['create_date'].'/'.$rowResult['name_file'], $id_picture )){
                    $this->msg = 'Файл успешно удалён';
                } else {
                    $this->msg = 'Ошибка удалёния файла!';
                }
            }
        } else {
            $this->msg  = 'Авторизуйтесь или зарегистрируйтесь!';
            $result_msg_html = '<a href="/user/auth/">Авторизуйтесь</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        
        if($json){
            $res = array( 'result' => $removed, 'result_msg'=>$this->msg, 'result_msg_html'=>$result_msg_html );
            if($removed){
                $res['arrResult']=$rowResult;
                $res['arrResult']['id']=$id_picture;
            }
            return $res;
        } else {
            $data = array( 'result' => $removed, 'result_msg'=>$this->msg, 'result_msg_html'=>$result_msg_html );
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
            
            /*if($isEdit){
                $data['edit'] = true;
            }*/
            
            if($fileEdit){
                $data['arrResult']=$rowResult;
                $data['arrResult']['id']=$id_picture;
            }
            
            $this->view->render( 'picture/add_view.php', EX_TEMPLATE, $data );
            //$this->view->render( $mainBlock, $template, $data );
        }
    }
    
    //картинки авторизованного пользователя
    public function action_user(){
        if($this->isAuth()){
            //инициализация модели картинок
            $this->initModule('pictures');
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
            $data['resultAll'] = $this->getModel()->get_data(true, array('id_user'=>$data['user_id']));
            //$this->view->render( 'picture/index_view.php', EX_TEMPLATE, $data );
        } else {
            $this->msg  = 'Авторизуйтесь или зарегистрируйтесь!';
            $result_msg_html = '<a href="/user/auth/">Авторизуйтесь</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        $this->view->render( 'picture/index_view.php', EX_TEMPLATE, $data );
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
    protected function saveRequestFile($file,$data,$path_file=false){
        $image = str_replace(" ", "+", $data);
        $image = substr($image, strpos($image, ","));
        
        if(!$path_file){
            $path_file = PATH_ROOT.PATH_TO_SAVE_IMG.date('m.Y').$file;
        } else {
            $path_file.=$file;
        }
        
        if(!file_put_contents($path_file, base64_decode($image))){
            return false;
        }
        
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
        $sizePict1 = $this->getSizeTypeImage($pict1);
        $sizePict2 = $this->getSizeTypeImage($pict2);
        
        if($sizePict1['type'] !== $sizePict2['type']) return false;
        
        //list($sizePict1['width'], $sizePict1['height']) = getimagesize($pict1['path']);
        //list($sizePict2['width'], $sizePict2['height']) = getimagesize($pict2['path']);
        //$sizePict1['type'] = 'png';
        switch($sizePict1['type']){
            case 'jpg' :
                $src1 = imagecreatefromjpeg($pict1);
                    imagealphablending($src1, true);
                $src2 = imagecreatefromjpeg($pict2);
                    imagealphablending($src2, true);
                break;
            case 'png' :
                $src1 = imagecreatefrompng($pict1);
                    imagealphablending($src1, true);
                    imagesavealpha($src1, true);
                $src2 = imagecreatefrompng($pict2);
                    imagealphablending($src2, true);
                    imagesavealpha($src2, true);
                break;
        }
        
        if(!$src1 || !$src2) return false;
        
        if($merge){
            $genFile = $pict1;
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
            unlink($pict2);
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
        list($img['width'],$img['height'],$img['type']) = getimagesize($path);
        $result = array();
        foreach($return as $key=>$val){
            switch ($val){
                case 'type' :   
                    if(!empty($this->flag[$img['type']])){ 
                        //echo $this->flag[$img['type']];
                        $result['type'] =  mb_strtolower( $this->flag[$img['type']] );
                        break;
                    } else {
                        $result = false;
                        break;
                    }
                default : $result[$val] = $img[$val];
            }
        }
        return $result;
    }
    
    /*
     * полностью удаляет картинку
     * @param string $file - бсолютный путь до файла
     * @param integer $id - ID картинки в БД
     * @return boolean
     */
    protected function removeFile($file,$id){
        if(file_exists($file)){
            $fileDeleted = unlink($file);
        } else{
            return false;
        }
        
        $recDeleted = $this->getModel()->delete_data($id);
        
        if(!$fileDeleted || !$recDeleted) return false;
        
        return true;
    }
}
