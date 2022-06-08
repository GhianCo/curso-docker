<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->post('/canchaimagen','add'); 
 $app->put('/canchaimagen','update'); 
 $app->get('/canchaimagen/{id}', 'getById'); 
 $app->delete('/canchaimagen/{id}', 'delete'); 
 $app->get('/listarPorPaginacion/{busqueda}/{pagina}/{registros}', 'listarPorPaginacion'); 
 $app->get('/getAllActivos', 'getAllActivos'); 
 $app->run(); 
 
 function add($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new CanchaimagenController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->add($array));
 } 
 function update($request, $response, $args) { 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new CanchaimagenController(); 
 	$array = get_object_vars($obj); 
 	return $response->withStatus(200)->withJson($ctrl->update($array));
 } 
 function getById($request, $response, $args) { 
 	$ctrl = new CanchaimagenController(); 
 	return $response->withStatus(200)->withJson($ctrl->getById($args['id']));
 } 
 function delete($request, $response, $args) { 
 	$ctrl = new CanchaimagenController(); 
 	return $response->withStatus(200)->withJson($ctrl->delete($args['id']));
 } 
 function listarPorPaginacion($request, $response, $args) { 
 	$ctrl = new CanchaimagenController(); 
 	return $response->withStatus(200)->withJson($ctrl->listarPorPaginacion($args['busqueda'], $args['pagina'], $args['registros']));
 } 
 function getAllActivos($request, $response, $args) { 
 	$ctrl = new CanchaimagenController(); 
 	return $response->withStatus(200)->withJson($ctrl->getAllActivos()); 
 } 
 ?>