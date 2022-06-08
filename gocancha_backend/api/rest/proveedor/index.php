<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->post('/proveedor','add'); 
 $app->put('/proveedor','update'); 
 $app->get('/proveedor/{id}', 'getById'); 
 $app->delete('/proveedor/{id}', 'delete'); 
 $app->get('/listarPorPaginacion/{busqueda}/{pagina}/{registros}', 'listarPorPaginacion');
 $app->get('/listarPorPaginacion/{busqueda}/{pagina}/{registros}/{todos}', 'listarPorPaginacion2');
 $app->get('/getAllActivos', 'getAllActivos');
 $app->get('/getlistaporbusqueda/{valor}', 'getlistaporbusqueda');

$app->get('/esFavorito/{proveedor_id}', "esFavorito");
$app->post('/guardarCalificacion', 'guardarCalificacion');
$app->post('/getHorariosDisponibles', 'getHorariosDisponibles');
$app->get('/getInformacion/{id}', 'getInformacion');
$app->post('/getDataDashboard/{proveedor_id}', 'getDataDashboard');
$app->post('/getClienteList', 'getClienteList');
$app->post('/agregarCancha', 'agregarCancha');
$app->post('/editarCancha', 'editarCancha');
$app->get('/getHorarioAtencion/{id}', 'getHorarioAtencion');
$app->put('/updateInformacion','updateInformacion');
$app->get('/getDetailSportplataform/{id}','getDetailSportplataform');
$app->post("/updateFCM", "updateFCM");
$app->post('/busquedaAvanzada', 'busquedaAvanzada');
$app->run();
 
 function add($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new ProveedorController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->add($array));
 } 
 function update($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new ProveedorController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->update($array));
 } 
 function getById($request, $response, $args) { 
 	$ctrl = new ProveedorController(); 
 	return $response->withStatus(200)->withJson($ctrl->getById($args['id']));
 } 
 function delete($request, $response, $args) { 
 	$ctrl = new ProveedorController(); 
 	return $response->withStatus(200)->withJson($ctrl->delete($args['id']));
 } 
 function listarPorPaginacion($request, $response, $args) { 
 	$ctrl = new ProveedorController(); 
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['pagina'], $args['registros']));
 }
 function listarPorPaginacion2($request, $response, $args) {
 	$ctrl = new ProveedorController();
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['pagina'], $args['registros'], $args["todos"]));
 }
 function getAllActivos($request, $response, $args) { 
 	$ctrl = new ProveedorController(); 
 	return $response->withStatus(200)->withJson($ctrl->getAllActivos()); 
 }
 function getlistaporbusqueda($request, $response, $args) {
 	$ctrl = new ProveedorController();
 	return $response->withStatus(200)->withJson($ctrl->getlistaporbusqueda($args['valor']));
 }
 function esFavorito($request, $response, $args) {
 	$ctrl = new ProveedorController();
 	return $response->withStatus(200)->withJson($ctrl->esFavorito($args['proveedor_id']));
 }
 function guardarCalificacion($request, $response, $args) {
     $obj = json_decode($request->getBody());
     $ctrl = new ProveedorController();
 	return $response->withStatus(200)->withJson($ctrl->guardarCalificacion($obj));
 }
 function getHorariosDisponibles($request, $response, $args) {
     $obj = json_decode($request->getBody());
     $ctrl = new ProveedorController();
 	return $response->withStatus(200)->withJson($ctrl->getHorariosDisponibles($obj));
 }
function getInformacion($request, $response, $args) {
    $ctrl = new ProveedorController();
    return $response->withStatus(200)->withJson($ctrl->getInformacion($args['id']));
}
function getDataDashboard($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ProveedorController();
    return $response->withStatus(200)->withJson($ctrl->getDataDashboard($args['proveedor_id'], $obj));
}
function getClienteList($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ProveedorController();
    return $response->withStatus(200)->withJson($ctrl->getClienteList($obj));
}
function agregarCancha($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new CanchaController();
    $array = get_object_vars($obj);
    return $response->withStatus(200)->withJson($ctrl->add($array));
}
function editarCancha($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new CanchaController();
    $array = get_object_vars($obj);
    return $response->withStatus(200)->withJson($ctrl->update($array));
}
function getHorarioAtencion($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getHorarioAtencion($args['id']));
}
function updateInformacion($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ProveedorController();
    return $response->withStatus(200)->withJson($ctrl->updateInformacion($obj));
}
function getDetailSportplataform($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getDetailSportplataform($args['id']));
}
function updateFCM($request, $response, $args){
    $obj = json_decode($request->getBody());
    $ctrl = new ProveedorController();
    $array = get_object_vars($obj);
    return $response->withStatus(200)->withJson($ctrl->updateFCM($array));
}
function busquedaAvanzada($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new ProveedorController();
    return $response->withStatus(200)->withJson($ctrl->busquedaAvanzada($obj));
}
?>