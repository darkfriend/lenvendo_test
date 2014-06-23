<?php

/**
 * Description of controller_404
 *
 * @author dark
 */
class controller_404 extends controller {
    function action_index(){
        $data['user_id'] = $this->user['user_id'];
        $data['login'] = $this->user['login'];
        $this->view->render('404_view.php', EX_TEMPLATE ,$data);
    }
}
