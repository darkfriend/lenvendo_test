<?php

class controller_picture extends controller {
    public $paramControllerLength = 0,
            $hashFile,
            $msg;
    
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
            $result_msg_html = 'Вы не <a href="/user/auth/">авторизовались</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        if($json){
            //$mainBlock = '../picture/ajax_view.php';
            //$template = 'ajax/ajax_temp.php';
            return array( 'result' => $data, 'result_msg'=>$this->msg );
        } else {
            $mainBlock = 'picture/add_view';
            $template = EX_TEMPLATE;
            $data = array( 'result' => $data, 'result_msg'=>$this->msg, 'result_msg_html'=>$result_msg_html );
            
            $data['user_id'] = $this->user['user_id'];
            $data['login'] = $this->user['login'];
            
            $this->view->render( $mainBlock, $template, $data );
        }
    }
    
    public function action_edit() {
        if(!$this->getRequestQuery('data')){
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
        }
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
    
    #сохраняет нарисованную картинку
    protected function saveRequestFile($file,$data){
        $image = str_replace(" ", "+", $data);
        $image = substr($image, strpos($image, ","));
        //$dirDateMonth = date('m.Y');
        $path_file = PATH_ROOT.PATH_TO_SAVE_IMG.date('m.Y').$file;
        file_put_contents($path_file, base64_decode($image));
        return $path_file;
    }
}
