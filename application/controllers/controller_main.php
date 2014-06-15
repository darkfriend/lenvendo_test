<?php
/**
 * Description of main
 *
 * @author dark
 */
class controller_main extends controller {
    public function action_index(){
        //$fc = 
        //echo 'еуые';
        //$fc = Route::getInstance();
        //var_dump($this->params);
        $params = $this->params;
        $name = $params['name'];
        //echo $name;
        $this->view->render('main_view.php', DEFAULT_TEMPLATE , $name);
    }
}
