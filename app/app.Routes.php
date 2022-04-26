<?php 
// This file is for loading the application Routes from the Routes folder automatically;
// Any php file found in the folder will be treated as a Route file
 
$Routes     = new Routes([false, $default_page]);
    $Routes_dir = dirname(__FILE__ ) . "/Routes";
    $oRoutesDir = opendir($Routes_dir);
    $appRoutes = array();
    while (false !==($file = readdir($oRoutesDir))) {
        if ($file !== "." && $file !== "..") {
            $key = trim(strtolower( substr($file, 0, strripos($file, '.php'))));
            if ($key !== null && strlen($key) > 0) {
                $appRoute = include_once("Routes/" . $file);
                $Routes->add ($appRoute['route'], $appRoute['id'], $appRoute['template'], $appRoute['assets'],  $appRoute['callback'] );
            }
        }
    }
    
    
?>