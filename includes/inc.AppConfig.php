<?php 
$production     = false;
$database       = false;
$default_lang   = "en_EN";
$default_page   = "home";
$default_timezone = "Africa/Algiers";
$template       = "default";
$templateRoot   = "templates/$template";
$templateURL    = "./" . $templateRoot; 
$version        = $production ? "1.0" : time();
$hash           = "?v=". $version;
date_default_timezone_set($default_timezone);
?>