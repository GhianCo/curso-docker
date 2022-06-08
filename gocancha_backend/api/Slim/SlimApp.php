<?php
class SlimApp extends Slim\App{
    function __construct($options = array())
    {
        parent::__construct($options);
        /**
         * Seguridad para ver si esta logueado un usuario
         */
        if (defined("JS2")) {
            if (JS2) {
                $seg = new Security(true);
            }
        }


    }
}
