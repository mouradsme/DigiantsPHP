<?php 
// This files prepares links that you would usually find in headers and navbars,
// To create a link, use the following:
/*  $Links->select($MenuId: String)->create($MenuArray: Array)
    $MenuArray = array(
        $MenuItemId: String, 
        $MenuItemLangId: String, 
        $MenuItemClassName: String, 
        $MenuItemVisibility: Boolean, 
        $MenuItemIsAnchor: Boolean,
        $MenuItemAction: Array
    );
    Dropdowns are created as follows:
    $Links->select($TopMenuId: String)->create($MenuItem_1: Array)->create($MenuItem_N: Array) ... ;
    $Links->select($MenuItem_1_ID: String)->create(...);
    This will add Menu items as drop down for the menu item 1
    See the following example:
*/
$Links = new Links(); 
$showLink = @$_SESSION['is_admin'];
$Links->select('menu')
    ->create(array('home', 'menu.home' , 'fa fa-home', !$showLink, false))   
    ->create(array('languages', 'menu.languages' , 'fa fa-language', true, false))
    ;

$Links->select('languages')
    ->create(array('french', 'languages.french' , '', true, true, ["language", "fr_FR"]))
    ->create(array('arabic', 'languages.arabic' , '', true, true, ["language", "ar_DZ"]))
    ; 
?>