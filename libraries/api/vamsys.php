<?php 
    namespace api;
    defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");
    
    class vamsys{
        protected   $env        = NULL,  
                    $apiUri     = "https://vamsys.io/",
                    $jsonData   = "",
                    $jsonFile   = "";

        public function __construct()
        {
            $this->env        =   NEW \classes\core\env;                      
        }

        
        
        public function leaderboard(){
            $this->jsonData = self::request('leaderboard/'.$this->env->get('vamsys'));
            if(!empty($this->jsonData)){
                return $this->jsonData;
            }
        }

        public function statistics()
        {
            $this->jsonData = self::request('statistics/'.$this->env->get('vamsys'));
            if(!empty($this->jsonData)){
                return $this->jsonData;
            }
        }
        
        public function map()
        {   
            $this->jsonData = self::request('statistics/map/'.$this->env->get('vamsys'));
            if(!empty($this->jsonData)){
                return $this->jsonData;
            }else{
                //set static data;                
                $array[]    =   [
                    "callsign"          =>  "FSA58A",
                    "flight-number"     =>  "FS1318",
                    "route"             =>  "",
                    "network"           =>  "Offline",

                    "currentLocation"   => [
                        "altitude"               => "",
                        "heading"                => -50,
                        "latitude"               => "52.31223026863802",
                        "longitude"              => "4.768255251503155",
                        "groundspeed"            => 0,
                        "distance_remaining"     => 498,
                        "time_remaining"         => "00:00",
                        "distance_flown"         => 0,
                        "departure_time"         => "N/A",
                        "estimated_arrival_time" => "N/A",
                        "time_flown"             => "N/A"
                    ],

                    "aircraft" => [
                        "registration"  => "PH-BGF",
                        "name"          => "Grote Zilverreiger / Great White Heron",
                        "code"          => "B737",
                        "codename"      => "BOEING"
                    ],

                    "departure" => [
                        "name"      => "Amsterdam Schiphol",
                        "icao"      => "EHAM",
                        "iata"      => "AMS",
                        "latitude"  => "52.3086010",
                        "longitude" => "4.7638900"
                    ],

                    "arrival"     => [
                        "name"      => "N/A",
                        "icao"      => "UNKOWN",
                        "iata"      => "",
                        "latitude"  => "",
                        "longitude" => ""
                    ],
                ];
                return $array;
            }
        }

        protected function request($methode = null)
        {
            $curl = curl_init(); 
            curl_setopt($curl,  CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl,  CURLOPT_URL, $this->apiUri.$methode);
            curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true);
            
            $head       = curl_exec($curl);
            $httpCode   = curl_getinfo($curl, CURLINFO_HTTP_CODE);    
            $data       = json_decode($head, true);
            
            curl_close($curl);
                        
            return $data;
        }
    }
