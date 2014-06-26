<?php
/**
 * Description of main
 *
 * @author dark
 */
class controller_main extends controller {
    public $paramControllerLength = 1; //возможное кол-во принимаемых параметров (GET)
    
    public function action_index(){
        $dataArray = array();
        $dataArray['params'] = $this->params;
        $dataArray['user_id'] = $this->user['user_id'];
        $dataArray['login'] = $this->user['login'];
        //echo $name;
        $this->view->render('main_view.php', EX_TEMPLATE , $dataArray);
    }
    
    //мануал
    public function action_readme(){
        $this->view->render('readme_view.php', EX_TEMPLATE , '');
    }
}
