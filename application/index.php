<?
define('START', true);
include 'core/model.php';
include 'core/view.php';
include 'core/controller.php';
include 'core/route.php';
include 'config.php';
#Route::start(); // запускаю маршрутизатор
#
#делаю загрузку классов 'на лету'
function __autoload($class){
    $class=strtolower($class);
    if (file_exists(PATH_ROOT.'/application/controllers/'.$class.'.php')){
        include PATH_ROOT.'/application/controllers/'.$class.'.php';
    }
}
$router = Route::getInstance();
$router->start();
#echo $router->getBody;