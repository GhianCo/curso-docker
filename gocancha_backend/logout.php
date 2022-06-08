<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("PATH", "api/");
include_once("api/config.php");

Security::logout();
header("Location: ./");


?>
