<?php 
    return array(
        'id' => 'home',
        'route' => 'home',
        'template' => 'Home',
        'assets'   => array(
            'css' => array('main.min.css'),
            'js'  => array()
        ),
        
        'callback' => function() {
            global $Database, $Routes, $functions;
          
        }
    );
?>