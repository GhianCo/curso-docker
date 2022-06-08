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
$app->get('/verificarToken/{token}', 'verificarToken');
$app->get('/deleteToken/{token}', 'deleteToken');
$app->post("/login","login");
$app->get("/enviarCodigo/{client_id}","enviarCodigo");
$app->get("/validarCodigoActivacion/{client_id}/{codigo}","validarCodigoActivacion");
$app->get('/testNotificacion/{id}/{tipo}', 'testNotificacion');


$app->run();



/**
 * FRONT-END-V2  Metodo login utilizado para la versión
 * 2 del Login Web
 */
function verificarToken($request, $response, $args) {
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->verificarToken($args['token']));
}
function deleteToken($request, $response, $args) {
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson(Security::deleteTokenByToken($args['token']));
}

function login($request, $response, $args){
    $login = json_decode($request->getBody());
    $ctrl=new ClienteController();
    $login_vector = get_object_vars($login);
    return $response->withStatus(200)->withJson($ctrl->login($login_vector));
}

function enviarCodigo($request, $response, $args){

    $ctrl=new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->enviarCodigo($args['client_id']));
}

function validarCodigoActivacion($request, $response, $args){

    $ctrl=new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->validarCodigoActivacion($args['client_id'], $args["codigo"]));
}

function testNotificacion($request, $response, $args) {
    $ctrl = new ReservaController();

    if($args['tipo'] == 1){

        return $response->withStatus(200)->withJson($ctrl->testNotificacionCliente($args['id']));

    }else{

        return $response->withStatus(200)->withJson($ctrl->testNotificacionProveedor($args['id']));

    }
}

?>
