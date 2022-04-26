<?php

// This file is for loading the application Classes from the Classes folder automatically;
// Any .class.php file found in the folder will be treated as an Class file which can be called via AJAX
   
$Classes_dir =  dirname(__FILE__ ) . "/Classes";
$oClassesDir = opendir($Classes_dir);
$Classes = array();
while (false !==($file = readdir($oClassesDir))) {
    if ($file !== "." && $file !== "..") {
        $key = trim(strtolower( substr($file, 0, strripos($file, '.class.php'))));
        if ($key !== null && strlen($key) > 0) $Classes[$key] = $file;
    }
}
foreach($Classes as $key => $Class) 
    require_once("Classes/" . $Class);
?>