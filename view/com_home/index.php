<?php
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $_POST          =   json_decode(file_get_contents("php://input"), true)["0"];
    $action         =   !empty($_GET["action"]) ? $_GET["action"] : null;
    $env            = NEW \classes\core\env;

    $TwitchKeys  =   [
        "UserClientID"      =>   "gp762nuuoqcoxypju8c569th9wz7q5",
        "UserSecredCode"    =>   "cwn34ibqqc6qy6wse5e2bubt8kgb70",                   
    ];

    $twitch         =   NEW \api\twitchApi($TwitchKeys);
    
    switch($action){
        case "get_twitch":  
            $twitchData =  $twitch->channel("harritvanbeek20")->data[0]; 
            $dataArray = [
                "live"          =>  !empty($twitchData->is_live) ? "true" : "false",
                "game_name"     =>  "{$twitchData->game_name}",
                "title"         =>  "{$twitchData->title}",
            ];            

            echo json_encode($dataArray);
        break;
    }
