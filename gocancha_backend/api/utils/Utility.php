<?php

use Twilio\Rest\Client as ClientTwilio;

class Utility {

    public static $client = null;
    function __construct() {
        
    }

    public static function readTemplateFile($FileName) {
        $fp = fopen($FileName, "r") or exit("Unable to open File " . $FileName);
        $str = "";
        while (!feof($fp)) {
            $str .= fread($fp, 1024);
        }
        return $str;
    }

    public static function getStdClassByObject($d) {
        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return (object) array_map(__FUNCTION__, $d);
        } else {
            // Return object
            return $d;
        }
    }

    public static function getHoraPorDecimal($num_hours) {
        $hours = floor($num_hours);
        $mins = round(($num_hours - $hours) * 60);
        if ($mins <= 9) {
            $mins = "0" . $mins;
        }
        return $hours . ":" . $mins . ":00";
    }
    
    

    public static function getTipoMovimientoById($id) {
        switch ($id) {
            case 0:
                return "APERTURA";
                break;
            case 1:
                return "INGRESO";
                break;
            case 2:
                return "EGRESO";
                break;
            case 3:
                return "MERMA";
                break;
        }
    }

    public static function getMesFullCalendarToPhp($mes) {
        switch ($mes) {
            case 1: return 2;
                break;
            case 2: return 3;
                break;
            case 3: return 4;
                break;
            case 4: return 5;
                break;
            case 5: return 6;
                break;
            case 6: return 7;
                break;
            case 7: return 8;
                break;
            case 8: return 9;
                break;
            case 9: return 10;
                break;
            case 10: return 11;
                break;
            case 11: return 12;
                break;
            case 12: return 1;
                break;
            default: return 1;
                break;
        }
    }

    public static function getTipoMovimientoMedicamento($tipo) {
        /**
         * Introdusco el movimiento
         * 1 = Apertura
         * 2 = Venta  / Egreso 
         * 3 = Compra  / Ingreso 
         * 4 = Devolucion del cliente / Ingreso
         * 5 = Devolucion al Proovedor / Egreso
         * 6 = Actualizacion
         */
        switch($tipo){
            case 1:
                return "APERTURA";break;
            case 2:
                return "VENTA";break;
            case 3:
                return "COMPRA";break;
            case 4:
                return "DEVOLUCION";break;
            case 5:
                return "DEVOLUCION";break;
            case 6:
                return "ACTUALIZO EGRESO";break;
            case 7:
                return "ACTUALIZO INGRESO";break;
        }
    }

    public static function validaTipoTrabajadorOnlyDentistaAlumno($tipotrabajador_id) {
        switch ($tipotrabajador_id) {
            case 1:
                return 1;
            case 2:
                return 2;
            default: return 1;
        }
    }

    public static function getPrettyDate($date) {
        return date('d/m/Y', strtotime(str_replace('-', '/', $date)));
    }

    public static function getPrettyDateTime($datetime) {
        return date('d-m-Y H:i:s', strtotime(str_replace('-', '/', $datetime)));
    }

    public static function getLandscapePage($titleReport, $report_color = "#10B6F4", $type = "html", $sucursal_id = -1) {

        if ($sucursal_id == -1 || !$sucursal_id) {
            $sucursal_title = "Todas";
        } else {
            $sucursal = Sucursal::getById($sucursal_id);
            $sucursal_title = $sucursal->getSucursal_nombre();
        }

        $clinica = Clinica::getById(Security::getCurrentClinicaId());
        $logo=$clinica->getClinica_logo();
        if(!$logo)
            $logo="common/theme/images/logo.png";
        $logo_ruta = "http://" . $_SERVER["SERVER_NAME"] . "/kirudental/" . $logo;
        $retorno = '<table  style="width:100%; ">
        <tr>
            <td style="width:50%;text-align: left;">';

        if ($type != "excel") {
            $retorno.='<img style="border-width:3px;border-style:solid;border-color:' . $report_color . ';height:auto;width:200px;" src="' . $logo_ruta . '"  />';
        }
        $retorno.= '              
            </td>

            <td align="right" style="width:50%;text-align: right;" >
                <h1 style="color:' . $report_color . '">' . $titleReport . '</h1>
            </td>
        </tr>
        <tr>
            <td style="width:100%" colspan="2">

                <div style="background-color:' . $report_color . ';height:3px;width:100%"></div>
            </td>
        </tr>
        <tr>
            <td style="width:50%;text-align: left;font-style: italic; color:' . $report_color . ';">
                <b>' . "Sucursal : " . $sucursal_title . " <br>" .
                $clinica->getClinica_direccion() . '<br>
                    Telf:' . $clinica->getClinica_telefono() . '</b>
            </td>
            <td align="right" style="width:50%;text-align: right;color:' . $report_color . ';" >
                <b><i>Fecha:&nbsp;</i>' . date("d-m-Y") . '</b>
            </td>
        </tr>
    </table>       ';
        return $retorno;
    }

    public static function subirArchivo($rutaDestino)
    {
        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = "";
        if (empty($mensajes)) {
            /**
             * obtengo la ruta relativa
             */

            $rutaDestinoRelativa = str_replace("./", "", $rutaDestino);
            $rutaDestinoRelativa = str_replace(".", "", $rutaDestinoRelativa);

            /**
             * valido si el directorio existe, sino lo creo
             */
            if (!is_dir($rutaDestino)) {
                mkdir($rutaDestino, 0777, true);
            }
            if (isset($_FILES["archivo"]["error"])) {
                if ($_FILES["archivo"]["error"] > 0) {
                    /**
                     * si es mayor a 0, existe un error
                     */
                    $tipo = ERROR;
                    $mensajes[] = $_FILES["archivo"]["error"];
                } else {
                    /**
                     * obtenemos valores de la imagen
                     */
                    $nombre = strtolower($_FILES["archivo"]["name"]);
                    $type = $_FILES["archivo"]["type"];
                    $tamanio = ($_FILES["archivo"]["size"] / 1024);
                    $nombreTemporal = $_FILES["archivo"]["tmp_name"];
                    $array_explode = explode(".", $nombre);
                    $extension = end($array_explode);
                    $extensiones = array("jpg", "png", "gif", "jpeg", "bmp");
                    if (in_array($extension, $extensiones)) {
                        /**
                         * Si el archivo tiene una extension valida, procedo a mover la imagen a una ubicacion deseada
                         */
                        $nombreNuevo = md5(date("Y-h-m-i") . rand());
                        $filename_normal = $nombreNuevo . '-normal.' . $extension;
                        if (move_uploaded_file($nombreTemporal, $rutaDestino . "/" . $filename_normal)) {
                            /**
                             * Guardo la ruta de la imagen original
                             */
                            $datos = $rutaDestinoRelativa . "/" . $filename_normal;
                            /**
                             * Ahora procedo a crear los thumbnails
                             */
                            try {
                                $filename_thumb = $nombreNuevo . "-thumb." . $extension;
                                $image = new ImageResize($rutaDestino . "/" . $filename_normal);
                                $image->resizeToBestFit(400, 300);
                                $image->save($rutaDestino . "/" . $filename_thumb);
                                $datos = $rutaDestinoRelativa . "/" . $filename_thumb;


                                $filename_medium = $nombreNuevo . "-medium." . $extension;
                                $image->resizeToBestFit(1024, 768);
                                $image->save($rutaDestino . "/" . $filename_medium);
                            } catch (Exception $e) {

                            }
                        } else {
                            $tipo = ERROR;
                            $mensajes[] = "Se produjo un error moviendo el archivo";
                        }
                    } else {
                        $tipo = ERROR;
                        $mensajes[] = "El archivo tiene una extensio no permitida";
                    }
                }
            } else {
                $tipo = WARNING;
                $mensajes[] = "Debe seleccionar una imagen";
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }

    public static function sendSms($numero, $mensaje) {
        system("wget http://servicio.smsmasivos.com.ar/enviar_sms.asp?api=1&relogin=1&usuario=AGUIRRE34&clave=AGUIRRE3455&tos=" . $numero . "&texto=" . $mensaje);
    }

    function dias_transcurridos($fecha_i, $fecha_f) {
        $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }

    public static function sumarRestarDias($fecha, $dias, $operador)
    {

        if (is_string($fecha) === true)
            $fecha = strtotime($fecha);

        $fechaAnterior = strtotime($operador." " . $dias . " day", $fecha);
        $fechaAnterior = date('Y-m-d', $fechaAnterior);

        return $fechaAnterior;
    }

    public static function getCaraByLetter($letra) {
        $cara = "";
        switch ($letra) {
            case 'o':
                $cara = "Oclusal";
                break;
            case 'v':
                $cara = "Vestibular";
                break;
            case 'm':
                $cara = "Mesial";
                break;
            case 'd':
                $cara = "Distal";
                break;
            case 'p':
                $cara = "Palatina";
                break;
            case 'l':
                $cara = "Lingual";
                break;
        }
        return $cara;
    }

    /*
     * 
     */

    public static function sendErrorCatch($body) {
        if (SEND_ERRORS) {            
             self::enviarEmailError("Desarrollo", "desarrollo@portafolioitdast.com", "ERROR ".APP_NAME." " . date("Y-m-d"), "", $body, 'mailgun');
        }
    }
    public static function enviarEmailError($nombreDestinatario, $emailDestinatario, $asunto, $text_body, $html_body, $metodo,$attachments=null,$attachments_name=null) {
        $resultado = false;
        switch ($metodo) {
            case 'amazon':
                $ses = new SimpleEmailService(SES_ACCESSKEY, SES_SECRETKEY);
                $m = new SimpleEmailServiceMessage();

                $m->addTo($nombreDestinatario . ' <' . $emailDestinatario . '>');
                $m->setFrom('Sistema de Reporte de Errores <notificaciones@kirudental.com>');
                $m->setSubject($asunto);
                $m->setMessageFromString($text_body, $html_body);
                $resultado = $ses->sendEmail($m);
                break;

            case 'mailgun':
                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.mailgun.org';  // Specify main and backup server
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'postmaster@kirudental.com';                            // SMTP username
                $mail->Password = '5kb6sd19mzm0';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
                //$mail->Port       = 587;

                $mail->From = 'notificaciones@kirudental.com';
                $mail->FromName = 'Reporte de errores';
                $mail->addAddress($emailDestinatario, $nombreDestinatario);  // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('notificaciones@kirudental.com', 'KiruDental');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                //
                if($attachments!=null){
                    if($attachments_name!=null){
                        $mail->addAttachment($attachments, $attachments_name);    // Optional name
                    }
                    else{
                        $mail->addAttachment($attachments);         // Add attachments
                    }
                }
                
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $asunto;
                $mail->Body = $html_body;
                $mail->AltBody = $text_body;

                $resultado = $mail->send();
                break;
        }
        return $resultado;
    }

    public static function sendErrorEntity($e)
    {
        if (SEND_ERRORS) {
            $error_json = json_encode(array("ERROR" => $e, "MESSAGE" => $e->getMessage(), "CODE" => $e->getCode(), "FILE" => $e->getFile(), "LINE" => $e->getLine()));
            $request_json = json_encode(array("REQUEST" => $_REQUEST));
            $session_json = json_encode(array("SESSION" => $_SESSION));
            $server_json = json_encode(array("SERVER" => $_SERVER));

            $body = $error_json . "<br>" . $request_json . "<br>" . $session_json . "<br>" . $server_json;
            if(array_key_exists("HTTP_REFERER",$_SERVER)) {
                self::enviarEmailError("Ruben Sedano", "rubensedanoc@gmail.com", "ERROR " . APP_NAME . " (" . $_SERVER["HTTP_REFERER"] . ") " . date("Y-m-d H:i:s"), "", $body, 'mailgun');
            }
            else{
                self::enviarEmailError("Ruben Sedano", "rubensedanoc@gmail.com", "ERROR " . APP_NAME . " " . date("Y-m-d H:i:s"), "", $body, 'mailgun');
            }
        }
    }

    public static function enviarEmail($nombreDestinatario, $emailDestinatario, $asunto, $text_body, $html_body, $metodo,$attachments=null,$attachments_name=null) {
        $resultado = false;
        switch ($metodo) {
            case 'amazon':
                $ses = new SimpleEmailService(SES_ACCESSKEY, SES_SECRETKEY);
                $m = new SimpleEmailServiceMessage();

                $m->addTo($nombreDestinatario . ' <' . $emailDestinatario . '>');
                $m->setFrom('Listas Promotor - ITDAST PERU <notificaciones@kirudental.com>');
                $m->setSubject($asunto);
                $m->setMessageFromString($text_body, $html_body);
                $resultado = $ses->sendEmail($m);
                break;

            case 'mailgun':
                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.mailgun.org';  // Specify main and backup server
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'postmaster@kirudental.com';                            // SMTP username
                $mail->Password = '5kb6sd19mzm0';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
                //$mail->Port       = 587;

                $mail->From = 'notificaciones@kirudental.com';
                $mail->FromName = 'Listas Promotor - ITDAST PERU';
                $mail->addAddress($emailDestinatario, $nombreDestinatario);  // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('notificaciones@kirudental.com', 'KiruDental');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                //
                if($attachments!=null){
                    if($attachments_name!=null){
                        $mail->addAttachment($attachments, $attachments_name);    // Optional name
                    }
                    else{
                        $mail->addAttachment($attachments);         // Add attachments
                    }
                }
                
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $asunto;
                $mail->Body = $html_body;
                $mail->AltBody = $text_body;

                $resultado = $mail->send();
                break;
        }
        return $resultado;
    }
    
    public static function getEstadoLaboratorioPrestacion($estadoLaboratorio) {
        switch($estadoLaboratorio){
            case 1:
                return "Pendiente";break;
            case 2:
                return "En Proceso";break;
            case 3:
                return "En Revision";break;
            case 4:
                return "Finalizada";break;
        }
    }
    
    public static function getTextByEstadoTratamiento($tratamiento_estado) {
        
        if($tratamiento_estado == 0){
            return "ACTIVO";
        }else{
            return "INACTIVO";
        }
        
    }
    
    public static function getTextEstadoRealizadoPendiente($estado) {
        if($estado == 0) {
            return "Pendiente";
        }else{
            return "Realizado";
        }
        
    }

    public static function formatErrorOutput($e){
	$mensajeError = $e->getMessage();
        $error_json = json_encode(array("ERROR" => $e, "MESSAGE" => $mensajeError, "CODE" => $e->getCode(), "FILE" => $e->getFile(), "LINE" => $e->getLine()));
        $request_json = json_encode(array("REQUEST" => $_REQUEST));
        $session_json = json_encode(array("SESSION" => $_SESSION));
        $server_json = json_encode(array("SERVER" => $_SERVER));

        $body = $error_json . "<br>" . $request_json . "<br>" . $session_json . "<br>" . $server_json;

        $data = array();

        $tipo = ERROR;
        $palabraABuscar = 'PROCEDURE';

        $coincidenciasBusqueda = strstr($mensajeError, $palabraABuscar);
        if ($coincidenciasBusqueda) {
            $tipo = "501";//ERROR_PROCEDURE;
        }

        $palabraABuscar = 'checksum_UNIQUE';

        $coincidenciasBusqueda = strstr(strtolower($mensajeError), strtolower($palabraABuscar));
        if ($coincidenciasBusqueda) {
            $tipo = "501";//ERROR_PROCEDURE;
        }


        $mensajes = array();
        $datos = "";

        $mensajes[] = $body;

        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;
    }

    public static function setChecksumIfNeeded($obj, $tableName) {
        if(!isset($obj)) return;
        if(!isset($tableName) || strlen(trim($tableName)) == 0) return;

        if (!isset($obj->{strtolower($tableName) . "_checksum"}) || empty(trim($obj->{strtolower($tableName) . "_checksum"}))) {
            // setear campo
            $obj->{strtolower($tableName) . "_checksum"} = self::getUniqueChecksum();
        }
    }

    /**
     * Genera una codigo en base a local_id, caja_id, un ramdon y la fecha actual
     */
    public static function getUniqueChecksum()
    {
        return uniqid('WEB-') . "-" . round(microtime(true) * 1000);
    }
    public static function getUUID($id = ""){
        if(isset($id) && is_string($id) && $id!=""){
            //$id = str_pad($id, 10, "0", STR_PAD_LEFT);
            $id .= "-";
        }
        else{
            $id="";
        }
        return uniqid($id);
    }

    public static function getRangoHoras($start, $end)
    {
        $range = array();

        if (is_string($start) === true)
            $start = strtotime($start);
        if (is_string($end) === true)
            $end = strtotime($end);

        if ($start > $end) {
            $fechaAux = $end;
            $end = $start;
            $start = $fechaAux;
        }

        do {
            $objHora = new stdClass();

            $hora_inicio = date('H', $start);

            $objHora->horainicio = $hora_inicio.":00";

            if($hora_inicio >= 12){

                $objHora->horainicio_vista = $hora_inicio.":00 pm";

            }else{

                $objHora->horainicio_vista = $hora_inicio.":00 am";

            }

            $objHora->horafin = date('H', $start).":59";
            $range[] = $objHora;
            $start = strtotime("+ 1 hour", $start);
        } while ($start <= $end);

        return $range;
    }

    public static function getRangoFechas($fechaInicial, $fechaFinal){
        $array_salida = array();
        if($fechaInicial != null && $fechaFinal != null){

            $dateTimeFinal = new DateTime($fechaFinal);

            do {
                $obj = new stdClass();
                $dateTime = new DateTime($fechaInicial);
                $obj->fecha_value = $dateTime->format("Y-m-d");
                $dateTime->add(new DateInterval('P1D'));
                $fechaInicial = $dateTime->format("Y-m-d");


                $array_salida[]=$obj;
            } while ($dateTime < $dateTimeFinal);
        }

        return $array_salida;
    }

    public static function validarLapsoParaReporteria($f1,$f2,$lapsoDeValidacion = LAPSO_MAXIMO_PARA_REPORTERIA){

        //Validamos que las fechas tengan hora y segundo

        if(strlen($f1) == 10){
            $f1 = $f1 . " 00:00:01";
        }

        if(strlen($f2) == 10){
            $f2 = $f2 . " 23:59:59";
        }

        return Utility::obtenerDiasTranscurridos($f1, $f2) > $lapsoDeValidacion;

    }

    public static function obtenerDiasTranscurridos($fechaInicio, $fechaFin){
        return Utility::differenceMilliseconds($fechaInicio, $fechaFin)["days"];
    }

    public static function differenceMilliseconds($dateStart, $dateEnd)
    {
        $start = Utility::sqlInt($dateStart);
        $end = Utility::sqlInt($dateEnd);
        $difference = $end - $start;
        $result = array();
        $result['ms'] = $difference;
        $result['hours'] = $difference / 3600;
        $result['minutes'] = $difference / 60;
        $result['days'] = $difference / 86400;
        return $result;
    }

    public static function sqlInt($date)
    {
        $date = Utility::sqlArray($date);
        return mktime($date['hour'], $date['minutes'], 0, $date['month'], $date['day'], $date['year']);
    }

    public static function sqlArray($date, $trim = true)
    {
        $result = array();
        $result['day'] = ($trim == true) ? ltrim(substr($date, 8, 2), '0') : substr($date, 8, 2);
        $result['month'] = ($trim == true) ? ltrim(substr($date, 5, 2), '0') : substr($date, 5, 2);
        $result['year'] = substr($date, 0, 4);
        $result['hour'] = substr($date, 11, 2);
        $result['minutes'] = substr($date, 14, 2);
        return $result;
    }


    public static function obtenerDescripcionEvento($evento) {
        switch ($evento) {
            case 'purchase': return 'purchase';
                break;
            case 'add_valorization': return 'add_valorization';
                break;
            case 'click_type_business': return 'click_type_business';
                break;
            case 'add_delivery_error': return 'add_delivery_error';
                break;
            case 'coupon_to_validate': return 'coupon_to_validate';
                break;
            case 'search_item': return 'search_item';
                break;
            case 'delete_item_to_cart': return 'delete_item_to_cart';
                break;
            case 'clear_cart': return 'clear_cart';
                break;
            case 'view_search_results': return 'view_search_results';
                break;
            case 'search_item_of_establishment': return 'search_item_of_establishment';
                break;
            case 'search_empty': return 'search_empty';
                break;
            case 'click_banner': return 'click_banner';
                break;
            case 'sign_up': return 'sign_up';
                break;
            case 'click_typecard_to_pay': return 'click_typecard_to_pay';
                break;
            case 'add_delivery': return 'add_delivery';
                break;
            case 'ecommerce_purchase': return 'ecommerce_purchase';
                break;
            case 'click_way_to_pay': return 'click_way_to_pay';
                break;
            case 'add_payment_info': return 'add_payment_info';
                break;
            case 'begin_checkout': return 'begin_checkout';
                break;
            case 'add_to_cart': return 'add_to_cart';
                break;
            case 'view_item': return 'view_item';
                break;
            case 'click_product': return 'click_product';
                break;
            case 'click_product_general': return 'click_product_general';
                break;
            case 'click_type_delivery': return 'click_type_delivery';
                break;
            case 'click_establishment': return 'click_establishment';
                break;
            case 'open_app': return 'open_app';
                break;
            case 'log_out': return 'log_out';
                break;
            case 'click_navigation': return 'click_navigation';
                break;
            case 'result_establishments': return 'result_establishments';
                break;
            case 'click_type_bussines': return 'click_type_bussines';
                break;
            case 'login': return 'login';
                break;
            case 'result_typebussiness': return 'result_typebussiness';
                break;
            case 'click_sugerencia': return 'click_sugerencia';
                break;
            case 'coupon_add': return 'coupon_add';
                break;
            case 'screen_view': return 'screen_view';
                break;
            case 'open_chat': return 'open_chat';
                break;
            case 'close_chat': return 'close_chat';
                break;
            default: return "";
                break;
        }
    }

    /**
     * Quitar las comillas al inicio y al final
     * @param $texto
     * @return bool|string
     */
    public static function limpiarComillasTextoJson($texto){

        if(!Utility::stringContiene($texto,'"')){
            return $texto;
        }

        $texto = substr($texto,1);
        $texto = substr($texto,0,-1);

        return $texto;
    }

    public static function getFechaSegunFormato($fecha, $formato)
    {
        try {
            $fecha = new DateTime($fecha);
            return $fecha->format($formato);
        } catch (Exception $er) {
            return "";
        }
    }

    public static function getFechaCortaFormateadaBD($stringFecha)
    {
        if (!isset($stringFecha) || $stringFecha == null) return "";
        try {
            $date = new DateTime($stringFecha);
            return $date->format('Y-m-d');
        } catch (Exception $err) {
            return null;
        }
    }

    public static function stringContiene($string, $substring)
    {
        $string = Utility::normalizarString(mb_strtolower($string));
        $substring = Utility::normalizarString(mb_strtolower($substring));

        $contiene = false;

        if (strpos($string, $substring) !== false) {
            $contiene = true;
        }
        return $contiene;

    }

    public static function normalizarString($cadena){

        $originales  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);

    }

    public static function getFechaActual()
    {
        return date("Y-m-d");
    }

    public static function getFechaHoraActual() {
        date_default_timezone_set('America/Lima');
        return (Date("Y-m-d H:i:s"));
    }

    public static function getHoraActual() {
        date_default_timezone_set('America/Lima');
        return (Date("H:00"));
    }

    public static function addTimeToDate($stringFecha,$valor, $format = "Y-m-d H:i:s"){
        return date($format,strtotime($valor, strtotime($stringFecha)));
    }

    public static function valorEstaVacio($valor){
        return ($valor == null || $valor == "");
    }

    public static function getTextoAPP()
    {

        return TEXT_APLICACION;

    }

    public static function capture($exception)
    {
        if (Security::esVersionOnline()) {
            Sentry\configureScope(function (Sentry\State\Scope $scope): void {
                //if (Security::getToken()) {
                $scope->setExtra("VERSIONAPP", Security::getVersion());
                $scope->setExtra("PLATFORM", Security::getPlatform());
                $scope->setExtra("FECHA", Utility::getFechaHoraActual());
                $scope->setExtra("SERVER", json_encode(array("SERVER" => $_SERVER)));
                $scope->setExtra("SESSION", json_encode(array("SESSION" => $_SESSION)));
                $scope->setExtra("REQUEST", json_encode(array("REQUEST" => $_REQUEST)));
                $scope->setExtra("OBJECT", json_encode(array("OBJECT" => file_get_contents('php://input'))));
                //}
            });
            Sentry\captureException($exception);
        }
    }

    public static function enviarSMS($numero, $mensaje){
        $envio = false;
        try {
            $client = new ClientTwilio(TWILIO_SID, TWILIO_TOKEN);
            $client->messages->create(
            // Where to send a text message (your cell phone?)
                $numero,
                array(
                    'from' => TWILIO_PHONE_NUMBER,
                    'body' => $mensaje
                )
            );
            $envio = true;
        }catch (Exception $e){
            Utility::capture($e);
        }
        return $envio;
    }

    public static function peticion($url, $metodo, $body = array())
    {

        $tipo = SUCCESS;
        $mensajes = array();
        $data = array();
        $response = new stdClass();
        try {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
            ));
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);
            $response = json_decode($resp);
        } catch (Exception $e) {
            $mensajes[] = "Ups, problemas en la petición (02).";
            $tipo = ERROR;
        }

        $data["data"] = $response;
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        return $data;
    }

    public static function setLower($nombre){
        return mb_strtolower($nombre, "UTF-8");
    }

    public static function getNombreMes($mes)
    {

        $txt = "";
        switch ($mes) {
            case '01':
                $txt = "Enero";
                break;
            case '02':
                $txt = "Febrero";
                break;
            case '03':
                $txt = 'Marzo';
                break;
            case '04':
                $txt = 'Abril';
                break;
            case '05':
                $txt = 'Mayo';
                break;
            case '06':
                $txt = 'Junio';
                break;
            case '07':
                $txt = 'Julio';
                break;
            case '08':
                $txt = 'Agosto';
                break;
            case '09':
                $txt = 'Setiembre';
                break;
            case '10':
                $txt = 'Octubre';
                break;
            case '11':
                $txt = 'Noviembre';
                break;
            case '12':
                $txt = 'Diciembre';
                break;
        }
        return $txt;
    }

    public static function obtenerFechaLeible($fecha, $mostrarHoras = false)
    {

        if (!isset($fecha) || $fecha == null) return $fecha;

        try {
            $date = strtotime($fecha);

            $mes = Utility::getNombreMes(date('m', $date));
            if ($mostrarHoras) {
                return date('d', $date) . " de " . $mes . " del " . date('Y', $date) . " a las " . date('H:i:s', $date);
            } else {
                return date('d', $date) . " de " . $mes . " del " . date('Y', $date);
            }
        } catch (Exception $err) {
            return $fecha;
        }
    }

    public static function formatearNumeroSimbolo($value, $country_id = PARAM_TODOS, $sindecimales = false) {

        $symbol = Security::getCurrentSimboloMoneda();

        switch ($country_id) {

            case PAIS_PERU:

                //Por cambios en la ley de redondeo se debe usar este nuevo metodo que redondea al decimal más bajo (a favor del cliente)

                if($sindecimales){
                    return $symbol . " " . number_format($value, 0);
                }else{
                    return $symbol . " " . number_format($value, 2);
                }


            default:

                if($sindecimales){
                    return $symbol . " " . number_format($value, 0);
                }else{
                    return $symbol . " " . number_format($value, 2);
                }

        }

    }


    public static function getDescripcionTipoPagoTxt($tipopago){

        switch ($tipopago){

            case PAGO_DEPOSITO:
                return "Depósito";
                break;
            case PAGO_ENLINEA:
                return "Pago en linea";
                break;
            case PAGO_APP:
                return "App";
                break;
            case PAGO_TARJETA:
                return "Tarjeta";
                break;
            case PAGO_EFECTIVO:
                return "Efectivo";
                break;
            case PAGO_DEPOSITO_PROVEEDOR:
                return "Depósito";
                break;
        }

    }

    public static function getEstadoReservaTxt($estado){

        switch ($estado){

            case PENDIENTE_CONFIRMAR_PAGO:
                return "Confirmar Pago";
                break;
            case APROBADA:
                return "Por Pagar";
                break;
            case CANCELADO:
                return "Cancelada";
                break;
            case FINALIZADA:
                return "Pagada";
                break;
        }

    }

    public static function getTipoReservaTxt($estado){

        switch ($estado){

            case TIPO_RESERVA_APP:
                return "APP";
                break;
            case TIPO_RESERVA_MANUAL:
                return "MANUAL";
                break;
        }

    }

    public static function getTipoComisionText($tipocomision){

        switch ($tipocomision){

            case TIPO_COMISION_PORCENTAJE:
                return "%";
                break;
            case TIPO_COMISION_MONTO:
                return "S/";
                break;
        }

    }

    public static function obtenerNombreDiaSemana($day, $diacorto = NO)
    {
        $txt = "";
        switch ($day) {
            case '1':
                $txt = "Lunes";
                break;
            case '2':
                $txt = "Martes";
                break;
            case '3':
                $txt = 'Miercoles';
                break;
            case '4':
                $txt = 'Jueves';
                break;
            case '5':
                $txt = 'Viernes';
                break;
            case '6':
                $txt = 'Sabado';
                break;
            case '7':
                $txt = 'Domingo';
                break;

        }

        if($diacorto == SI){
            if(strlen($txt)>3){
                if($day == "3" || $day == "6"){
                    $txt=substr($txt,0,2);
                }else{
                    $txt=substr($txt,0,2);
                }
            }
        }


        return $txt;

    }

    public static function getObjetoFormateadoHorario($horario, $tienda_horario_salida)
    {

        foreach ($horario->horarioatencionList as $hHora) {

            if ($horario->horarioatenciondia_estado == SI) {

                $objHorario = new  stdClass();
                $objHorario->dia = Utility::obtenerNombreDiaSemana($horario->horarioatenciondia_dia, SI);
                $objHorario->dia_numero = $horario->horarioatenciondia_dia;
                $objHorario->hora_inicio = $hHora->horarioatencion_inicio;
                $objHorario->hora_fin = $hHora->horarioatencion_fin;

                if ($hHora->horarioatencion_inicio) {
                    $date = new DateTime('2000-01-01 ' . $hHora->horarioatencion_inicio);
                    $objHorario->hora_inicio = $date->format('H:i');
                }
                if ($hHora->horarioatencion_fin) {
                    $date = new DateTime('2000-01-01 ' . $hHora->horarioatencion_fin);
                    $objHorario->hora_fin = $date->format('H:i');
                }

                $tienda_horario_salida[] = $objHorario;

            }

        }

        return $tienda_horario_salida;

    }

    public static function divideTwoNumbers($dividend, $divider, $formatear = NO){
        $dividend = Utility::formatearNumeroStringToFloat($dividend);
        $divider = Utility::formatearNumeroStringToFloat($divider);
        if($divider > 0){
            $resultado = $dividend / $divider;

            if($formatear == SI){
                $resultado = Utility::formatearNumero($resultado);
            }

            return $resultado;
        }else{
            return Utility::formatearNumero(0);
        }
    }

    public static function formatearNumeroStringToFloat($num){
        return (float)preg_replace("/[^0-9.]+/", "", $num);
    }

    public static function formatearNumero($value, $country_id = PARAM_TODOS) {

        if($country_id == PARAM_TODOS){
            $country_id = Security::getCountry_id();
        }

        switch ($country_id) {

            case PAIS_PERU:

                //Por cambios en la ley de redondeo se debe usar este nuevo metodo que redondea al decimal más bajo (a favor del cliente)
                return number_format($value, 2);

            default:

                return number_format($value, 2);

        }

    }

    public static function validarEnteroPositivo($valor)
    {
        try {

            return (is_numeric($valor) && $valor * 1 > 0);

        } catch (Exception $er) {

            return false;

        }
    }

    public static function formatearHoraSinSegundos($hora, $formatinput = 'H:i'){

        if(strlen($hora) == 8){
            $formatinput = 'H:i:s';
        }

        $fecha = DateTime::createFromFormat($formatinput, $hora);

        return $fecha->format("H:i:s");

    }

    public static function horaAesMayorHorab($horaa, $horab = null, $mayorOIgual = true)
    {

        try {


            //$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
            //$fecha_entrada = strtotime("19-11-2008 21:00:00");

            $horaa = DateTime::createFromFormat('H:i', $horaa);
            $horab = DateTime::createFromFormat('H:i', $horab);

            if ($horaa > $horab) {
                return true;

            } else if ($mayorOIgual) {

                if ($horaa >= $horab) {
                    return true;

                }

            }

            return false;

        } catch (Exception $er) {
            Utility::capture($er);
        }

        return true;
    }

    public static function fechaAesMayorFechab($fechaa, $fechab = null, $mayorOIgual = true){

        try{

            if($fechab == null){
                $fechab = date("d-m-Y H:i:00");
            }

            //$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
            //$fecha_entrada = strtotime("19-11-2008 21:00:00");

            $fecha_a = strtotime(date($fechaa));
            $fecha_b = strtotime($fechab);

            if($fecha_a > $fecha_b)
            {
                return true;

            }else if($mayorOIgual){

                if($fecha_a >= $fecha_b)
                {
                    return true;

                }

            }

            return false;

        }catch (Exception $er){
            Utility::capture($er);
        }

        return true;
    }

    public static function esFechaValida($date, $format = 'Y-m-d H:i:s')
    {
        if(strlen($date)== 10){
            $format = 'Y-m-d';
        }
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function getDiaSemanaByFecha($stringFecha)
    {
        if (!isset($stringFecha) || $stringFecha == null) return "";
        try {
            $date = new DateTime($stringFecha);
            return $date->format('N');
        } catch (Exception $err) {
            return null;
        }
    }

    public static function redondearCalificacion($rating)
    {

        return round($rating, 2);

    }

    public static function getListaHoras($horario){
        $array_salida = array();
        if($horario){
            $horaInicial = $horario->horarioatencion_inicio;
            $horaFinal = $horario->horarioatencion_fin;
            $dateTimeFinal = new DateTime(date("Y-m-d")." ".$horaFinal);

            do {
                $obj = new stdClass();
                $dateTime = new DateTime(date("Y-m-d")." ".$horaInicial);
                $obj->horario_value = $dateTime->format("H:i");
                $dateTime->add(new DateInterval('PT1H'));
                $horaInicial = $dateTime->format("H:i:s");
                $obj->horario_valueend = $dateTime->format("H:i");
                $obj->horario_text = strtoupper(date("H:i", strtotime($obj->horario_value)))." a ".strtoupper($dateTime->format("H:i")) ;

                $array_salida[]=$obj;
            } while ($dateTime < $dateTimeFinal);
        }

        if(sizeof($array_salida)){
            $objHorariaFinal = end($array_salida);
            $objHorariaFinal->horario_valueend = $dateTimeFinal->format("H:i");
            $objHorariaFinal->horario_text = strtoupper(date("H:i", strtotime($objHorariaFinal->horario_value)))." a ".strtoupper($dateTimeFinal->format("H:i"));
        }

        return $array_salida;
    }

    public static function sqlFechaProgramacion($fechainicio, $fechafin){

        $sqlWhere = "";

        if($fechainicio != PARAM_TODOS && $fechafin != PARAM_TODOS){

            $fechainicio = Utility::getFechaCortaFormateadaBD($fechainicio);
            $fechafin = Utility::getFechaCortaFormateadaBD($fechafin);

            $sqlWhere.= " and reserva_fechaprogramacion >= '". $fechainicio."' and reserva_fechaprogramacion <= '". $fechafin ."' ";
        }

        return $sqlWhere;
    }

    public static function sqlFechaPagoReserva($fechainicio, $fechafin){

        $sqlWhere = "";

        if($fechainicio != PARAM_TODOS && $fechafin != PARAM_TODOS){
            $sqlWhere.= " and reservapago_fecha >= '". $fechainicio."' and reservapago_fecha <= '". $fechafin ."' ";
        }

        return $sqlWhere;
    }

    public static function sqlFechaRegistroReserva($fechainicio, $fechafin){

        $sqlWhere = "";

        if($fechainicio != PARAM_TODOS && $fechafin != PARAM_TODOS){
            $sqlWhere.= " and reserva_fecha >= '". $fechainicio."' and reserva_fecha <= '". $fechafin ."' ";
        }

        return $sqlWhere;
    }

    public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public static function getListByAtributo($atributo,$array_data){
        $array_salida = array();

        foreach ($array_data as $dato){
            $array_salida[] = $dato->{$atributo};
        }

        return $array_salida;

    }

    public static function sort($clave, $orden = null)
    {

        return function ($a, $b) use ($clave, $orden) {
            $result = ($orden == "DESC") ? strnatcmp($b->$clave, $a->$clave) : strnatcmp($a->$clave, $b->$clave);
            return $result;
        };

    }

    public static function obtenerHorasTranscurridas($fechaInicio, $fechaFin){
        return Utility::differenceMilliseconds($fechaInicio, $fechaFin)["hours"];
    }

    public static function getNombreDiaSemanaByFecha($stringFecha)
    {
        $array_dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $dia_semana = date("w", strtotime($stringFecha));
        return $array_dias[$dia_semana];
    }

    public static function getDiasSemanaByFechas($fechaInicial, $fechaFinal){
        $array_salida = array();
        if($fechaInicial != null && $fechaFinal != null){

            $dateTimeFinal = new DateTime($fechaFinal);

            do {
                $obj = new stdClass();
                $dateTime = new DateTime($fechaInicial);
                $obj->diasemana_value = Utility::getNombreDiaSemanaByFecha($dateTime->format("Y-m-d"));
                $dateTime->add(new DateInterval('P1D'));
                $fechaInicial = $dateTime->format("Y-m-d");


                $array_salida[]=$obj;
            } while ($dateTime <= $dateTimeFinal);
        }

        return $array_salida;
    }

    public static function getNombreMesCorto($fecha){
        $date = strtotime($fecha);
        $mes = Utility::getNombreMes(date('m', $date));
        if(strlen($mes)>3){
            $mes=substr($mes,0,3);
        }
        return ucfirst($mes);
    }

    public static function horaEstaDentroRango($hora, $horai, $horaf, $format = "H:i:s")
    {

        if($hora == null){
            $dTime = new DateTime();
            $hora = $dTime->format($format);
        }

        $date1 = DateTime::createFromFormat($format, $hora);
        $date2 = DateTime::createFromFormat($format, $horai);
        $date3 = DateTime::createFromFormat($format, $horaf);

        if ($date1 >= $date2 && $date1 <= $date3) {

            return true;

        }

        return false;

    }

    public static function encodeBase64($cadena){
        return base64_encode($cadena);
    }

    public static function getTimestamp(){
        $fecha = new DateTime();
        return $fecha->getTimestamp();
    }


    public static function getObjEcommerceNiubizFormated($obj){
        $objEcommerce = new stdClass();
        $objEcommerce->channel = "web";
        $objEcommerce->captureType = "manual";

        $objEcommerce->order = new stdClass();
        $objEcommerce->order->purchaseNumber = Utility::getTimestamp();
        $objEcommerce->order->amount = $obj->amount;
        $objEcommerce->order->currency = CURRENCY_NIUBIZ;

        $objEcommerce->card = new stdClass();
        $objEcommerce->card->cardNumber = $obj->cardNumber;
        $objEcommerce->card->expirationMonth = $obj->expirationMonth;
        $objEcommerce->card->expirationYear = $obj->expirationYear;
        $objEcommerce->card->cvv2 = $obj->cvv2;

        $objEcommerce->cardHolder = new stdClass();
        $objEcommerce->cardHolder->firstName = $obj->firstName;
        $objEcommerce->cardHolder->lastName = $obj->lastName;
        $objEcommerce->cardHolder->email = $obj->email;

        $objEcommerce->antifraud = new stdClass();
        $objEcommerce->antifraud->clientIp = Security::getIP();
        $objEcommerce->antifraud->merchantDefineData = new stdClass();
        $objEcommerce->antifraud->merchantDefineData->MDD4 = $obj->email;
        $objEcommerce->antifraud->merchantDefineData->MDD21 = "1";
        $objEcommerce->antifraud->merchantDefineData->MDD32 = Cliente::getIdentificadorUnico();
        $objEcommerce->antifraud->merchantDefineData->MDD75 = "REGISTRADO";
        $objEcommerce->antifraud->merchantDefineData->MDD77 = Cliente::getDiasNiubiz();

        return $objEcommerce;
    }

    public static function getDiferenciaMinutos($dateStart, $dateEnd)
    {
        try{

            if($dateEnd != null && $dateStart != null){

                $start = Utility::sqlInt($dateStart);
                $end = Utility::sqlInt($dateEnd);
                $difference = $end - $start;
                return $difference / 60;
            }

        }catch (Exception $err){
            return 0;
        }

        return 0;
    }


    public static function calcularDiferenciaHoras($obj = null, $clavehinicio = null, $clavehfin = null){
        if(isset($obj->$clavehinicio) && isset($obj->$clavehfin)){

            $horaInicio = Utility::formatearHoraSinSegundos($obj->$clavehinicio);
            $horaFin = Utility::formatearHoraSinSegundos($obj->$clavehfin);
            $fechaActual = Utility::getFechaActual();
            $fechaInicio = $fechaActual . " " . $horaInicio;
            $fechaFin = $fechaActual . " " . $horaFin;

            if(Utility::fechaAesMayorFechab($fechaInicio, $fechaFin)){
                $fechaFin = Utility::addTimeToDate($fechaFin, "1 day");
            }

            $diferenciaMinutos = Utility::getDiferenciaMinutos($fechaInicio, $fechaFin);
            $horasConvertidas = round( Utility::divideTwoNumbers($diferenciaMinutos, 60) ,2);
            return $horasConvertidas;

        }

        return 1;

    }

    public static function getTiposPagoList(){
        $tipopagoList = array();

        $tipopagoList[] = (object)array("tipopago_id"=>PAGO_DEPOSITO,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_DEPOSITO), "tipopago_total"=>0);
        $tipopagoList[] = (object)array("tipopago_id"=>PAGO_ENLINEA,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_ENLINEA), "tipopago_total"=>0);
        //$tipopagoList[] = (object)array("tipopago_id"=>PAGO_APP,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_APP), "tipopago_total"=>0);

        return $tipopagoList;
    }

    public static function getTiposPagoListProveedor(){
        $tipopagoList = array();

        $tipopagoList[] = (object)array("tipopago_id"=>PAGO_DEPOSITO_PROVEEDOR,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_DEPOSITO_PROVEEDOR));
        $tipopagoList[] = (object)array("tipopago_id"=>PAGO_TARJETA,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_TARJETA));
        $tipopagoList[] = (object)array("tipopago_id"=>PAGO_EFECTIVO,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_EFECTIVO));
        $tipopagoList[] = (object)array("tipopago_id"=>PAGO_APP,"tipopago_nombre" => Utility::getDescripcionTipoPagoTxt(PAGO_APP));

        return $tipopagoList;
    }

    public static function getDiferenciaDias($dateStart, $dateEnd)
    {
        date_default_timezone_set('America/Lima');

        if ($dateStart == null || !isset($dateStart) || $dateEnd == null || !isset($dateEnd)) {
            return "";
        }
        try {

            $dias=0;

            $dateStart = new DateTime($dateStart);
            $dateEnd = new DateTime($dateEnd);
            if ($dateEnd < $dateStart){

                $fecha = $dateEnd->diff($dateStart);
                $dias = (($fecha->y)*360+($fecha->m)*31+ ($fecha->d))*-1;

            }else if($dateEnd > $dateStart){

                $fecha = $dateStart->diff($dateEnd);
                $dias = ($fecha->y)*360+($fecha->m)*31+ ($fecha->d);
            }

            return $dias;

        } catch (Exception $err) {
            return 0;
        }
    }

    public static function getCanalesReserva($canalexcluido = REST_TODOS){

        $array_canal = array();

        $array_canal[] = (object)array("canal_id"=>CANAL_RESERVA_APP,"canal_nombre" => "APP");
        $array_canal[] = (object)array("canal_id"=>CANAL_RESERVA_PRESENCIAL,"canal_nombre" => "PRESENCIAL");
        $array_canal[] = (object)array("canal_id"=>CANAL_RESERVA_WHATSAPP,"canal_nombre" => "WHATSAPP");
        $array_canal[] = (object)array("canal_id"=>CANAL_RESERVA_TELEFONO,"canal_nombre" => "TELEFONO");
        $array_canal[] = (object)array("canal_id"=>CANAL_RESERVA_REDES_SOCIALES,"canal_nombre" => "REDES SOCIALES");

        if($canalexcluido != REST_TODOS){
            foreach ($array_canal as $index => $canal){
                if($canal->canal_id == $canalexcluido){
                    array_splice($array_canal, $index, 1);
                }
            }
        }

        return $array_canal;
    }

    public static function getCanalText($canal_id){
        $array_canal = Utility::getCanalesReserva();

        foreach ($array_canal as $canal){
            if($canal->canal_id == $canal_id){
                return $canal->canal_nombre;
            }
        }

        return null;

    }


    public static function getClient(){
        if(Utility::$client == null){
            Utility::$client = new GuzzleHttp\Client([
                'curl' => [],
            ]);
        }
        return Utility::$client;
    }


    public static function peticionClient($url, $metodo, $body=array(), $tiempoEspera = -1){

        $tipo = SUCCESS;
        $mensajes = array();
        $data = array();

        try {
            $timeout = 0;
            $connectTimeout = 30;
            if ($tiempoEspera != -1) {
                $timeout = 60;
                $connectTimeout = 30;
            }
            $body = json_encode($body);

            $headers = [
                'Content-Type'  => 'application/json',
            ];

            $client = Utility::getClient();

            if ($metodo == "POST") {
                $response = $client->post($url, [
                    'headers' => $headers,
                    "body" => $body,
                    'timeout' => $timeout, // Response timeout
                    'connect_timeout' => $connectTimeout, // Connection timeout
                ]);
                $response = $response->getBody();
            }else{
                $response = $client->request('GET', $url, ['timeout' => $timeout, 'connect_timeout' => $connectTimeout]);
                $response = $response->getBody();
            }

            $response= json_decode($response);

            if($response){
                $data["data"] = $response;
                $data["mensajes"] = $mensajes;
                $data["tipo"] = $tipo;
            }else{
                $mensajes[] = "Ups, problemas en la petición (01).";
                $tipo = ERROR;
            }





        } catch (Exception $e) {
            $mensajes[] = "Ups, problemas en la petición (02).";
            $tipo = ERROR;
            Utility::capture($e);
        }

        if($tipo == ERROR){
            $data["data"] = new stdClass();
            $data["mensajes"] = $mensajes;
            $data["tipo"] = $tipo;
        }
        return $data;
    }

    public static function getTipoComprobanteTxt($tipocomprobante){

        switch ($tipocomprobante){

            case BOLETA:
                return "BOLETA";
                break;
            case FACTURA:
                return "FACTURA";
                break;
        }

        return null;

    }

    public static function colocarAllBordesByRango($hoja,$columnaInicial,$columnaFinal,$filaInicial,$finalFinal){
        $styleArray = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $hoja->getStyle($columnaInicial.$filaInicial.":".$columnaFinal.$finalFinal)->applyFromArray($styleArray);
    }

    public static function obtenerFechaConFormato($stringFecha, $formato = "d/m/Y")
    {
        if (!isset($stringFecha) || $stringFecha == null) return "";

        try {
            $date = new DateTime($stringFecha);
            return $date->format($formato);
        } catch (Exception $err) {
            return "";
        }
    }

    public static function headerExcel($nombreArchivo,$tipoFile = "xlsx"){
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$nombreArchivo.'.'.$tipoFile.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
    }


    public static function getMesFecha($stringFecha)
    {
        if (!isset($stringFecha) || $stringFecha == null) return "";

        try {
            $date = new DateTime($stringFecha);
            $mes = $date->format("m");
            if ($mes == "1") {
                return "Enero";
            } else if ($mes == "1") {
                return "Enero";
            } else if ($mes == "2") {
                return "Febrero";
            } else if ($mes == "3") {
                return "Marzo";
            } else if ($mes == "4") {
                return "Abril";
            } else if ($mes == "5") {
                return "Mayo";
            } else if ($mes == "6") {
                return "Junio";
            } else if ($mes == "7") {
                return "Julio";
            } else if ($mes == "8") {
                return "Agosto";
            } else if ($mes == "9") {
                return "Septiembre";
            } else if ($mes == "10") {
                return "Octubre";
            } else if ($mes == "11") {
                return "Noviembre";
            } else if ($mes == "12") {
                return "Diciembre";
            } else {
                return "";
            }
        } catch (Exception $err) {
            return "";
        }
    }

    public static function primerDiaSemana($fecha){
        $month = Utility::getFechaSegunFormato($fecha, "m");
        $day = Utility::getFechaSegunFormato($fecha, "d");
        $year = Utility::getFechaSegunFormato($fecha, "Y");

        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));
        if($diaSemana==0){ $diaSemana=7; }
        $primerDia= date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        return $primerDia;
    }

    public static function ultimoDiaSemana($fecha){
        $month = Utility::getFechaSegunFormato($fecha, "m");
        $day = Utility::getFechaSegunFormato($fecha, "d");
        $year = Utility::getFechaSegunFormato($fecha, "Y");

        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));
        if($diaSemana==0){ $diaSemana=7; }
        $ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

        return $ultimoDia;
    }

    public static function alignCenterHorizontal($hoja,$columnaInicial,$columnaFinal,$filaInicial,$finalFinal){
        $hoja->getStyle($columnaInicial.$filaInicial.":".$columnaFinal.$finalFinal)->getAlignment()->setHorizontal('center');
    }

    public static function setNumberFormatExcel($hoja,$cell, $formatcode = \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1){
        $hoja->getStyle($cell)
            ->getNumberFormat()
            ->setFormatCode($formatcode);
    }



}

?>
