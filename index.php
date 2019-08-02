<?
//Front controller

// Загальні настройки
ini_set('display errors', 1);
error_reporting(E_ALL);

session_start();
//Підключення файлів системи
define('FT', '/FT/');
define('ROOT', dirname(__FILE__));

require_once (ROOT."/components/Autoload.php");
require_once (ROOT."/components/Router.php");
require_once (ROOT."/components/Db.php");

//Установка з'єднання з БД
//$db = new Db();
//Виклик Router
$router = new Router();
$router->run();
?>