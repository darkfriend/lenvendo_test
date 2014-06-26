<?if(!defined("START") || START!==true)die();?>
<?
/**
 * Маршрутизатор
 * Изобретение велосипеда
 * 
 * @author darkfriend
 */

class Route{
    
    protected $_controller = DEFAULT_CONTROLLER,
            $_action = DEFAULT_ACTION,
            $_params,
            $_paramLength,
            $_model,
            $is_404;
    static $_instance;

    public static function getInstance(){
        if(!(self::$_instance instanceOf self))
            self::$_instance = new self();
        return self::$_instance;
    }
    
    private function __construct() {
        #убираю GET-данные
        $routes= str_replace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        #вырезаю и разделяю
        $routes = explode('/', trim($routes,'/'));
        
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
        
        #Объявляю свой обработчик ошибок
        userExeption::startException();
        if(class_exists($this->getController())){
            $rc = new ReflectionClass($this->getController());
                #проверяю метод
                if($rc->hasMethod($this->getAction())){
                    #создаю экземпляр класса
                    $controller = $rc->newInstance();
                    #возвращаю метод
                    $method = $rc->getMethod($this->getAction());
                    #сравниваю кол-во получаемых и имеющих параметров
                    if( $controller->paramControllerLength < $controller->paramLength ){
                        throw new Exception('404!');
                    }
                    #вызываю класс
                    $method->invoke($controller);
                } else {
                    throw new Exception('No action!');
                }
        } else {
            throw new Exception('No controller!');
        }
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
    
    public function ErrorPage404(){
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        include '/application/controllers/controller_404.php';
        $controller = new controller_404;
        $controller->action_index();
    }
}

class userExeption{
    public function startException($myExep=true, $funcName = 'setException'){
        if($myExep) set_exception_handler('userExeption::'.$funcName);
    }
    static function setException($exception){
        error_log($exception->getMessage(), 0);
        Route::ErrorPage404();
        #echo "<strong>Exception:</strong> " , $exception->getMessage(); //вывод ошибки. Использую для дебага.
    }
    static function setErrorException($exception){
        $_POST['errorExceptionValue'] = $exception->getMessage();
        error_log($exception->getMessage(), 0);
    }
}