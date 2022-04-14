<?php
$Page = @$_GET['page']; 
$Language = @$_SESSION['lang'];
if (!isset($Language) || $Language == "" || $Language == null)
    $_SESSION['lang'] = $default_lang;
$Language = @$_SESSION['lang'];
require_once( "languages/$Language.php" );
?>