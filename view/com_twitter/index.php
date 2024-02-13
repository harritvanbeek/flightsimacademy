<?php

    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;
    $input      =   NEW \classes\core\input;
    $settings   =   NEW \classes\core\settings;


//Client ID : NHlTWVdLSnFSUzJKTjRfZWNiWms6MTpjaQ
//Client Secret : zZxPoQk5N_cpeBWmTvvs1_2YUnCX8IFTNGPAnTWG2Cl7xU7WyZ
//Bearer Token : AAAAAAAAAAAAAAAAAAAAAIRRsAEAAAAAQs%2FVQdZEH8Fm1RZJ8bk2BmMsp0k%3DNHnzC6oohzYmdckbETNlpWq41MH6BsLliDzAoDoyBupSfarmoE

    $twitter_settings = [
        //'oauth_access_token'        => "916382321393225728-RLirjk9VBCPo2flveQYcI6x8mxtOvEV",
        //'oauth_access_token_secret' => "wq6wogRjiUZ8o1edgNWX9zcaBmbHuUMTLESvzT4DdnlFV",
        
        'consumer_key'              => "xIJlomrau2wlKU3AvDYFrB5pn",
        'consumer_secret'           => "Arit4LBpUcQy69DEUMdNHvTu6lZltMnKWFssUegjFLFuX2NEor"
    ];
    
    
    $twitter    =   NEW \api\TwitterAPIExchange($twitter_settings);
    
    
    switch($action){
        case "latestTweet" :
            $url            = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $getfield       = '?screen_name=harritvanbeek';
            $requestMethod  = 'GET';
            $string         = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(), $assoc = TRUE);           
            //$string         = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();           
            
            /* echo "<pre>", print_r($string), "</pre>";
            die; */
            /* */
            foreach($string as $items){
                $regex = '/https?\:\/\/[^\",]+/i';
                preg_match_all($regex, $items['text'], $matches);                

                $dataArray[] = [
                    "time"      => "{$items['created_at']}",
                    "user"      => "{$items['user']['name']}",
                    "username"  => "{$items['user']['screen_name']}",
                    "folowers"  => "{$items['user']['followers_count']}",
                    "Friends"   => "{$items['user']['friends_count']}",
                    "Listed"    => "{$items['user']['listed_count']}",
                    "text"      => "{$items['text']}",
                    "link"      => "{$matches[0][0]}",
                ];
            }
                echo json_encode($dataArray); 
        break;
    }
