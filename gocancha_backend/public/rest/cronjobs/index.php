<?php
require '../../../api/config.php';
/**
 * DEfino LOGIN_FORM, para poder LOGUEAR sin que me corte por no tener TOKEN y que sea RESFTULL SIN SESSION
 */
define("PUBLIC_SERVICES",true);


$app = new SlimApp();

/**
 * ROUTERS
 */
$app->get("/notificarReservaProxima","notificarReservaProxima");

$app->run();



function notificarReservaProxima($request, $response, $args){
    $ctrl=new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->notificarReservaProxima());
}



?>
