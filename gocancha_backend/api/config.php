<?php
/**
 * inclusiones composer
 */
require_once __DIR__.'/../vendor/autoload.php';

if (!function_exists('apache_request_headers')) {
    function apache_request_headers() 
    {
        foreach($_SERVER as $key=>$value) {
            if (substr($key,0,5)=="HTTP_") {
                $key=str_replace(" ","-",ucwords(strtolower(str_replace("_"," ",substr($key,5)))));
                $out[$key]=$value;
            }else{
                $out[$key]=$value;
            }
        }
        return $out;
    }
}
Security::cors();
/**
* Definicio de constantes del sistema
*/
defined('APP_NAME') || define('APP_NAME', 'App Canchita');
defined('WWW_BASE') || define('WWW_BASE','./');
defined('APP_VERSION') || define('APP_VERSION', 'v0.0');
defined('MODULE_NAME') || define('MODULE_NAME', 'MyApp');
defined('APP_DEBUG') || define('APP_DEBUG', true);
defined('CDN_BASE') || define('CDN_BASE', './');
defined('APP_THEME') || define('APP_THEME', '');
defined('APP_MULTISUCURSAL') || define('APP_MULTISUCURSAL', '0');
    defined('TABLA_MULTISUCURSAL') || define('TABLA_MULTISUCURSAL', 'local');

require_once("definitions.php");

require_once("parameters.php");

$db = DB::getInstance();
$pdo = $db->dbh;
if ($db != NULL && $db != "") {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
}
// we've writen this code where we need
session_cache_limiter(false);
@session_start();
/*******inicio de multiidiomas******/
$accept_languages = array("es", "en");
$sitelang = getenv("HTTP_ACCEPT_LANGUAGE");
$iso_lang = substr($sitelang, 0, 2);
$lang = "es";
if (!isset($_COOKIE['lg'])) {
    foreach ($accept_languages as $language)
        if ($iso_lang == $language) {
            $lang = $iso_lang;
            break;
        }
} else {
    $lang = $_COOKIE['lg'];
}
defined('APP_LANG') || define('APP_LANG', $lang);
/************** fin de multiidiomas************/
date_default_timezone_set('America/Lima');


function handle_exception($exception)
{
    echo "Ha ocurrido un problema, por favor int&eacute;ntelo m&aacute;s tarde" . $exception;
    error_log($exception->getMessage());
}

set_exception_handler('handle_exception');

?>
