<?php 
namespace classes\view;
defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class accountView{
    private     $_DB        =   NULL,
                $_CONFIG    =   NULL,
                $_SESSION   =   NULL; 

    public function __construct(){
        $this->_DB          = NEW \classes\core\db;                                 
        $this->_CONFIG      = NEW \classes\core\config;                                         
        $this->_SESSION     = NEW \classes\core\session;  
    }

    public function me($uuid = ""){
        $this->array  = ["userid" => !empty($uuid) ? $uuid : $this->_SESSION->get($this->_CONFIG->get("boann/user"))];
        $this->query  = "SELECT *
                                FROM `users`                                    
                                WHERE `users`.`uuid` = :userid ";
        return $this->_DB->get($this->query, $this->array);        
    }
}
