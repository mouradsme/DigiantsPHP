<?php

    // This file initializes the TWIG loader and functions
    // You can add your own twig functions here
    // TWIG Documentation can be found online

    $loader       = new \Twig\Loader\FilesystemLoader($templateRoot);
    $twig         = new \Twig\Environment($loader, ['cache' => false]); 
    
    // Twig Custom Functions
    $reformatDate = new \Twig\TwigFunction('reformatDate', function($date, $del = '/') { 
        global $functions;
        return $functions->reformatDate($date, $del);
    });
    $twig->addFunction($reformatDate);
    
    $validate = new \Twig\TwigFunction('validate', function($valid, $invalid, $val, $filter, $min = null, $max = null) { 
        global $functions;
        return $functions->_validate($valid, $invalid, $val, $filter, $min, $max);
    });
    $twig->addFunction($validate);
    $getLang = new \Twig\TwigFunction('getLang', function($str) { 
        global $functions;
        return $functions->getLang($str);
    });
    $twig->addFunction($getLang);

?>