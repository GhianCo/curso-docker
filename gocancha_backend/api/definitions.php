<?php
define("SUCCESS", 1);
define("WARNING", 2);
define("ERROR", 3);
define("INFO", 4);
define("DANGER", 3);
define("NOPERMITIDO", 401);
//Sirve para habilitar las peticiones rest sin token
defined('JS2') || define('JS2', 1);
if (Security::esVersionOnline()) {
    defined('SEND_ERRORS') || define('SEND_ERRORS', true);
} else {
    defined('SEND_ERRORS') || define('SEND_ERRORS', false);
}
define("LIMIT_RESULT", 2000);
define("EMAIL_KEY", "xxxxxxxxxxxxxxx");
//Variables Globales de Notificaciones
define("ACTIVO", "1");
define("INACTIVO", 0);

/**
 * VARIABLE INDEFINIDA
 */
defined('UNDEFINED') || define('UNDEFINED', -1);
defined('REST_TODOS') || define('REST_TODOS', -1);
/**
 * CONSTANTES USADAS PARA TRAER ARREGLOS DEL SERVIDOR
 */
defined('PARAM_TODOS') || define('PARAM_TODOS', "-1");
defined('PARAM_ESTADO_TODOS') || define('PARAM_ESTADO_TODOS', "-1");
defined('PARAM_ESTADO_ACTIVO') || define('PARAM_ESTADO_ACTIVO', "1");
defined('PARAM_ESTADO_INACTIVO') || define('PARAM_ESTADO_INACTIVO', "0");
define('NO_DEFINIDO', -1);
defined('MODULO_VENTA') || define('MODULO_VENTA', 1);

defined('SI') || define('SI', '1');
defined('NO') || define('NO', '0');


/**
 * PLATFORM
 */
defined('PLATFORM_ANDROID') || define('PLATFORM_ANDROID', "ANDROID");
defined('PLATFORM_IOS') || define('PLATFORM_IOS', "IOS");


/*
 * TIPO ENVIO
 */
defined('TYPE_SEND_SMS') || define('TYPE_SEND_SMS', '1');
defined('TYPE_SEND_EMAIL') || define('TYPE_SEND_EMAIL', '2');

defined('TEXT_APLICACION') || define('TEXT_APLICACION', 'App Canchita');

/*
 * TWILIO
 */
defined('TWILIO_SID') || define('TWILIO_SID', 'AC4a388a2a36be71b7de063d32bac56ca8');
defined('TWILIO_TOKEN') || define('TWILIO_TOKEN', '794489b6cbaf7e2ff0d9274992d4dab4');
defined('TWILIO_PHONE_NUMBER') || define('TWILIO_PHONE_NUMBER', '+15595468117');

defined('GOOGLE_API_KEY') || define("GOOGLE_API_KEY", "AIzaSyBJP57TL-upWBWKfyzqDMxpxPMkP1wHUr4");


defined('TITLE_DEPORTES') || define('TITLE_DEPORTES', 'Selecciona para reservar');
defined('TITLE_CERCA_DE_TI') || define('TITLE_CERCA_DE_TI', 'Canchas deportivas cerca a ti');
defined('TITLE_FAVORITAS') || define('TITLE_FAVORITAS', 'Canchas deportivas favoritas');

/*
 * VALOR DISTANCIA DEFAUL
 */
defined('DISTANCIA_CERCANIA') || define('DISTANCIA_CERCANIA', 10);


defined('PREFIX_DEFAULT') || define('PREFIX_DEFAULT', '+51');
defined('LENGTH_PHONE_DEFAULT') || define('LENGTH_PHONE_DEFAULT', 9);

/**
 * PAISES
 */
defined('PAIS_PERU') || define('PAIS_PERU', "1");


/**
 * Tipo de pagos que aceptamos
 */
defined('PAGO_DEPOSITO') || define('PAGO_DEPOSITO', '1');
defined('PAGO_ENLINEA') || define('PAGO_ENLINEA', '2');
defined('PAGO_EFECTIVO') || define('PAGO_EFECTIVO', '3');
defined('PAGO_APP') || define('PAGO_APP', '4');
defined('PAGO_TARJETA') || define('PAGO_TARJETA', '5');
defined('PAGO_DEPOSITO_PROVEEDOR') || define('PAGO_DEPOSITO_PROVEEDOR', '6');


/**
 * Tipo de comision
 */
defined('TIPO_COMISION_PORCENTAJE') || define('TIPO_COMISION_PORCENTAJE', '1');
defined('TIPO_COMISION_MONTO') || define('TIPO_COMISION_MONTO', '2');


/**
 * Estado Reserva
 */
defined('CANCELADO') || define('CANCELADO', '0');
defined('PENDIENTE_CONFIRMAR_PAGO') || define('PENDIENTE_CONFIRMAR_PAGO', '1');
defined('APROBADA') || define('APROBADA', '2');
defined('FINALIZADA') || define('FINALIZADA', '3');


/**
 * Listado de permisos
 */
defined('USUARIO') || define('USUARIO','1');

