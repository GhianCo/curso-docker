<?php 
require '../../config.php'; 
 
$app = new SlimApp(); 
 
/** Peticiones */ 
 $app->get('/getDeportes','getDeportes');
 $app->post('/getProveedoresCerca','getProveedoresCerca');
 $app->get('/getProveedoresFavoritos','getProveedoresFavoritos');
 $app->get('/getProveedoresFavoritos/{deporte_id}','getProveedoresFavoritosByDeporte');
 $app->get('/getCuentasList','getCuentasList');
 $app->get('/getSupportList','getSupportList');
 $app->get('/getSupportListProveedor','getSupportListProveedor');

 $app->run(); 
 
 function getDeportes($request, $response, $args) {
 	$ctrl = new CommonController();
 	return $response->withStatus(200)->withJson($ctrl->getDeportes());
 }

 function getProveedoresCerca($request, $response, $args) {
 	$obj = json_decode($request->getBody());
 	$ctrl = new CommonController();
 	return $response->withStatus(200)->withJson($ctrl->getProveedoresCerca($obj));
 }

function getProveedoresFavoritos($request, $response, $args) {
    $ctrl = new CommonController();
    return $response->withStatus(200)->withJson($ctrl->getProveedoresFavoritos());
}
function getProveedoresFavoritosByDeporte($request, $response, $args) {
    $ctrl = new CommonController();
    return $response->withStatus(200)->withJson($ctrl->getProveedoresFavoritos($args["deporte_id"]));
}

function getCuentasList($request, $response, $args) {
    $ctrl = new CommonController();
    return $response->withStatus(200)->withJson($ctrl->getCuentasList());
}
function getSupportList($request, $response, $args) {
    $ctrl = new CommonController();
    return $response->withStatus(200)->withJson($ctrl->getSupportList());
}

function getSupportListProveedor($request, $response, $args) {
    $ctrl = new CommonController();
    return $response->withStatus(200)->withJson($ctrl->getSupportListProveedor());
}

 ?>