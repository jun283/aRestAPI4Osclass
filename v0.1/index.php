<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
         //define('ABS_PATH', str_replace('\\', '/', dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])) . '/')));
 
        //require_once ABS_PATH . 'oc-load.php';   


require_once '../../oc-load.php';        
require_once '../RestServer.php';
require_once '../RestDAO.php';
require_once 'apiServer.php';


$server = new RestServer('debug');
//$server->refreshCache();

$server->addClass('apiServer');


$server->handle();

?>

