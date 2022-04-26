<?php
// This checks whether the app uses a database, (from inc.AppConfig.php file)
// If so, the database will be initialized 
if ($database) {
    $Database   = new Database($DBConfig);
    $DB_Exception = $Database-> getException() ;
    if ($DB_Exception!== null)
    die( $DB_Exception->getMessage() );
}

?>