<?php 
namespace api;

defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class msfs_api{

    private     $_DB            =   NULL,
                $_CONFIG        =   NULL,
                $_SESSION       =   NULL,
                $query          =   NULL;

    public function __construct(){
        $this->_DB          = NEW \classes\core\db;                                 
        $this->_CONFIG      = NEW \classes\core\config;                                         
        $this->_SESSION     = NEW \classes\core\session;
    }

    public function deleteDatabase(){
        $this->query    = "DELETE FROM `flights` WHERE (modified < NOW() - INTERVAL 5 MINUTE) OR (ABS(heading)=0 AND ABS(groundspeed)=0 AND ABS(airspeed)=0)";
        return $this->_DB->action($this->query);
    }

    public function getFlights(){
        $this->query    =   "SELECT * FROM `flights`"; 
        return $this->_DB->getAll($this->query);
    }

    public function postDatabase($data = []){
        $this->query    =   "INSERT INTO `flights` (`callsign`, `pilotName`, `groupName`, `created`, `aircraftType`, `latitude`, `longitude`, `altitude`, `heading`, `airspeed`, `groundspeed`, `touchdownVelocity`, `notes`, `version`, `ipAddress`) 
                                VALUES (:callsign, :pilotName, :groupName, now(), :aircraftType, :latitude, :longitude, :altitude, :heading, :airspeed, :groundspeed, :touchdownVelocity, :notes, :version, :ipAddress)
                               ON DUPLICATE KEY UPDATE 
                                 `pilotName`         = :pilotName,
                                 `groupName`         = :groupName,
                                 `aircraftType`      = :aircraftType,
                                 `modified`          = now(),
                                 `latitude`          = :latitude,
                                 `longitude`         = :longitude,
                                 `altitude`          = :altitude,
                                 `heading`           = :heading,
                                 `airspeed`          = :airspeed,
                                 `groundspeed`       = :groundspeed,
                                 `touchdownVelocity` = :touchdownVelocity,
                                 `notes`             = :notes,
                                 `version`           = :version,
                                 `ipAddress`         = :ipAddress
                            ";
        $this->_DB->action($this->query, $data);        
    }
}
