<?php 
// The application default configurations
$production     = false; // Set to true for production, false for development
$database       = false; // If the app uses a database, set this to true
$default_lang   = "en_EN";  // Default Language code (Has to exist in the languages folder)
$default_page   = "home"; // The default route (Has to exist in the Routes folder)
$default_timezone = "Africa/Algiers"; // Default timezone
$template       = "default"; // Default template name (Has to exist as a directory in the templates folder)
$templateRoot   = "templates/$template"; 
$templateURL    = "./" . $templateRoot; 
$version        = $production ? "1.0" : time(); // Application version, we recommend only changing the "1.0" entry as the production progresses
$hash           = "?v=". $version;
date_default_timezone_set($default_timezone);
?>