<?php

/**
 * Description of controller_404
 *
 * @author dark
 */
class controller_404 extends controller {
    function action_index(){
        $this->view->generate('404_view.php');
    }
}
