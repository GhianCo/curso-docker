<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->post('/cancha','add'); 
 $app->put('/cancha','update'); 
 $app->get('/cancha/{id}', 'getById'); 
 $app->delete('/cancha/{id}', 'delete'); 
 $app->get('/listarPorPaginacion/{busqueda}/{proveedor_id}/{pagina}/{registros}', 'listarPorPaginacion');
 $app->get('/getAllActivos', 'getAllActivos');

 $app->post('/busquedaAvanzada', 'busquedaAvanzada');
 $app->get('/getTipos', 'getTipos');
 $app->get('/getSizes', 'getSizes');
 $app->get('/getImagenes/{id}', 'getImagenes');
 $app->get('/getHorarioAtenciaVacio', 'getHorarioAtenciaVacio');
 $app->get('/getHorarioAtencion/{id}', 'getHorarioAtencion');
 $app->get('/getInformacionCancha/{id}', 'getInformacionCancha');
$app->get('/getFiltrosCancha', 'getFiltrosCancha');
$app->post('/getCanchaList/{pagina}/{registros}', 'getCanchaList');
$app->get('/getMontoPagar/{id}', 'getMontoPagar');
$app->post('/getMontoPagar', 'getMontoPagarHora');
$app->get('/getCanchaListByParams/{proveedor_id}/{deporte_id}', 'getCanchaListByParams');
$app->post('/verificarDisponibilidad/{cancha_id}', 'verificarDisponibilidad');
$app->get('/borrarBloqueoCliente', 'borrarBloqueoCliente');
$app->get('/borrarBloqueoProveedor', 'borrarBloqueoProveedor');
$app->get('/getCanchasParaPadres/{proveedor_id}/{cancha_id}', 'getCanchasParaPadres');
$app->get('/getHorarioCanchaPrecio', 'getHorarioCanchaPrecio');
$app->get('/getHorarioCanchaPrecioByID/{id}', 'getHorarioCanchaPrecioByID');

$app->post('/getHorariosLibresPorCancha/{id}', 'getHorariosLibresPorCancha');

$app->run();
 
 function add($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new CanchaController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->add($array));
 }
function getHorariosLibresPorCancha($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getHorariosLibresPorCancha($args['id'], $obj));
}
 function update($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new CanchaController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->update($array));
 } 
 function getById($request, $response, $args) { 
 	$ctrl = new CanchaController(); 
 	return $response->withStatus(200)->withJson($ctrl->getById($args['id']));
 } 
 function delete($request, $response, $args) { 
 	$ctrl = new CanchaController(); 
 	return $response->withStatus(200)->withJson($ctrl->delete($args['id']));
 } 
 function listarPorPaginacion($request, $response, $args) { 
 	$ctrl = new CanchaController(); 
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['proveedor_id'], $args['pagina'], $args['registros']));
 } 
 function getAllActivos($request, $response, $args) { 
 	$ctrl = new CanchaController(); 
 	return $response->withStatus(200)->withJson($ctrl->getAllActivos()); 
 }
 function busquedaAvanzada($request, $response, $args) {
     $obj = json_decode($request->getBody());
     $ctrl = new CanchaController();
 	return $response->withStatus(200)->withJson($ctrl->busquedaAvanzada($obj));
 }
function getTipos($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getTipos());
}
function getSizes($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getSizes());
}
function getImagenes($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getImagenes($args['id']));
}
function getHorarioAtenciaVacio($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getHorarioAtenciaVacio());
}
function getHorarioAtencion($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getHorarioAtencion($args['id']));
}
function getInformacionCancha($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getInformacionCancha($args['id']));
}
function getFiltrosCancha($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getFiltrosCancha());
}
function getCanchaList($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getCanchaList($args['pagina'], $args['registros'], $obj));
}
function getMontoPagar($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getMontoPagar($args['id']));
}
function getMontoPagarHora($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getMontoPagar($obj));
}
function getCanchaListByParams($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getCanchaListByParams($args['proveedor_id'], $args['deporte_id']));
}
function verificarDisponibilidad($request, $response, $args) {
    $obj = json_decode($request->getBody());
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->verificarDisponibilidad($args['cancha_id'], $obj));
}
function borrarBloqueoCliente($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->borrarBloqueoCliente());
}
function borrarBloqueoProveedor($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->borrarBloqueoProveedor());
}
function getCanchasParaPadres($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getCanchasParaPadres($args['proveedor_id'], $args['cancha_id']));
}
function getHorarioCanchaPrecio($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getHorarioCanchaPrecio());
}
function getHorarioCanchaPrecioByID($request, $response, $args) {
    $ctrl = new CanchaController();
    return $response->withStatus(200)->withJson($ctrl->getHorarioCanchaPrecioByID($args['id']));
}
?>