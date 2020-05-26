<?php
//    session_start();
    define('PS', PATH_SEPARATOR);

    // Paths
    define('APP_PATH', dirname(realpath(__FILE__)));
    define('MODELS_PATH', APP_PATH ."/". 'models');
    define('VIEWS_PATH', APP_PATH ."/". 'admin_1');
    define('CONTROLLERS_PATH', APP_PATH ."/". 'controllers');
    define('PUBLIC_PATH', APP_PATH. "/". 'assets');
    

      
    // Database Connection
    $connect = mysqli_connect("localhost","root","","cafeedb");
    $path = get_include_path().PS.PUBLIC_PATH;
    set_include_path($path);
    
    // define an autoloader function 
    
    function cafeteriaLoad($className)
    {
        require_once MODELS_PATH."/".strtolower($className). '.class.php';
    }
    spl_autoload_register('cafeteriaLoad');
?>
