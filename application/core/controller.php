<?
class controller{
    public $model,
        $view,
        $params,
        $paramLength;
    
    function __construct() {
        $this->view = new View();
        $fc = Route::getInstance();
        $this->params = $fc->getParams();
        $this->paramLength = $fc->getLengthParam();
        #var_dump($fc);
        //var_dump($this->params);
    }
    
    function action_index(){
        
    }
    
    protected function initModule($moduleName){
        $module_path = PATH_ROOT.'/application/models/';
        if(is_dir($module_path.$moduleName.'_models')){
            echo "test";
            $module_path = $module_path.$moduleName.'_models/'.$moduleName.'_model.php';
        } elseif ( file_exists($module_path.$moduleName.'_model.php') ) {
            $module_path = $module_path.$moduleName.'_model.php';
        } else {
            userExeption::startException();
            throw new Exception('No model!');
        }
        include $module_path;
        
        $classModel = $moduleName.'_model';
        //return new $classModel();
        //new install_model()->start_module();
        $this->setModel( new $classModel );
        //var_dump($this->getModel());
        //return $this->getModel();
    }
    
    function getModel(){
        return $this->model;
    }
    
    function setModel($modelObj){
        $this->model = $modelObj;
    }
    
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
            foreach ($array as $key=>$value){
                if(is_array($value)){
                    #делаю рекурсию
                    $newArray[$key][] = $this->clearanceValues( $value );
                } else {
                    $newArray[$key] = $this->clearSpecSym( $value );
                }
            }
            return $newArray;
        //}
    }
    
    private function clearSpecSym($data){
        if (get_magic_quotes_gpc()) $data = stripslashes($data);
        define('ENT_SUBSTITUTE', ENT_IGNORE);
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
        $data = preg_replace('#\W#', '', $data);
        return $data;
    }
    
    public function getUser(){
        return $_SESSION['user_id'];
    }
}