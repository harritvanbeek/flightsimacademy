<?php
    define('_BOANN', 1);

    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;
    $input      =   NEW \classes\core\input;
    $session    =   NEW \classes\core\session;
    $setting    =   NEW \classes\core\settings;
    $discord    =   NEW \classes\core\discord;
    $_config    =   NEW \classes\core\config;
    $env        =   NEW \classes\core\env;

    $fshub      =   NEW \api\fshub;
    $vamsys     =   NEW \api\vamsys;
    //$msfsapi    =   NEW \api\msfs_api;
    
    switch($action){
        case "callsign":
            if(!empty($_GET["callsing"])){
                $jsonData   = $vamsys->map();                
                foreach($jsonData as $flight){
                    if($flight["callsign"] === $_GET["callsing"]){
                        //chek images exist
                        $ImgFolder  = dirname(dirname(dirname(__FILE__))).DS."assets".DS."wallpapers";
                        $images     = strtolower($flight["aircraft"]["registration"]).".jpg";
                        
                        if(file_exists($ImgFolder.DS.$images)){
                            $imgLocation = "./assets/wallpapers/{$images}";
                        }else{
                            $imgLocation = "./assets/wallpapers/no_images.jpg";                            
                        }

                        switch($flight["network"]){
                            case "IVAO" :
                                $network        = "IVAO";
                                $networkLink    = "https://www.ivao.aero/";
                                $networkImages  = "./assets/networks/ivao_gradient.png";
                            break;

                            case "VATSIM" :
                                $network        = "VATSIM";
                                $networkLink    = "https://vatsim.net/";
                                $networkImages  = "./assets/networks/vatsim_gradient.png";
                            break;

                            case "poscon" :
                                $network        = "poscon";
                                $networkLink    = "https://poscon.net/";
                                $networkImages  = "./assets/networks/poscon_gradient.png";
                            break;

                            case "pilotedge" :
                                $network        = "poscon";
                                $networkLink    = "https://www.pilotedge.net/";
                                $networkImages  = "./assets/networks/pilotedge_gradient.png";
                            break;

                            case "FSCloud" :
                                $network        = "FSCloud";
                                $networkLink    = "https://fsc24.org/";
                                $networkImages  = "./assets/networks/fs_cloud_gradient.png";
                            break;

                            case "Offline" :
                                $network        = "Offline";
                                $networkLink    = "";
                                $networkImages  = "./assets/networks/offline_gradient.png";
                            break;

                        }

                        $dataArray = [
                            "id"                            =>  "{$flight["id"]}",
                            "callsign"                      =>  "{$flight["callsign"]}",
                            "flight_number"                 =>  "/{$flight["flight-number"]}",
                            "route"                         =>  "{$flight["route"]}",
                            "network"                       =>  "{$flight["network"]}",
                            "networkLnk"                    =>  "{$networkLink}",
                            "networkImg"                    =>  "{$networkImages}",
                            
                            "currentLocation"   =>  [
                                "altitude"                  =>  $flight["currentLocation"]["altitude"],
                                "heading"                   =>  $flight["currentLocation"]["heading"],
                                "latitude"                  =>  "{$flight["currentLocation"]["latitude"]}",
                                "longitude"                 =>  "{$flight["currentLocation"]["longitude"]}",
                                "groundspeed"               =>  $flight["currentLocation"]["groundspeed"],
                                "distance_remaining"        =>  $flight["currentLocation"]["distance_remaining"],
                                "time_remaining"            =>  "{$flight["currentLocation"]["time_remaining"]}",
                                "distance_flown"            =>  $flight["currentLocation"]["distance_flown"],
                                "departure_time"            =>  "{$flight["currentLocation"]["departure_time"]}",
                                "estimated_arrival_time"    =>  "{$flight["currentLocation"]["estimated_arrival_time"]}",
                                "time_flown"                =>  "{$flight["currentLocation"]["time_flown"]}",
                            ],
                            
                            "aircraft"                      => [
                                "registration"              =>  "{$flight["aircraft"]["registration"]}",
                                "name"                      =>  "{$flight["aircraft"]["name"]}",
                                "code"                      =>  "{$flight["aircraft"]["code"]}",
                                "codename"                  =>  "{$flight["aircraft"]["codename"]}",
                                "images"                    =>  "{$imgLocation}",
                            ],

                            "departure" =>  [
                                "name"                      =>  "{$flight["departure"]["name"]}",
                                "icao"                      =>  "{$flight["departure"]["icao"]}",
                                "iata"                      =>  "{$flight["departure"]["iata"]}",
                                "latitude"                  =>  "{$flight["departure"]["latitude"]}",
                                "longitude"                 =>  "{$flight["departure"]["longitude"]}",
                            ],

                            "arrival"   =>  [
                                "name"                      =>  "{$flight["arrival"]["name"]}",
                                "icao"                      =>  "{$flight["arrival"]["icao"]}",
                                "iata"                      =>  "{$flight["arrival"]["iata"]}",
                                "latitude"                  =>  "{$flight["arrival"]["latitude"]}",
                                "longitude"                 =>  "{$flight["arrival"]["longitude"]}",
                            ],

                            "pilot" =>  [
                                "username"                  => "{$flight["pilot"]["username"]}"
                            ],
                        ];
                        
                    }
                }

                if($dataArray){
                    echo json_encode($dataArray);
                }
            }
        break;

        case "get_flights_json":            
            foreach($vamsys->map() as $flight){                
                $dataArray[]  = [
                    "callsign"              =>  !empty($flight["callsign"])                                   ? "{$flight["callsign"]}"                       : "N/A",
                    "flight-number"         =>  !empty($flight["flight-number"])                              ? "{$flight["flight-number"]}"                  : "N/A",
                    "heading"               =>  !empty($flight["currentLocation"]["heading"])                 ? "{$flight["currentLocation"]["heading"]}"     : "N/A",
                    "latitude"              =>  !empty($flight["currentLocation"]["latitude"])                ? "{$flight["currentLocation"]["latitude"]}"    : "N/A",
                    "longitude"             =>  !empty($flight["currentLocation"]["longitude"])               ? "{$flight["currentLocation"]["longitude"]}"   : "N/A",

                    //get flicht info
                    "registration"          =>  !empty($flight["aircraft"]["registration"])                   ? "{$flight["aircraft"]["registration"]}"      : "N/A",
                    "registration_name"     =>  !empty($flight["aircraft"]["name"])                           ? "{$flight["aircraft"]["name"]}"              : "N/A",

                    "departure_name"        =>  !empty($flight["departure"]["name"])                          ? "{$flight["departure"]["name"]}"              : "N/A",
                    "departure_icao"        =>  !empty($flight["departure"]["icao"])                          ? "{$flight["departure"]["icao"]}"              : "N/A",
                    "departure_time"        =>  !empty($flight["currentLocation"]["departure_time"])          ? "{$flight["currentLocation"]["departure_time"]}" : "N/A",

                    "arrival_name"          =>  !empty($flight["arrival"]["name"])                            ? "{$flight["arrival"]["name"]}"                : "N/A",
                    "arrival_icao"          =>  !empty($flight["arrival"]["icao"])                            ? "{$flight["arrival"]["icao"]}"                : "N/A",
                    "arrival_time"          =>  !empty($flight["currentLocation"]["estimated_arrival_time"])  ? "{$flight["currentLocation"]["estimated_arrival_time"]}" : "N/A",                                                       
                ];                    
            }
            
            echo json_encode($dataArray);

                /* if(empty($dataArray)){                  
                    $fshubID    =   2030;
                    $userdata   =   $fshub->get("airline/{$fshubID}/pilot")->data; 
                    foreach($userdata as $user)
                    {   
                        if($user->is_online > 0){
                            $dataArray[]  = [
                                "callsign"              =>  "{$user->is_online}",
                                "flight-number"         =>  "N/A",
                                "heading"               =>  "N/A",
                                "latitude"              =>  !empty($user->gps->lat)              ? "{$user->gps->lat}"        : "N/A",
                                "longitude"             =>  !empty($user->gps->lng)              ? "{$user->gps->lng}"        : "N/A",
                                
                                //get flicht info
                                "registration"          =>  "N/A",
                                "registration_name"     =>  "N/A",
                                
                                "departure_name"        =>  "N/A",
                                "departure_icao"        =>  "N/A",
                                "departure_time"        =>  "N/A",
                                
                                "arrival_name"          =>  "N/A",
                                "arrival_icao"          =>  "N/A",
                                "arrival_time"          =>  "N/A",
                            ];
                        }
                    }                     
                    
                    
                    if(empty($dataArray)){
                        $data       = file_get_contents(dirname(dirname(dirname(__file__))).DS."flight.json");
                        $jsonData   = json_decode($data, true);
                        foreach($jsonData as $flight){
                            $dataArray[]  = [
                                "callsign"              =>  !empty($flight["callsign"])                                 ? "{$flight["callsign"]}"       :  "N/A",
                                "flight-number"         =>  !empty($flight["flight-number"])                            ? "{$flight["flight-number"]}"  :  "N/A",
                                "heading"               =>  !empty($flight["currentLocation"]["heading"])               ? "{$flight["currentLocation"]["heading"]}"     : "N/A",
                                "latitude"              =>  !empty($flight["currentLocation"]["latitude"])              ? "{$flight["currentLocation"]["latitude"]}"    : "N/A",
                                "longitude"             =>  !empty($flight["currentLocation"]["longitude"])             ? "{$flight["currentLocation"]["longitude"]}"   : "N/A",
    
                                //get flicht info
                                "registration"          =>  !empty($flight["aircraft"]["registration"])                 ? "{$flight["aircraft"]["registration"]}"      : "N/A",
                                "registration_name"     =>  !empty($flight["aircraft"]["name"])                         ? "{$flight["aircraft"]["name"]}"              : "N/A",
    
                                "departure_name"        =>  !empty($flight["departure"]["name"])                        ? "{$flight["departure"]["name"]}"              : "N/A",
                                "departure_icao"        =>  !empty($flight["departure"]["icao"])                        ? "{$flight["departure"]["icao"]}"              : "N/A",
                                "departure_time"        =>  !empty($flight["currentLocation"]["departure_time"])        ? "{$flight["currentLocation"]["departure_time"]}" : "N/A",
    
                                "arrival_name"          =>  !empty($flight["arrival"]["name"])                            ? "{$flight["arrival"]["name"]}"                : "N/A",
                                "arrival_icao"          =>  !empty($flight["arrival"]["icao"])                            ? "{$flight["arrival"]["icao"]}"                : "N/A",
                                "arrival_time"          =>  !empty($flight["currentLocation"]["estimated_arrival_time"])  ? "{$flight["currentLocation"]["estimated_arrival_time"]}" : "N/A",
                            ];
                        }

                    }else{
                        echo json_encode($dataArray);
                    }

                }else{
                    echo json_encode($dataArray);
                } */
        break;


        default:
            echo "You are have no primissions for the API";
            die;
        break;
    }
