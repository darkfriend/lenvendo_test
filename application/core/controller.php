<?
class controller{
    public $model,
        $view,
        $params,
        $paramLength,
        $controller,
        $user;
    
    function __construct() {
        $this->view = new View();
        $fc = Route::getInstance();
        $this->params = $fc->getParams();
        $this->paramLength = $fc->getLengthParam();
        $this->getSession(); //старт сессии
        
        $this->user['user_id'] = $this->getUser();
        $this->user['login'] = $this->getLogin();
        #var_dump($fc);
        //var_dump($this->params);
    }
    
    function action_index(){
        
    }
    
    protected function initModule($moduleName, $dirModel=false){
        $module_path = PATH_ROOT.'/application/models/';
        if($dirModel){
            $module_path .= $dirModel.'/';
        }
        if(is_dir($module_path.$moduleName.'_models')){
            //echo "test";
            $module_path = $module_path.$moduleName.'_models/'.$moduleName.'_model.php';
        } elseif ( file_exists($module_path.$moduleName.'_model.php') ) {
            $module_path = $module_path.$moduleName.'_model.php';
        } else {
            userExeption::startException();
            throw new Exception('No model!');
        }
        include $module_path;
        
        $classModel = $moduleName.'_model';
        $this->setModel( new $classModel );
    }
    
    protected function initController($controllerName, $dirController=false){
        $controller_path = PATH_ROOT.'/application/controllers/';
        if($dirController){
            $controller_path .= $dirController.'/';
        }
        if(is_dir($controller_path)){
            //echo "test";
            $controller_path = $controller_path.'controller_'.$controllerName.'.php';
        } elseif ( file_exists($controller_path.'controller_'.$controllerName.'.php') ) {
            $controller_path = $controller_path.'controller_'.$controllerName.'.php';
        } else {
            userExeption::startException();
            throw new Exception('No controller!');
        }
        include $controller_path;
        
        $classController = 'controller_'.$controllerName;
        $this->setController( new $classController, $controllerName );
    }
    
    //возвращает объект инициализированной модели
    public function getModel(){
        return $this->model;
    }
    
    //записывает объект инициализированной модели
    public function setModel($modelObj){
        $this->model = $modelObj;
    }
    
    //возвращает объект инициализированного контроллера, с ключём как имя контроллера
    public function getController($name){
        return $this->controller[$name];
    }
    
    //записывает объект инициализированного контроллера, с ключём как имя контроллера
    public function setController($modelObj, $name){
        $this->controller[$name] = $modelObj;
    }
    
    //возвращает обработанные request данные
    public function getRequestQuery($val=null, $method='POST'){
        switch ($method) {
            case 'POST' : $methodArray=$_POST; break;
            case 'GET' : $methodArray=$_GET; break;
        }
        if(!$methodArray) return false;
        if($_SERVER['REQUEST_METHOD']==$method){
            $val = $val ? $methodArray[$val] : $methodArray;
            return $this->clearanceValues($val);
        }
        return false;
    }

    public function clearanceValues($array){
        //if($_SERVER['REQUEST_METHOD']=='POST'){
        if(is_array($array)){
            foreach ($array as $key=>$value){
                if(is_array($value)){
                    #делаю рекурсию
                    $newArray[$key][] = $this->clearanceValues( $value );
                } else {
                    $newArray[$key] = $this->clearSpecSym( $value );
                }
            }
        } else {
            $newArray = $this->clearSpecSym( $array );
        }
        return $newArray;
    }
    
    private function clearSpecSym($data){
        if (get_magic_quotes_gpc()) $data = stripslashes($data);
        define('ENT_SUBSTITUTE', ENT_IGNORE);
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
        //$data = preg_replace('#\W#', '', $data);
        return $data;
    }
    
    public function getUser(){
        return $_SESSION['id_user'];
    }
    
    public function getLogin(){
        return $_SESSION['login'];
    }

        //метод для проверки авторизованности
    public function isAuth(){
        if( !empty($_SESSION['login']) || !empty($_SESSION['id_user']) ){
            return true;
        }
    }
    
    //возвращает id сессии или создаёт сессию и возвращает id
    public function getSession(){
        if(session_id()){
            return session_id();
        } else {
            return session_start();
        }
    }
    
    //удаляет сессию вместе с куками сессии
    public function destroySession(){
        if(session_id()){
            setcookie(session_name(),session_id(), time()-60*60*24);
            if(session_unset() || session_destroy()){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}