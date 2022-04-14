<?php 
session_start(); 
require_once( 'inc.AppConfig.php' );
require_once( 'inc.DBConfig.php' );
require_once( 'inc.Classes.php'); 
require_once ('app/app.Settings.php');
require_once ('app/app.Links.php');
require_once ('app/app.Routes.php');
require_once ('app/app.Actions.php');
require_once ('_session_get.php');
require_once( 'inc.DBInit.php');  // Has to be after Settings initiation

$Libs = new Libs("assets/lib");
$Routes->create($Page); 

$load       = array( 
    "access"    => true,
    "Main"      => $Routes->getMain(),
    "Content"   => $Routes->getContent(),
    "Passed"    => $Routes->getPassed($Page),
    "Styles"    => $Routes->getStylesheets(),
    "Scripts"   => $Routes->getScripts(),
    "Settings"  => $Settings->getSettings(),
    "Links"     => $Links->getLinks(),
    "Assets"    => $Libs->getLibs(),
    "Utils"     => new Utility(),
    "Images"    => "assets/imgs/",
    "Hash"      => $hash,  
    "Template"  => $templateURL,
    "Page"      => $Page,
    "pageTitle" => $Lang['page_titles'][strtolower($Routes->getContent())],
    "L"         => $Lang

);

if (isset($Passed))
    $load = array_merge($load, $Passed);


    $vendorLoaded = false;
    $twigLoaded = false;
    if (file_exists('vendor')) {
        $vendorLoaded = true;
        require_once( 'vendor/autoload.php' );
        
        if (file_exists('vendor/twig')) {
        require_once( 'inc.TwigInit.php');
        $Loaded = get_declared_classes();
        if (in_array('Twig\Environment', $Loaded))
            $twigLoaded = true;
        }
    }
?>