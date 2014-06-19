<?php
/**
 * Description of controller_install
 *
 * @author dark
 */
class controller_install extends controller {
    //put your code here
    public $paramControllerLength = 0;//возможное кол-во принимаемых параметров (GET)
            //$model; 
    
    public function __construct() {
        parent::__construct();
        $this->initModule('install');
        
    }
    
    public function action_index(){
        //$params = $this->params;
        //$name = $params['name'];
        //echo $name;
        //$model = $this->initModule('install');
        //var_dump($this->getModel());
        //var_dump(get_class_vars(get_class($this->getModel())));
        //->setModel($modelObj)
        //var_dump($this->getModel());
        //$model = $this->getModel();
                //->table_check();
        //var_dump($this->model);
        //$this->model->table_check();
        //$this->step1();
        
        #запускаю модель
        $arData['check_db'] = $this->getModel()->start_module();
        
        //var_dump($this->getModel()->start_module());
        $this->view->render('install_view.php', 'install/install_temp.php', $arData);
    }
    
    /**
     * Шаг 1, проверка установки
     * @version 0.1
     */
    private function step1(){
        var_dump($this->model->table_check());
    }

        protected function getHeaderQuery(){
        
    }
}
