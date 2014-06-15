<?if(!defined("START") || START!==true)die();?>
<?
/**
 * 
 * Класс простой маршрутизации
 * Изобретение велосипеда
 * @author darkfriend
 * 
 */
class Route{
    
    protected $_controller = DEFAULT_CONTROLLER,
            $_action = DEFAULT_ACTION,
            $_params,
            $_paramLength,
            $_model,
            $is_404,
            $_body;
    static $_instance;

    public static function getInstance(){
        if(!(self::$_instance instanceOf self))
            self::$_instance = new self();
        return self::$_instance;
    }
    
    private function __construct() {
        userExeption::startException();
        //$this->_controller = DEFAULT_CONTROLLER;
        #echo $this->_controller;
        $routes = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
        
        // получаю имя контроллера
        if ( !empty($routes[0]) ){
            $this->_controller = 'controller_'.$routes[0];
        }
        
        // получаю имя экшена
        if ( !empty($routes[1]) ){
            $this->_action = 'action_'.$routes[1];
        }
        
        //получаю параметры
        if(!empty($routes[2])){
            $keys = $values = array();
            for($i=2, $cnt=count($routes); $i<$cnt; $i++ ){
                if(!($i%2)){
                    $keys[]=$routes[$i];
                } else {
                    $values[]=$routes[$i];
                }
            }
            
            //проверяю на соответствие key->values
            if(count($keys)==count($values)){
                //сливаю массивы в key->values
                $this->_params = array_combine($keys, $values);
            } else {
                $this->_controller = 404;
            }
            
            $this->_paramLength = count($this->_params);
        }
    }

    public function start(){
        // контроллер и действие по умолчанию
        
        /*$controller_name = 'main';
        $action_name = 'index';
        //echo $this->controller_name;
        #Объявляю свой обработчик ошибок
        
        
        userExeption::startException();
        
        $routes = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
        
        // получаю имя контроллера
        if ( !empty($routes[0]) ){
            $controller_name = $routes[0];
        }
        
        // получаю имя экшена
        if ( !empty($routes[1]) ){
            $action_name = $routes[1];
        }
        
        //получаю параметры
        if(!empty($routes[2])){
            $keys = $values = array();
            for($i=2, $cnt=count($routes); $i<$cnt; $i++ ){
                if($i%2){
                    $keys[]=$routes[$i];
                } else {
                    $values[]=$routes[$i];
                }
            }
            $params = array_combine($keys, $values);
            
            //добавляю префикс
            $model_name = 'model_'.$controller_name;
            #$model_file = strtolower($model_name).'.php';
            // подцепляю файл с классом модели
            $model_path = PATH_ROOT."application/models/".strtolower($model_name).'.php';
            if(file_exists($model_path)){
                include $model_path;
            } else {
                // добавляю исключение
                throw new Exception('No model!');
            }
        }*/
        
        #Объявляю свой обработчик ошибок
        userExeption::startException();
        //echo $this->getController();
        if(class_exists($this->getController())){
            $rc = new ReflectionClass($this->getController());
            //if($rc->implementsInterface('IController')){
                if($rc->hasMethod($this->getAction())){
                    $controller = $rc->newInstance();
                    $method = $rc->getMethod($this->getAction());
                    //echo $method.'<br>';
                    //echo $controller;
                    //var_dump($controller);
                    if( $controller->paramControllerLength < $controller->paramLength ){
                        throw new Exception('404!');
                    }
                    
                    $method->invoke($controller);
                    
                } else {
                    throw new Exception('No action!');
                }
            //} else {
            //    throw new Exception('No interface!');
            //}
        } else {
            throw new Exception('No controller!');
        }
        
        /*// добавляю префиксы к остальным
        #$model_name = 'model_'.$controller_name;
        $controller_name = 'controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подцепляю файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = PATH_ROOT.'/application/controllers/'.$controller_file;
        
        if(file_exists($controller_path)){
            include PATH_ROOT.'/application/controllers/'.$controller_file;
        } else {
            // добавляю исключение
            throw new Exception('No controller!');
        }
        
        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        
        if(method_exists($controller, $action)){
            // вызываю действие контроллера
            $controller->$action();
        } else {
            // добавляю исключение
            throw new Exception('No action!');
        }*/
    }
    
    function getLengthParam(){
        return $this->_paramLength;
    }
    
    function getParams(){
        return $this->_params;
    }
    
    function getController(){
        return $this->_controller;
    }
    
    function getAction(){
        return $this->_action;
    }
    
    function getBody(){
        return $this->_body;
    }
    
    function setBody($newBody){
        $this->_body = $newBody;
    }
    
    public function ErrorPage404(){
        //$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        //$this->start('404');
        //self::start('404');
        include '/application/controllers/controller_404.php';
        $controller = new controller_404;
        $controller->action_index();
        //header('Location:'.$host.'404/');
    }
}

class userExeption{
    public function startException($myExep=true){
        if($myExep) set_exception_handler('userExeption::setException');
    }
    static function setException($exception){
        error_log($exception->getMessage(), 0);
        Route::ErrorPage404();
        #echo "<strong>Exception:</strong> " , $exception->getMessage();
    }
}