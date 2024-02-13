<?php
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;

    $input      =   NEW \classes\core\input;
    $lang       =   NEW \classes\core\language;


    switch($action){
        case "UI" :
            $UI     = [

            ];
            
            //print_r($lang->get("callsign", "ifr_airport"));            
        break;

        case "simbrief" :
            $simbrief_alias = !empty($input->get("data")["simbrief_alias"]) ? escape($input->get("data")["simbrief_alias"]) : null;

            if($simbrief_alias){
                $jsonUrl    = "https://www.simbrief.com/api/xml.fetcher.php?username={$simbrief_alias}&json=1";
                $jsonData   = file_get_contents($jsonUrl);
                $data       = json_decode($jsonData);
                
                //debug($data);
                //die;
                
                $dataOutput = [
                    "callsign"          => "{$data->atc->callsign}",
                    "approach_airport"  => "{$data->origin->name}",
                    "approach_runway"   => "{$data->origin->plan_rwy}",
                    "initial_altitude"  => "{$data->general->initial_altitude}ft,",


                    "arrivle_airport"   => "{$data->destination->name}",
                    "arrivle_runway"    => "{$data->destination->plan_rwy}",

                ];

                echo json_encode($dataOutput);
                //echo debug($data->atc->callsign, 1);
                //echo debug($data->origin->name, 1);
                //echo debug($dataOutput, 1);

            };

        break;
    }
