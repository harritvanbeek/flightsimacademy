<?php 
    define('_BOANN', 1);
    
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';
    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];
    
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;
    $input      =   NEW \classes\core\input;
    $session    =   NEW \classes\core\session;
    $setting    =   NEW \classes\core\settings;
    $_config    =   NEW \classes\core\config;
    
    $me         =   NEW \classes\view\accountView;
    
    switch($action){
        case "me" :
            $array  =  [
                "uuid"          =>  "{$me->me()->uuid}",
                "email"         =>  "{$me->me()->email}",                                
            ];
            echo json_encode( $array );
        break;
    }
