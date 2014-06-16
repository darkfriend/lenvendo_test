<?php

/**
 * Description of controller_ajax
 *
 * @author Виктор
 */
class controller_main extends controller {
    public $paramControllerLength = 1; //возможное кол-во принимаемых параметров (GET)
    public function action_index(){
        $params = $this->params;
        $name = $params['name'];
        //echo $name;
        $this->view->render('ajax/ajax_view.php', 'ajax/ajax_temp.php' , $name);
    }
//    public function action_ajax(){
//        include 'ajax/';
//    }
}
