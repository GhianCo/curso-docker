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
$app->get('/consultarGeolocalizacion/{query}', "consultarGeolocalizacion");
$app->get("/getPlaceById/{placeID}", "getPlaceById");
$app->get("/getAddressByLocation/{latitud}/{longitud}", "getAddressByLocation");


$app->run();



/**
 * FRONT-END-V2  Metodo login utilizado para la versión
 * 2 del Login Web
 */
function consultarGeolocalizacion($request, $response, $args) {
    $ctrl = new AddressController();
    return $response->withStatus(200)->withJson($ctrl->consultarGeolocalizacion($args['query']));
}

function getPlaceById($request, $response, $args){
    $ctrl=new AddressController();
    return $response->withStatus(200)->withJson($ctrl->getPlaceById($args['placeID']));
}

function getAddressByLocation($request, $response, $args){
    $ctrl=new AddressController();
    return $response->withStatus(200)->withJson($ctrl->getAddressByLocation($args['latitud'], $args['longitud']));
}



?>
