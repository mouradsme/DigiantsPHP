<?php
// This file is for loading the application Actions from the Actions folder automatically;
// Any php file found in the folder will be treated as an Action file which can be called via AJAX
   
    $Actions    = new Actions();
    $Actions_dir = dirname(__FILE__ ) . "/Actions";
    $oActionsDir = opendir($Actions_dir);
    $appActions = array();
    while (false !==($file = readdir($oActionsDir))) {
        if ($file !== "." && $file !== "..") {
            $key = trim(strtolower( substr($file, 0, strripos($file, '.php'))));
            if ($key !== null && strlen($key) > 0) {
                $appAction = include_once("Actions/" . $file);
                if (!$LoggedIn) 
                    if ($appAction['action'] == "login" || $appAction['action'] == "client_login" || $appAction['action'] == "logout" )
                    $Actions->add ($appAction['action'], $appAction['callback'] );
                if ($LoggedIn)
                    $Actions->add ($appAction['action'], $appAction['callback'] );
                
            }
        }
    }
?>