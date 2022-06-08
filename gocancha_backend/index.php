<?php
define("PATH", "api/");
include_once("api/config.php");
require_once 'functions.php';

$_ROOT = "common/";

$page = isset($_GET['page']) ? $_GET['page'] : 'index';

$section = isset($_GET['section']) ? $_GET['section'] : 'index';
$sub_section = isset($_GET['ss']) ? $_GET['ss'] : 'index';

/*
* Current / default page
*/
$error_login = "";
if (isset($_POST["usuario"]) && isset($_POST["clave"])) {
    $usuario = Usuario::iniciarSesion($_POST["usuario"], ($_POST["clave"]));
    if ($usuario->getUsuario_id() > 0) {

        Security::setSession("usuario_id", $usuario->getUsuario_id());
        //establesco los permisos del usuario
        $array_permisoes=Permisousuario::getByFields(array(
            array("field"=>"usuario_id","value"=>$usuario->usuario_id,"operator"=>"="),
            array("field"=>"permisousuario_estado","value"=>"1","operator"=>"=")
        ));
        $array_permisoes=$array_permisoes["permisousuario_array"];
        $array_finalpermisoes=array();
        foreach ($array_permisoes as  $value) {
            $array_finalpermisoes[]=$value->permiso_id;
        }
        $permisos=implode("-", $array_finalpermisoes);

        Security::setSession("usuario_nombres", $usuario->usuario_nombres);
        Security::setSession("usuario_id", $usuario->getUsuario_id());
        Security::setSession("usuario_usuario", $usuario->getUsuario_usuario());
        Security::setSession("permisos",$permisos);


        if (isset($_POST["relogin"])) {
            exit("OK");
        }else{
            if (isset($_GET["continue"])) {
                header("Location: index.html");
            } else {
                header("Location: index.html");
            }
        }
    }else {
        $error_login = true;
    }
}


    /*
     * Other variables
     * Used mainly for documentation
     */
    /**
     * Incluyo mi archivo de configuracion del sistema
     */


    /*
     * Pages
     */
    $security = new Security(false);
    if (!$security->isLogged()) {
        $page = "login";
    } 
    switch ($page) {   
        case 'index':
            break;    
        case 'login':
            break;    
        case 'usuario':
            break;
        case 'proveedor':
            break;
        case 'deporte':
            break;
        case 'caracteristica':
            break;
        case 'cancha':
            break;
        case 'reserva':
            break;
        case 'loginproveedor':
            break;
        case 'informe':
            break;
        case 'facturacion':
            break;
        default :
            $page = "error-404";
            break;
    }
    // content       
    if (file_exists('pages/' . $page . '.php'))
        require_once 'pages/' . $page . '.php';
    require_once 'logger.php';