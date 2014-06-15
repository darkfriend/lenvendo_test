<?
define('START', true);
include 'core/model.php';
include 'core/view.php';
include 'core/controller.php';
include 'core/route.php';
include 'config.php';
#Route::start(); // запускаю маршрутизатор
$router = new Route();
$router->start();