<?if(!defined("START") || START!==true)die();?>
<?php
/**
 * Контроллер для работы с исталлером.
 *
 * @author darkfriend
 */
class controller_install extends controller {
    public $paramControllerLength = 0;//возможное кол-во принимаемых параметров (GET) 
    
    public function __construct() {
        parent::__construct();
        $this->initModule('install');
        
    }
    
    public function action_index(){
        $arData['check_db'] = $this->getModel()->start_module();
        $this->view->render('install_view.php', 'install/install_temp.php', $arData);
    }
}
