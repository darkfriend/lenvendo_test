<?
define('START', true);
include 'core/model.php';
include 'core/view.php';
include 'core/controller.php';
include 'core/route.php';
include 'config.php';
#Route::start(); // запускаю маршрутизатор
function __autoload($class){
    if (file_exists(PATH_ROOT.'/application/controllers/'.$class.'.php')){
        include PATH_ROOT.'/application/controllers/'.$class.'.php';
    }
}
$router = Route::getInstance();
$router->start();
#echo $router->getBody;