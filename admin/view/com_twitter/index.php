<?php
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;
    
    $settings   =   NEW \classes\core\settings;
    $input      =   NEW \classes\core\input;
    $tweets     =   NEW \classes\view\tweets;



    switch($action){
        case "postTweet" :
            if($input->exist()){
                $title      =   !empty($input->get("items")["title"])       ?   $input->get("items")["title"]     : NULL;
                $mension    =   !empty($input->get("items")["mension"])     ?   $input->get("items")["mension"]   : NULL;
                $tags       =   !empty($input->get("items")["tags"])        ?   $input->get("items")["tags"]      : NULL;
                $date       =   !empty($input->get("items")["date"])        ?   $input->get("items")["date"]      : NULL;
                $time       =   !empty($input->get("items")["time"])        ?   $input->get("items")["time"]      : NULL;
                $bericht    =   !empty($input->get("items")["bericht"])     ?   $input->get("items")["bericht"]   : NULL;
                
                
                //chek erroros
                
                
                
                //post database
                $postDb =   [
                    "tweetUuid" =>  "{$settings->MakeUuid()}",
                    "title"     =>  "{$title}",
                    "mension"   =>  "{$mension}",
                    "tags"      =>  "{$tags}",
                    "dates"     =>  "{$date}",
                    "settime"   =>  "{$time}",
                    "bericht"   =>  "{$bericht}",
                    "tweetdate" =>  strtotime("{$date} {$time}"),
                    "postdate"  =>  date("Y-m-d H:i:s"), //0000-00-00 00:00:00
                ];
                
                $tweets->post($postDb);
                
                
            }

            
        break;
    }
