<?php
/**
 * Description of controller_install
 *
 * @author dark
 */
class controller_install extends controller {
    //put your code here
    public $paramControllerLength = 0,
            $model; //возможное кол-во принимаемых параметров (GET)

    public function action_index(){
        //$params = $this->params;
        //$name = $params['name'];
        //echo $name;
        $this->initModule('install');
        //$this->getModel()->table_check();
        //var_dump($this->model);
        //$this->model->table_check();
        $this->view->render('install_view.php', 'install/install_temp.php');
    }
    
    protected function getHeaderQuery(){
        
    }
}
