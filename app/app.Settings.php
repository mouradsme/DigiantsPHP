<?php 
$Settings   = new Settings(); 

$LinksConfig = $Settings->select('links');
    $LinksConfig->set('icons', true) 
                ->set('text', true);

$DBConfig = $Settings->select('database');
    $DBConfig->set('hostname', DB_HOSTNAME)
             ->set('database', DB_DATABASE)
             ->set('username', DB_USERNAME)
             ->set('password', DB_PASSWORD);
?>