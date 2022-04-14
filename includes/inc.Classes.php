<?php
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