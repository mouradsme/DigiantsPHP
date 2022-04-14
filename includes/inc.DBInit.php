<?php
if ($database) {
    $Database   = new Database($DBConfig);
    $DB_Exception = $Database-> getException() ;
    if ($DB_Exception!== null)
    die( $DB_Exception->getMessage() );
}

?>