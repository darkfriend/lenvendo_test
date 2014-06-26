<?if(!defined("START") || START!==true)die();?>
<?php
/**
 * Контроллер для работы с ajax.
 *
 * @author darkfriend
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
        //$this->initModule('ajax');
    }
    
    public function action_index(){
        #запускаю модель
        $arData['REQUEST'] = $this->getModel()->start_module();
        list($width,$height,$type)= getimagesize($arData['name_img']);
        if( in_array( $type, array(1,2,3)) ){
            $this->typeImg = $this->flag[$type];
        } else {
            $this->params = 'Ошибка! Изображение не создано!';
        }
        
    }
    
    //метод добавления картинки
    public function action_picture_add() {
        if($this->isAuth()){
            //инициализация конроллера картинок
            $this->initController('picture');
            //запускаю контроллер картинок. Метод добавления.
            $data = $this->getController('picture')->action_add(true);
        } else {
            $data['error'] = true;
            $data['result_msg'] = 'Авторизуйтесь или зарегистрируйтесь!';
            $data['result_msg_html'] = 'Вы не <a href="/user/auth/">авторизовались</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render( 'ajax_view.php', 'ajax/ajax_temp.php', $data );
    }
    
    public function action_picture_edit() {
        if($this->isAuth()){
            //инициализация конроллера картинок
            $this->initController('picture');
            //запускаю контроллер картинок. Метод редактирования.
            $data = $this->getController('picture')->action_edit(true);
        } else {
            $data['error'] = true;
            $data['result_msg'] = 'Авторизуйтесь или зарегистрируйтесь!';
            $data['result_msg_html'] = 'Вы не <a href="/user/auth/">авторизовались</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render( 'ajax_view.php', 'ajax/ajax_temp.php', $data );
    }
    
    public function action_picture_delete() {
        if($this->isAuth()){
            //инициализация конроллера картинок
            $this->initController('picture');
            //запускаю контроллер картинок. Метод удаления.
            $data = $this->getController('picture')->action_delete(true);
        } else {
            $data['error'] = true;
            $data['result_msg'] = 'Авторизуйтесь или зарегистрируйтесь!';
            $data['result_msg_html'] = 'Вы не <a href="/user/auth/">авторизовались</a> или <a href="/user/reg/">зарегистрируйтесь</a>';
        }
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render( 'ajax_view.php', 'ajax/ajax_temp.php', $data );
    }
}
