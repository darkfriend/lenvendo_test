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
        //var_dump($fc->getLengthParam());
        //var_dump($this->params);
    }
    
    function action_index(){
        
    }
    
}