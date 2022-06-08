<?php 
define('PATH', '../../'); 
 require '../../Slim/Slim.php'; 
 require '../../config.php'; 
 $app = new Slim(); 
 $app->contentType('application/json'); 
 /** Peticiones */ 
 $app->post('/canchaprecio','add'); 
 $app->put('/canchaprecio','update'); 
 $app->get('/canchaprecio/:id', 'getById'); 
 $app->delete('/canchaprecio/:id', 'delete'); 
 $app->get('/listarPorPaginacion/:busqueda/:pagina/:registros', 'listarPorPaginacion'); 
 $app->get('/getAllActivos', 'getAllActivos'); 
 $app->run(); 
 
 function add() { 
 	$request = Slim::getInstance()->request(); 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new CanchaprecioController(); 
 	$array = get_object_vars($obj); 
 	echo json_encode($ctrl->add($array)); 
 } 
 function update() { 
 	$request = Slim::getInstance()->request(); 
 	$obj = json_decode($request->getBody()); 
 	$ctrl = new CanchaprecioController(); 
 	$array = get_object_vars($obj); 
 	echo json_encode($ctrl->update($array)); 
 } 
 function getById($id) { 
 	$ctrl = new CanchaprecioController(); 
 	echo json_encode($ctrl->getById($id)); 
 } 
 function delete($id) { 
 	$ctrl = new CanchaprecioController(); 
 	echo json_encode($ctrl->delete($id)); 
 } 
 function listarPorPaginacion($busqueda,$pagina,$registros) { 
 	$ctrl = new CanchaprecioController(); 
 	echo json_encode($ctrl->listarPorPaginacion($busqueda,$pagina,$registros)); 
 } 
 function getAllActivos() { 
 	$ctrl = new CanchaprecioController(); 
 	echo json_encode($ctrl->getAllActivos()); 
 } 
 ?>