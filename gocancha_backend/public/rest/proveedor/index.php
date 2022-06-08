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
$app->post("/login","login");
$app->get('/generarFacturacionSistema', 'generarFacturacionSistema');

$app->run();



function login($request, $response, $args){
    $login = json_decode($request->getBody());
    $ctrl=new LoginController();
    $login_vector = get_object_vars($login);
    return $response->withStatus(200)->withJson($ctrl->login($login_vector));
}
function generarFacturacionSistema($request, $response, $args) {
    $ctrl = new FacturacionController();
    return $response->withStatus(200)->withJson($ctrl->generarFacturacionSistema());
}


?>
