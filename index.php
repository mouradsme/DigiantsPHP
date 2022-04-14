<?php 
    require_once( 'includes/inc.AppInit.php' );
    if ($vendorLoaded && $twigLoaded) {
    $template   = $twig->load('index.html')->render($load);
    // POST method is reserved for AJAX actions
    if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        echo $template;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
        $Actions->create($_POST['action']);
    } else {
        require ("check_vendors.html");
    }
?> 