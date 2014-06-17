<?if(!defined("START") || START!==true) die(); ?>
<?
define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT']); #путь от рута до папки с сайтом. Сделал динамично.
define('DEFAULT_CONTROLLER','controller_main'); #имя контроллера
define('DEFAULT_ACTION', 'action_index'); #имя действия
define('EX_TEMPLATE', 'template_view.php'); #шаблон обработчик
define('DEFAULT_TEMPLATE', 'default'); #пользовательский шаблон
define('DB_NAME', 'mvc_test'); #имя БД
define('DB_USER', 'root'); #логин пользователя
define('DB_USER_PASSWORD', ''); #пароль пользователя