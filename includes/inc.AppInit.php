<?php 
// The file call order is very important, please do not change it unless you know what you're doing
// Initiating the application
session_start();  // Initiating the session
require_once( 'inc.AppConfig.php' ); 
require_once( 'inc.DBConfig.php' );
require_once( 'inc.Classes.php'); 
require_once ('app/app.Settings.php');
require_once ('app/app.Links.php');
require_once ('app/app.Routes.php');
require_once ('app/app.Actions.php');
require_once ('_session_get.php');
require_once( 'inc.DBInit.php');  // Has to be after Settings initiation

// Preparing the Assets/Libs object
$Libs = new Libs("assets/lib");
// Create the route following the currently requested page (stored in the $Page variable)
$Routes->create($Page); 
// A set of variables to be loaded and passed on to the template file 
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
// If there are more variables/objects passed through the route files, then merge them with the ones above
// Note that these ones can only be used in the template file by adding the prefix "Passed." to avoid any conflicts with the ones above
if (isset($Passed))
    $load = array_merge($load, $Passed);


// The following code checkes whether the required dependencies are present,
// If not you will be asked to run "composer install" in order to install those dependencies
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