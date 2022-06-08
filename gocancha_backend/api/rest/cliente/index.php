<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->post('/cliente','add');
$app->post('/editar/{id}','editar');
 $app->get('/cliente/{id}', 'getById'); 
 $app->delete('/cliente/{id}', 'delete'); 
 $app->get('/listarPorPaginacion/{busqueda}/{pagina}/{registros}', 'listarPorPaginacion'); 
 $app->get('/getAllActivos', 'getAllActivos');
$app->post("/updateFCM", "updateFCM");
$app->get("/getPerfil", "getPerfil");
$app->get("/getUltimaReserva", "getUltimaReserva");
$app->get("/getUltimaReservaConfirmada", "getUltimaReservaConfirmada");
$app->post("/getReservaList/{pagina}/{registros}", "getReservaList");
$app->get("/getDataReserva/{reserva_id}", "getDataReserva");
$app->post('/cancelar/{id}', 'cancelar');
$app->get('/inactivarByProveedor/{id}/{proveedor_id}', 'inactivarByProveedor');
$app->get('/activarByProveedor/{id}/{proveedor_id}', 'activarByProveedor');
$app->get('/testNotificacionCliente/{id}', 'testNotificacionCliente');
$app->get('/testNotificacionProveedor/{id}', 'testNotificacionProveedor');
 $app->run();
 
 function add($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new ClienteController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->add($array));
 }
function editar($request, $response, $args) {
    $body = $request->getBody();
    $client = json_decode($body);
    $client_vector = get_object_vars($client);
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->editar($args['id'],$client_vector));
}
 function getById($request, $response, $args) { 
 	$ctrl = new ClienteController(); 
 	return $response->withStatus(200)->withJson($ctrl->getById($args['id']));
 } 
 function delete($request, $response, $args) { 
 	$ctrl = new ClienteController(); 
 	return $response->withStatus(200)->withJson($ctrl->delete($args['id']));
 } 
 function listarPorPaginacion($request, $response, $args) { 
 	$ctrl = new ClienteController(); 
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['pagina'], $args['registros']));
 } 
 function getAllActivos($request, $response, $args) { 
 	$ctrl = new ClienteController(); 
 	return $response->withStatus(200)->withJson($ctrl->getAllActivos()); 
 }
function updateFCM($request, $response, $args){
    $obj = json_decode($request->getBody());
    $ctrl = new ClienteController();
    $array = get_object_vars($obj);
    return $response->withStatus(200)->withJson($ctrl->updateFCM($array));
}
function getPerfil($request, $response, $args){
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->getPerfil());
}
function getUltimaReserva($request, $response, $args){
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->getUltimaReserva());
}
function getUltimaReservaConfirmada($request, $response, $args){
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->getUltimaReservaConfirmada());
}
function getReservaList($request, $response, $args){
    $obj = json_decode($request->getBody());
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->getReservaList($args['pagina'], $args['registros'], $obj));
}
function getDataReserva($request, $response, $args){
    $ctrl = new ClienteController();
    return $response->withStatus(200)->withJson($ctrl->getDataReserva($args['reserva_id']));
}
function cancelar($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->cancelar($args['id'], $obj));
}
function inactivarByProveedor($request, $response, $args) {
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->inactivarByProveedor($args['id'], $args["proveedor_id"]));
}
function activarByProveedor($request, $response, $args) {
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->activarByProveedor($args['id'], $args["proveedor_id"]));
}

function testNotificacionCliente($request, $response, $args) {
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->testNotificacionCliente($args['id']));
}

function testNotificacionProveedor($request, $response, $args) {
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->testNotificacionProveedor($args['id']));
}
 ?>