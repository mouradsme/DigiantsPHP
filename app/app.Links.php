<?php 
$Links = new Links(); 
$showLink = @$_SESSION['is_staff'];
$Links->select('menu')
    ->create(array('home', 'menu.home' , 'fa fa-home', !$showLink, false))   
    ->create(array('languages', 'menu.languages' , 'fa fa-language', true, false))
    ;

$Links->select('languages')
    ->create(array('french', 'languages.french' , '', true, true, ["language", "fr_FR"]))
    ->create(array('arabic', 'languages.arabic' , '', true, true, ["language", "ar_DZ"]))
    ; 
?>