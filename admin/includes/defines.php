<?php
    $protocol   = isset($_SERVER["HTTPS"]) ? 'https' : 'http';  
    defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

    // Global definitions
    $parts      = explode(DIRECTORY_SEPARATOR, BPATH_BASE);
    
    // Defines.
    define('DS',                  DIRECTORY_SEPARATOR);
    define('BOANN_ROOT',          implode(DS, $parts));
    define('BOANN_SITE',          BOANN_ROOT);
    define('USER_IP',             $_SERVER["REMOTE_ADDR"]);
    define('BOANN_LIBRARIES',     BOANN_ROOT . DS . 'libraries');
    define('BOANN_THEMES',        BPATH_BASE . DS . 'templates');
    define('BOANN_CACHE',         BPATH_BASE . DS . 'cache');
    define('BPATH_CONFIGURATION', dirname(BPATH_BASE) . DS);
    define('SITE',                "//{$_SERVER["SERVER_NAME"]}/flightsimacademy/admin");    
    define('ASSETS',              SITE."/assets");  
    define('ADMIN_THEMES',        SITE."/templates");   
