<?if(!defined("START") || START!==true) die(); ?>
<?
define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT']); #путь от рута до папки с сайтом. Сделал динамично.
define('DEFAULT_CONTROLLER','controller_main'); #имя контроллера
define('DEFAULT_ACTION', 'action_index'); #имя действия
define('DEFAULT_TEMPLATE', 'template_view.php'); #основной шаблон
define('DB_NAME', ''); #имя БД
define('DB_USER', ''); #логин пользователя
define('USER_PASSWORD', ''); #пароль пользователя