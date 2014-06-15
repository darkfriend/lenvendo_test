<?
class controller{
    public $model,
        $view,
        $params;
    
    function __construct() {
        $this->view = new View();
        $fc = Route::getInstance();
        $this->params = $fc->getParams();
        //var_dump($this->params);
    }
    
    function action_index(){
        
    }
    
}