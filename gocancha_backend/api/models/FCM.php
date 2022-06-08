<?php
class FCM
{
    // constructor
    function __construct()
    {

    }

    public static function enviarNotificacion($notificacion, $array_dispositivos = array(), $esproveedor = NO){
        if(sizeof($array_dispositivos) == 0)
            return;

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $objNotificacion = new stdClass();
        $objNotificacion->title = $notificacion["message"];
        $objNotificacion->body = $notificacion["messageBig"];
        $objNotificacion->android_channel_id = "fcm_channel_reservation_reminder";
        $objNotificacion->sound = "default";
        $objNotificacion->color = "#008B39";
        if(array_key_exists("image", $notificacion)) {
            $objNotificacion->image = $notificacion["image"];
        }

        $fields = array();
        $fields['registration_ids'] = $array_dispositivos;
        $fields['data'] = $notificacion;
        $fields['notification'] = $objNotificacion;
        $fields['priority'] = "high";

        $key = GOOGLE_FCM_PRODUCTION_API_KEY;

        if($esproveedor == SI){
            $key = GOOGLE_FCM_PRODUCTION_API_KEY_PROVEEDOR;
        }

        $headers = array(
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        //echo $result;

    }
}

?>