<?php

//Display de errores
ini_set("display_errors", true);
error_reporting(E_ALL);

defined("DB_HOST") || define("DB_HOST", "database");

defined("DB_NAME") || define("DB_NAME", "gocancha");

defined("DB_USERNAME") || define("DB_USERNAME", "gocanchauser");

defined("DB_PASSWORD") || define("DB_PASSWORD", "gocanchapass");

defined("DB_PORT") || define("DB_PORT", "3306");

defined("APP_NODE") || define("APP_NODE", "");

defined("LIMIT_RESULT") || define("LIMIT_RESULT", 2000);
defined("CLASS_PATH") || define("CLASS_PATH", "class");
//Variables Globales de Notificaciones
defined("SUCCESS") || define("SUCCESS", 1);
defined("WARNING") || define("WARNING", 2);
defined("ERROR") || define("ERROR", 3);
defined("INFO") || define("INFO", 4);
defined("ACTIVO") || define("ACTIVO", 1);
defined("INACTIVO") || define("INACTIVO", 0);
defined("LANG_REST") || define("LANG_REST", "ES");

?>