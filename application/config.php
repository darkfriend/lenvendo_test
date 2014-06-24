<?if(!defined("START") || START!==true) die(); ?>
<?

define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT']); #путь от рута до папки с сайтом. Сделал динамично.

define('DEFAULT_CONTROLLER','controller_main'); #имя index контроллера
define('DEFAULT_ACTION', 'action_index'); #имя index действия

define('EX_TEMPLATE', 'template_view.php'); #шаблон обработчик
define('DEFAULT_TEMPLATE', 'default'); #пользовательский шаблон

define('PATH_TO_SAVE_IMG', '/upload/'); #путь от корня сайта для сохранения картинок
define('PATH_TO_USER_MODELS', 'user_models'); #папка с модулями для работы с пользователями. при false ищет модели в application/models/

define('PREFIX_DIR_MODEL', 'models'); #префикс директории файлов-моделей модели
define('PREFIX_MODEL', 'model'); #префикс запускающего файла модели
define('PREFIX_CONTROLLER', 'controller'); #префикс для контроллеров

define('DB_NAME', 'mvc_test'); #имя БД
define('DB_USER', 'root'); #логин пользователя
define('DB_USER_PASSWORD', ''); #пароль пользователя

define('USER_GROUP_DEFAULT', 2); #группа пользователей по умолчанию
define('USER_IMAGE_EDIT_MARGE', true); #группа пользователей по умолчанию