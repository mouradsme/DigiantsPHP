<?php 
// Initiating The App Settings Instance
$Settings   = new Settings();
// Initiating The "Links" Configurations Object
// & Setting up "Links" parameters (icons & text) 
$LinksConfig = $Settings->select('links'); 
    $LinksConfig->set('icons', true)  
                ->set('text', true);

// Initiating The "Database" Configurations Object
// & Setting up "Database" parameters 
$DBConfig = $Settings->select('database'); 
    $DBConfig->set('hostname', DB_HOSTNAME)
             ->set('database', DB_DATABASE)
             ->set('username', DB_USERNAME)
             ->set('password', DB_PASSWORD);
?>