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



    //$login      =   NEW \classes\view\login;
    $fshub      =   NEW \api\fshub;
    $msfsapi    =   NEW \api\msfs_api;


    switch($action){
        case "callsign":
            if(!empty($_GET["callsing"])){
                $data       = file_get_contents("https://vamsys.io/statistics/map/0b59fc36-c9c9-4bbf-a431-6b66e8f23cea");
                $jsonData   = json_decode($data, true);
                foreach($jsonData as $flight){
                    if($flight["callsign"] === $_GET["callsing"]){
                        //chek images exist
                        $ImgFolder  = dirname(dirname(dirname(__FILE__))).DS."flightsim-academy".DS."assets".DS."wallpapers";
                        $images     = strtolower($flight["aircraft"]["registration"]).".jpg";
                        
                        if(file_exists($ImgFolder.DS.$images)){
                            $imgLocation = "./flightsim-academy/assets/wallpapers/{$images}";
                        }else{
                            $imgLocation = "./flightsim-academy/assets/wallpapers/no_images.jpg";
                            //$imgLocation = "https://www.boann.eu/flightsim-academy/assets/wallpapers/no_images.jpg";
                            //"no_images.jpg";
                        }


                        switch($flight["network"]){
                            case "IVAO" :
                                $network        = "IVAO";
                                $networkLink    = "https://www.ivao.aero/";
                                $networkImages  = "./flightsim-academy/assets/networks/ivao_gradient.png";
                            break;

                            case "VATSIM" :
                                $network        = "VATSIM";
                                $networkLink    = "https://vatsim.net/";
                                $networkImages  = "./flightsim-academy/assets/networks/vatsim_gradient.png";
                            break;

                            case "poscon" :
                                $network        = "poscon";
                                $networkLink    = "https://poscon.net/";
                                $networkImages  = "./flightsim-academy/assets/networks/poscon_gradient.png";
                            break;

                            case "pilotedge" :
                                $network        = "poscon";
                                $networkLink    = "https://www.pilotedge.net/";
                                $networkImages  = "./flightsim-academy/assets/networks/pilotedge_gradient.png";
                            break;

                            case "FSCloud" :
                                $network        = "FSCloud";
                                $networkLink    = "https://fsc24.org/";
                                $networkImages  = "./flightsim-academy/assets/networks/fs_cloud_gradient.png";
                            break;

                            case "Offline" :
                                $network        = "Offline";
                                $networkLink    = "";
                                $networkImages  = "./flightsim-academy/assets/networks/offline_gradient.png";
                            break;

                        }

                        $dataArray = [
                            "id"                    =>  "{$flight["id"]}",
                            "callsign"              =>  "{$flight["callsign"]}",
                            "flight_number"         =>  "/{$flight["flight-number"]}",
                            "route"                 =>  "{$flight["route"]}",
                            "network"               =>  "{$flight["network"]}",
                            "networkLnk"            =>  "{$networkLink}",
                            "networkImg"            =>  "{$networkImages}",
                            
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
            $data       = file_get_contents("https://vamsys.io/statistics/map/0b59fc36-c9c9-4bbf-a431-6b66e8f23cea");
            $jsonData   = json_decode($data, true);

            foreach($jsonData as $flight){

                $dataArray[]  = [
                    "callsign"              =>  !empty($flight["callsign"])                      ? "{$flight["callsign"]}"       :  "N/A",
                    "flight-number"         =>  !empty($flight["flight-number"])                 ? "{$flight["flight-number"]}"  :  "N/A",
                    "heading"               =>  !empty($flight["currentLocation"]["heading"])    ? "{$flight["currentLocation"]["heading"]}"     : "N/A",
                    "latitude"              =>  !empty($flight["currentLocation"]["latitude"])   ? "{$flight["currentLocation"]["latitude"]}"    : "N/A",
                    "longitude"             =>  !empty($flight["currentLocation"]["longitude"])  ? "{$flight["currentLocation"]["longitude"]}"   : "N/A",

                    /*get flicht info*/
                    "registration"          =>  !empty($flight["aircraft"]["registration"])       ? "{$flight["aircraft"]["registration"]}"      : "N/A",
                    "registration_name"     =>  !empty($flight["aircraft"]["name"])               ? "{$flight["aircraft"]["name"]}"              : "N/A",

                    "departure_name"        =>  !empty($flight["departure"]["name"])              ? "{$flight["departure"]["name"]}"              : "N/A",
                    "departure_icao"        =>  !empty($flight["departure"]["icao"])              ? "{$flight["departure"]["icao"]}"              : "N/A",
                    "departure_time"        =>  !empty($flight["currentLocation"]["departure_time"])  ? "{$flight["currentLocation"]["departure_time"]}" : "N/A",

                    "arrival_name"          =>  !empty($flight["arrival"]["name"])                ? "{$flight["arrival"]["name"]}"                : "N/A",
                    "arrival_icao"          =>  !empty($flight["arrival"]["icao"])                ? "{$flight["arrival"]["icao"]}"                : "N/A",
                    "arrival_time"          =>  !empty($flight["currentLocation"]["estimated_arrival_time"])  ? "{$flight["currentLocation"]["estimated_arrival_time"]}" : "N/A",



                    /*
                    "groupname"             => "test",
                    "aircraftType"          => "test",

                    "notes"                 => "test",

                    "latitude_formatted"    => "test",
                    "longitude_formatted"   => "test",
                    "heading_formatted"     => "test",
                    "altitude_formatted"    => "test",

                    "airspeed"              =>  "test",
                    "groundspeed"           =>  "test",
                    "TouchdownVelocity"     =>  "test",*/

                ];
            }

                if(empty($dataArray)){                  
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
                }

        break;

        case "get_flights":
                //post in database
                foreach($msfsapi->getFlights() as $data){
                    //debug($data);
                    $dataArray[] = [
                        "callsign"              =>  !empty($data->callsign)          ? "{$data->callsign}"       :  "N/A",
                        "pilotname"             =>  !empty($data->pilotName)         ? "{$data->pilotName}"      :  "N/A",
                        "groupname"             =>  !empty($data->groupName)         ? "{$data->groupName}"      :  "N/A",
                        "aircraftType"          =>  !empty($data->aircraftType)      ? "{$data->aircraftType}"   :  "N/A",

                        "latitude"              =>  !empty($data->latitude)          ? "{$data->latitude}"       : "N/A",
                        "longitude"             =>  !empty($data->longitude)         ? "{$data->longitude}"      : "N/A",
                        "heading"               =>  !empty($data->heading)           ? "{$data->heading}"        : "N/A",
                        "notes"                 =>  !empty($data->notes)             ? "{$data->notes}"          : "N/A",

                        "latitude_formatted"    =>  !empty($data->latitude)          ? number_format("{$data->latitude}", 4 )                        : "N/A", //53.1522
                        "longitude_formatted"   =>  !empty($data->longitude)         ? number_format("{$data->longitude}", 4)                        : "N/A",
                        "heading_formatted"     =>  !empty($data->heading)           ? number_format("{$data->heading}",0,".","")                    : "N/A",
                        "altitude_formatted"    =>  !empty($data->altitude)          ? number_format("{$data->altitude}",0,".","")                   : "N/A",

                        "airspeed"              =>  !empty($data->airspeed)          ? number_format("{$data->airspeed}",0,".","")                   : "N/A",
                        "groundspeed"           =>  !empty($data->groundspeed)       ? number_format("{$data->groundspeed}",0,".","")                : "N/A",
                        "TouchdownVelocity"     =>  !empty($data->touchdownVelocity) ? $data->touchdownVelocity    : "N/A",
                    ];

                    //landing rate
                    if($data->touchdownVelocity > 0){
                       $url     = "https://discord.com/api/webhooks/1051566076237987961/7VTrdpeXC8b2xEBRePApNny1bGG3BXsInfJjfSUVX5MnWU9xx-OwXcqrbo0YzoFaGG_Q";
                       //"2018-03-10T19:15:45-05:00"
                       $datum   = date("Y-m-d");

                       //start location
                       $startLocation   = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng={$_SESSION["latitude"]},{$_SESSION["longitude"]}&sensor=true&key=AIzaSyBGdQKFcGLHXAJvXxQwrMRAdOMkIqDM_mU");
                       $startcomponents = json_decode($startLocation)->results[0]->address_components;
                       $depatre         = "{$startcomponents["1"]->long_name} {$startcomponents["2"]->long_name}";

                       //end location
                       $endLocation    = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng={$data->latitude},{$data->longitude}&sensor=true&key=AIzaSyBGdQKFcGLHXAJvXxQwrMRAdOMkIqDM_mU");
                       $endcomponents  = json_decode($endLocation)->results[0]->address_components;
                       $arivle         = "{$endcomponents["1"]->long_name} {$endcomponents["2"]->long_name}";

                       $data    = [
                            "embeds" => [
                                [
                                "type"        => "rich",
                                "title"       => "Flicht Simulator",
                                "description" => "Lading Rate : {$data->touchdownVelocity} ft/min",
                                "timestamp"   =>  $datum,
                                "color" => hexdec( "FFFFFF" ),
                                "footer" => [
                                    "text" => "https://www.boann.eu",
                                ],

                                "fields" => [
                                        [
                                            "name" => "From",
                                            "value" => "{$depatre}",
                                            "inline" => true
                                        ],
                                        [
                                            "name" => "To",
                                            "value" => "{$arivle}",
                                            "inline" => true
                                        ],
                                    ]
                                ],
                            ]
                        ];

                       $discord->post($url, $data);
                    }
                }

                echo json_encode($dataArray);

                //delete
                //$msfsapi->deleteDatabase();
        break;

        case "send":
            //chek post is not empty
            if(!empty($input->exist())){


                if(!empty($input->get("callsign")) AND !empty($input->get("pilotName")) AND !empty($input->get("groupName"))){

                    //chek user exist in database;
                    //if($login->callSignExist($input->get("callsign")) > 0){
                        // default groundspeed to airspeed if it is not supplied
                        //if ($groundspeed == "0") $groundspeed = $airspeed;

                        $touchdownVelocity  =   explode(".", $input->get("touchdownVelocity") * 60)[0];
                        $postData   =   [
                            "callsign"          => "{$input->get("callsign")}",
                            "pilotName"         => "{$input->get("pilotName")}",
                            "groupName"         => "{$input->get("groupName")}",
                            "aircraftType"      => !empty($input->get("aircraftType"))       ?  "{$input->get("aircraftType")}"       :   null,

                            "latitude"          => !empty($input->get("latitude"))           ?  "{$input->get("latitude")}"           :   "0",
                            "longitude"         => !empty($input->get("longitude"))          ?  "{$input->get("longitude")}"          :   "0",

                            "altitude"          => !empty($input->get("altitude"))           ?  "{$input->get("altitude")}"           :   "0",
                            "heading"           => !empty($input->get("heading"))            ?  "{$input->get("heading")}"            :   "0",

                            "airspeed"          => !empty($input->get("airspeed"))           ?  "{$input->get("airspeed")}"           :   "0",
                            "groundspeed"       => !empty($input->get("groundspeed"))        ?  "{$input->get("groundspeed")}"        :   "0",
                            "touchdownVelocity" => !empty($input->get("touchdownVelocity"))  ?  "{$touchdownVelocity}"  :   "0",

                            "notes"             => !empty($input->get("notes"))              ?  "{$input->get("notes")}"              :   null,

                            "version"           => !empty($input->get("version"))            ?  "{$input->get("version")}"            :   "",
                            "ipAddress"         => USER_IP,
                        ];

                        //chek session
                        if(empty($_SESSION["latitude"]) and empty($_SESSION["longitude"])){
                            $_SESSION["latitude"]   =   $data->latitude;
                            $_SESSION["longitude"]  =   $data->longitude;
                        }


                        //post in database
                        $msfsapi->postDatabase($postData);


                        //post to discord

                        //delete
                        //$msfsapi->deleteDatabase();


                   /* }else{
                        echo "You are on the rong airport";
                        die;
                    }*/
                }
            }else{
                //rederect
                echo "You are on the rong airport";
                die;
            }
        break;


        default:
            echo "You are have no primissions for the API";
            die;
        break;
    }

function DECtoDMS($dec)
{

  // Converts decimal longitude / latitude to DMS
  // ( Degrees / minutes / seconds )

  // This is the piece of code which may appear to
  // be inefficient, but to avoid issues with floating
  // point math we extract the integer part and the float
  // part by using a string function.

  if ($dec<>0){

    $vars = explode(".",$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
  } else {
    return array("deg"=>0,"min"=>0,"sec"=>0);
  }
}

function debug_log($data = ""){
    if(!empty($data)){
        $GetData        =   $data;
    }else{
        $GetData        =   !empty($_POST) ? $_POST : $_GET;
    }
    $file = DIRNAME(__FILE__).DIRECTORY_SEPARATOR."logfiles".DIRECTORY_SEPARATOR."msfs.log";

    if( file_exists($file) ){
        unlink($file);
    }

    $data       = "\n\n########## ".date("d.m.Y H:i:s")." ##########\n";
    $zeile      = var_export($GetData,TRUE);
    $logfile    = $file;
    $handle     = fopen($logfile,"a+");
    $logzeile   = $data.$zeile."\n\n";
    fputs($handle,$logzeile);
    fclose($handle);
    die;
}
