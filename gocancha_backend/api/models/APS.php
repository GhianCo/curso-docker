<?php

class APS
{
    // constructor
    function __construct()
    {

    }

    public static function enviarNotificacion($data, $array_dispositivos = array(), $esproveedor = NO)
    {

        if(sizeof($array_dispositivos) == 0)
            return;
        $url = "https://fcm.googleapis.com/fcm/send";


        $notification = array(
            'title' =>$data["message"] ,
            'body' => $data["messageBig"],
            'sound' => 'default',
            'badge' => '1',
            'android_channel_id' => 'fcm_channel_reservation_reminder'
        );
        $fields = array(
            'registration_ids' => $array_dispositivos,
            'notification' => $notification,
            'priority'=>'high',
            'data' => $data
        );
        $key = GOOGLE_FCM_PRODUCTION_API_KEY;

        if($esproveedor == SI){
            $key = GOOGLE_FCM_PRODUCTION_API_KEY_PROVEEDOR;
        }

        $headers = array(
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );

        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            //die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    public static function _enviarNotificacion($notificacion, $tToken)
    {
        if(APS_DEBUG)
            $tHost = 'gateway.sandbox.push.apple.com';
        else
            $tHost = 'gateway.push.apple.com';

        //$tHost = 'gateway.push.apple.com';

        $tPort = 2195;

        // Provide the Certificate and Key Data.

        $tCert = __DIR__.'/../../'.APS_PRODUCTION_CERT;

        $tPassphrase = APS_PRODUCTION_KEY;


        // Audible Notification Option.

        $tSound = 'default';


        // para hacer un log de cuanto demora en conectarse a los servidores de apple
        //$date1 = new DateTime();

        // Create the Socket Stream.

        $tContext = stream_context_create();

        stream_context_set_option($tContext, 'ssl', 'local_cert', $tCert);

        // Remove this line if you would like to enter the Private Key Passphrase manually.

        stream_context_set_option($tContext, 'ssl', 'passphrase', $tPassphrase);

        // Open the Connection to the APNS Server.

        $tSocket = stream_socket_client('ssl://' . $tHost . ':' . $tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $tContext);

        // Check if we were able to open a socket.

        if (!$tSocket) {
            exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
        }else {

            // Build the Binary Notification.
            $test = '{"tipo":3, "local_id":"1", "operacion_id":"5", "aps":{"alert":{"body":"Se anuló el pedido de Cafe Pasado de la mesa T12, por el usuario Alvaro Troncoso","title":"Anulación de pedido","action":"npm install"}
,"badge": 10,"sound":"default","mutable-content": 1,"category":"nodejs"}}';


            // The content that is returned by the LiveCode “pushNotificationReceived” message.

            $tPayload = 'APNS payload';

            // Create the message content that is to be sent to the device.

            // Create the payload body

            //Below code for non silent notification
            $objBody = new stdClass();
            $objBody->tipo = $notificacion->tipo;
            $objBody->local_id = $notificacion->local_id;
            $objBody->operacion_id = $notificacion->operacion_id;
            $objBody->notificacion_id = $notificacion->notificacion_id;

            $objAps = new stdClass();
            $objAlert = new stdClass();
            $objAlert->body = $notificacion->descripcion;
            $objAlert->title = $notificacion->titulo;
            $objAlert->action = "npm install";
            $objAps->alert = $objAlert;
            if(isset($notificacion->noleidas))
                $objAps->badge = round($notificacion->noleidas*1,0);
            $objAps->sound = "default";
            $objAps->{"mutable-content"} = "default";
            $objAps->category = $notificacion->modulo;

            $objBody->aps = $objAps;


            // Encode the body to JSON.

            $tBody = json_encode($objBody);


            $tMsg = chr(0) . chr(0) . chr(32) . pack('H*', $tToken) . pack('n', strlen($tBody)) . $tBody;

            // Send the Notification to the Server.
            $tResult = fwrite($tSocket, $tMsg, strlen($tMsg));


            if ($tResult) {

                //echo 'Delivered Message to APNS' . PHP_EOL;
                //para hacer un log de cuanto demora conectarse a los servidores de apple
                //$date2 = new DateTime();
                //$interval = $date1->diff($date2);
                //echo "-" . $interval->s + $interval->f . " mil";

            } else {

                //echo 'Could not Deliver Message to APNS' . PHP_EOL;
            }

            // Close the Connection to the Server.

            fclose($tSocket);
        }

    }
}

?>