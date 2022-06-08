<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->post('/platform','add'); 
 $app->put('/platform','update'); 
 $app->get('/platform/{id}', 'getById'); 
 $app->delete('/platform/{id}', 'delete'); 
 $app->get('/listarPorPaginacion/{busqueda}/{pagina}/{registros}', 'listarPorPaginacion'); 
 $app->get('/getAllActivos', 'getAllActivos'); 
 $app->run(); 
 
 function add($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new PlatformController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->add($array));
 } 
 function update($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new PlatformController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->update($array));
 } 
 function getById($request, $response, $args) { 
 	$ctrl = new PlatformController(); 
 	return $response->withStatus(200)->withJson($ctrl->getById($args['id']));
 } 
 function delete($request, $response, $args) { 
 	$ctrl = new PlatformController(); 
 	return $response->withStatus(200)->withJson($ctrl->delete($args['id']));
 } 
 function listarPorPaginacion($request, $response, $args) { 
 	$ctrl = new PlatformController(); 
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['pagina'], $args['registros']));
 } 
 function getAllActivos($request, $response, $args) { 
 	$ctrl = new PlatformController(); 
 	return $response->withStatus(200)->withJson($ctrl->getAllActivos()); 
 } 
 ?>