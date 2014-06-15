<?php

/**
 * Description of controller_ajax
 *
 * @author Виктор
 */
class controller_ajax extends controller {
    public $paramControllerLength = 1; //возможное кол-во принимаемых параметров (GET)
    public function action_index(){
        $params = $this->params;
        $name = $params['name'];
        //echo $name;
        $this->view->render('main_view.php', DEFAULT_TEMPLATE , $name);
    }
}