defined('KEY_GOOGLE_MAPS') || define('KEY_GOOGLE_MAPS', 'AIzaSyBd5ERt-30qKopX6fC3cpRyoajuz8FxYMQ');

/*
 * DIAS SEMANA
 */
defined('LUNES') || define('LUNES','1');
defined('MARTES') || define('MARTES','2');
defined('MIERCOLES') || define('MIERCOLES','3');
defined('JUEVES') || define('JUEVES','4');
defined('VIERNES') || define('VIERNES','5');
defined('SABADO') || define('SABADO','6');
defined('DOMINGO') || define('DOMINGO','7');

/**
 * ID DE APLICACIONES
 */
defined('ID_APLICACION_CANCHITA') || define('ID_APLICACION_CANCHITA', 1);

defined('DISTANCE_MIN_ADDRESS') || define('DISTANCE_MIN_ADDRESS', '0.02');

defined('HORA_INICIO_FECHA') || define('HORA_INICIO_FECHA', '00:00:01');
defined('HORA_FIN_FECHA') || define('HORA_FIN_FECHA', '23:59:59');

/**
 * Tipos de notificaciones push
 */
defined('NOTIFICATION_CHANGE_STATE') || define('NOTIFICATION_CHANGE_STATE', 1);
defined('NOTIFICATION_CMD') || define('NOTIFICATION_CMD', 2);
defined('NOTIFICATION_PANEL') || define('NOTIFICATION_PANEL', 3);

defined('GOOGLE_FCM_PRODUCTION_API_KEY') || define('GOOGLE_FCM_PRODUCTION_API_KEY', 'AAAAxrCWxqA:APA91bH1mW0cpqGQy7zh2e0f10G_rP3tLfQguv4NQc1nKWnFZDSGqiGT8yJ142s5mQdc0467mPtR_QH7fF9LtdZuue3tFDumRewATMprVV4eA-a_Xr7TLBgiNDLqbQzi3bi_Gi_SWgeo');
defined('GOOGLE_FCM_PRODUCTION_API_KEY_PROVEEDOR') || define('GOOGLE_FCM_PRODUCTION_API_KEY_PROVEEDOR', 'AAAAuVaVHrY:APA91bGDCXIcm4hgnQ4x3tbBvh9O-wAbVHrKZ0DXUkOYFhSumxHOYuey2X_DYxFUJGQMM-FbTqaD9VG_hRDjoA5_RGDWnoThYGFTcsqahYij3GDnBLl3SfuXaGfUR1yGBLUrOnd300An');



/**
 * Tipos de reserva
 */
defined('TIPO_RESERVA_APP') || define('TIPO_RESERVA_APP', '1');
defined('TIPO_RESERVA_MANUAL') || define('TIPO_RESERVA_MANUAL', '2');

defined('MINUTOS_BLOQUEO') || define('MINUTOS_BLOQUEO', 5);
defined('MINUTOS_BLOQUEO_PROVEEDOR') || define('MINUTOS_BLOQUEO_PROVEEDOR', 3);

defined('ENDPOINT_NIUBIZ') || define('ENDPOINT_NIUBIZ', "https://apiprod.vnforapps.com");
defined('USERNAME_NIUBIZ') || define('USERNAME_NIUBIZ', "soporte@gocancha.com");
defined('PASSWORD_NIUBIZ') || define('PASSWORD_NIUBIZ', "?6aR1a!Q");
defined('MERCHANTID_NIUBIZ') || define('MERCHANTID_NIUBIZ', "650202525");
defined('CURRENCY_NIUBIZ') || define('CURRENCY_NIUBIZ', "PEN");

/*
 * INTEGRACIONES PAGO
 */
defined('TIPO_INTEGRACION_PAGO_NIUBIZ') || define('TIPO_INTEGRACION_PAGO_NIUBIZ', 1);


/*
 * TIPO DOCUMENTO
 */
defined('BOLETA') || define('BOLETA', "1");
defined('FACTURA') || define('FACTURA', "2");


/**
 * Tipos de reserva
 */
defined('CANAL_RESERVA_APP') || define('CANAL_RESERVA_APP', '1');
defined('CANAL_RESERVA_PRESENCIAL') || define('CANAL_RESERVA_PRESENCIAL', '2');
defined('CANAL_RESERVA_WHATSAPP') || define('CANAL_RESERVA_WHATSAPP', '3');
defined('CANAL_RESERVA_TELEFONO') || define('CANAL_RESERVA_TELEFONO', '4');
defined('CANAL_RESERVA_REDES_SOCIALES') || define('CANAL_RESERVA_REDES_SOCIALES', '5');


defined('MINUTOS_NOTIFICACION') || define('MINUTOS_NOTIFICACION', 60);

/*
 * TIPO ESTADO FACTURACION
 */
defined('FACTURACION_PENDIENTE') || define('FACTURACION_PENDIENTE', "1");
defined('FACTURACION_PAGADA') || define('FACTURACION_PAGADA', "2");


defined('CLIENTE_VISITANTE') || define('CLIENTE_VISITANTE', "2");

defined('COMISION_PAGO_EN_LINEA') || define('COMISION_PAGO_EN_LINEA', "0.0345");

?>