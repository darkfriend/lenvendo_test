<?php
/**
 * Description of main
 *
 * @author dark
 */
class controller_main extends controller {
    function action_index(){
        $this->view->generate('main_view.php');
    }
}
