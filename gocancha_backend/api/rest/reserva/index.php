<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->post('/reserva','add'); 
 $app->put('/reserva','update'); 
 $app->get('/reserva/{id}', 'getById'); 
 $app->delete('/reserva/{id}', 'delete'); 
 $app->get('/listarPorPaginacion/{busqueda}/{pagina}/{registros}', 'listarPorPaginacion'); 
 $app->get('/getAllActivos', 'getAllActivos'); 
 $app->post('/reservasPanelPaginado/{pagina}/{registros}/{fechaReserva}', 'reservasPanelPaginado');
$app->post('/aprobar/{id}', 'aprobar');
$app->post('/rechazar/{id}', 'rechazar');
$app->post('/registrar/{cancha_id}', 'registrar');
$app->post('/registrarManual/{cancha_id}', 'registrarManual');
$app->post('/dataDashboard', 'dataDashboard');
$app->get('/getFiltrosReserva', 'getFiltrosReserva');
$app->post('/reservaListProveedor/{proveedor_id}/{pagina}/{registros}', 'reservaListProveedor');
$app->post('/getDataSessionNiubiz', 'getDataSessionNiubiz');
$app->post('/ecommerceNiubiz', 'ecommerceNiubiz');
$app->post('/finalizar', 'finalizar');
$app->get('/getCanalesReservaManual', 'getCanalesReservaManual');
$app->run();
 
 function add($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new ReservaController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->add($array));
 } 
 function update($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new ReservaController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->update($array));
 } 
 function getById($request, $response, $args) { 
 	$ctrl = new ReservaController(); 
 	return $response->withStatus(200)->withJson($ctrl->getById($args['id']));
 } 
 function delete($request, $response, $args) { 
 	$ctrl = new ReservaController(); 
 	return $response->withStatus(200)->withJson($ctrl->delete($args['id']));
 } 
 function listarPorPaginacion($request, $response, $args) { 
 	$ctrl = new ReservaController(); 
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['pagina'], $args['registros']));
 } 
 function getAllActivos($request, $response, $args) { 
 	$ctrl = new ReservaController(); 
 	return $response->withStatus(200)->withJson($ctrl->getAllActivos()); 
 }
 function reservasPanelPaginado($request, $response, $args) {
     $obj = json_decode($request->getBody());
     $ctrl = new ReservaController();
 	return $response->withStatus(200)->withJson($ctrl->reservasPanelPaginado($args['pagina'], $args['registros'],$args['fechaReserva'],$obj));
 }

function aprobar($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->aprobar($args['id'], $obj));
}
function rechazar($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->rechazar($args['id'], $obj));
}
function registrar($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->registrar($args['cancha_id'], $obj));
}
function registrarManual($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->registrarManual($args['cancha_id'], $obj));
}
function dataDashboard($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->dataDashboard($obj));
}
function getFiltrosReserva($request, $response, $args) {
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->getFiltrosReserva());
}
function reservaListProveedor($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->reservaListProveedor($args['proveedor_id'], $args['pagina'], $args['registros'], $obj));
}
function getDataSessionNiubiz($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->getDataSessionNiubiz($obj));
}
function ecommerceNiubiz($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->ecommerceNiubiz($obj));
}

function finalizar($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->finalizar($obj));
}

function getCanalesReservaManual($request, $response, $args) {
    $ctrl = new ReservaController();
    return $response->withStatus(200)->withJson($ctrl->getCanalesReservaManual());
}
 ?>