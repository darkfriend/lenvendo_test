<?if(!defined("START") || START!==true)die();?>
<?php
/**
 * Контроллер для работы с пользователями.
 *
 * @author darkfriend
 */
class controller_user extends controller {
    public $paramControllerLength = 0, //возможное кол-во принимаемых параметров (GET)
            $msg=array(); //массив сообщений
    public function __construct() {
        parent::__construct();
        #Объявляю свой обработчик ошибок
        userExeption::startException(true, 'setErrorException');
        if(!$this->getSession()){//запуск сессии
            throw new Exception('No session!');
        }
    }
    public function action_index(){
        userExeption::startException();
        throw new Exception('Not found! Is user/index');
    }
    
    //действие на авторизацию пользователя
    public function action_auth(){
        if ($this->authUser()) {
            $data['result'] = 'Вы успешно авторизованны!';
            $data['isAuth'] = $this->isAuth;
        } elseif($this->isAuth) {
            $data['error'] = true;
            $data['isAuth'] = true;
            $data['result'] = 'Авторизация не удалась.';
            $data['result_msg'] = $this->msg;
        } elseif(!$this->noRequest) {
            $data['error'] = true;
            $data['result'] = 'Авторизация не удалась.';
            $data['result_msg'] = $this->msg;
        } else {
            $data = '';
        }
        
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render( 'user/auth_view.php', EX_TEMPLATE, $data );
    }
    
    /*
     * метод авторизации пользователя
     * @return true|false
     */
    public function authUser() {
        //проверка на авторизованность
        if( !empty($_SESSION['login']) || !empty($_SESSION['id_user']) ){
            $this->isAuth = true;
            $this->msg = 'Вы уже авторизованны!';
            return false;
        }
        //инициализация модели авторизации
        $this->initModule('auth', PATH_TO_USER_MODELS);
        //возвращаю весь $_POST
        $reqestHeader = $this->getRequestQuery();
        if (!$reqestHeader['login']){
            $this->noRequest = true;
            return false;
        }
        //проверяю логин и пароль
        $resultCheck = $this->getModel()->checkAuthData( trim($reqestHeader['login']),md5($reqestHeader['pass']) );
        if($resultCheck['check_auth']){
            $this->user['login'] = $_SESSION['login'] = trim($reqestHeader['login']);
            $this->user['user_id'] = $_SESSION['id_user'] = $resultCheck['id_user'];
            $this->isAuth = true;
            return true;
        } else {
            $this->msg = $resultCheck['msg'];
            return false;
        }
    }
    
    //регистрация пользователя
    public function action_reg(){ 
        if($_POST['login'] || $_POST['pass']){
            if ($this->regUser()) {
                $data['result_msg'] = 'Вы успешно зарегистрированны и авторизованны!';
                $data['isAuth'] = true;
                $data['reg_success'] = true;
            } elseif($this->isAuth) {
                $data['error'] = true;
                $data['isAuth'] = true;
                $data['result'] = 'Регистрация не удалась.';
                $data['result_msg'] = $this->msg;
            } else {
                $data['error'] = true;
                $data['result'] = 'Регистрация не удалась.';
                $data['result_msg'] = $this->msg;
            }
        } else {
            if (!$this->regUser() && $this->isAuth) {
                $data['error'] = true;
                $data['isAuth'] = true;
                $data['result'] = 'Регистрация не удалась.';
                $data['result_msg'] = $this->msg;
            }
        }
        
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render( 'user/reg_view.php', 'template_view.php', $data );
    }
    
    /*
     * метод регистрации пользователя
     * @return true|false
     */
    public function regUser(){
        //инициализация модели регистрации
        $this->initModule('reg', PATH_TO_USER_MODELS);
        //проверка на авторизованность
        if( $this->isAuth() ){
            $this->isAuth = true;
            $this->msg = 'Вы уже зарегистрированны и авторизованны!';
            return false;
        }
        //возвращаю весь $_POST
        $reqestHeader = $this->getRequestQuery();
        if (!$reqestHeader) return false;
        //проверяю логин и пароль
        $resultRegister = $this->getModel()->register_user( trim($reqestHeader['login']),md5($reqestHeader['pass']) );
        if($resultRegister['check_auth']){
            $this->user['login'] = $_SESSION['login'] = trim($reqestHeader['login']);
            $this->user['user_id'] = $_SESSION['id_user'] = $resultRegister['id_user'];
            return true;
        } else {
            $this->msg = $resultRegister['msg'];
            return false;
        }
    }
    
    //разлогинизация
    public function action_exit(){
        if($this->destroySession()){
            $data['result'] = true;
            $data['result_msg'] = 'Вы успешно вышли.';
        } else {
            $data['result'] = false;
            $data['result_msg'] = 'Выход не удался. Возможно вы не были авторизованны!';
        }
        $this->view->render( 'user/exit_view.php', 'template_view.php', $data );
    }
}
