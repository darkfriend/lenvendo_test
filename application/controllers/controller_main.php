<?php
/**
 * Description of main
 *
 * @author dark
 */
class controller_main extends controller {
    public $paramControllerLength = 1; //возможное кол-во принимаемых параметров (GET)
    public function action_index(){
        $params = $this->params;
        $name = $params['name'];
        //echo $name;
        $this->view->render('main_view.php', DEFAULT_TEMPLATE , $name);
    }
}
