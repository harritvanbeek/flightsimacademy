<?php 
namespace classes\view;
defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class tweets{
    private     $_DB        =   NULL,
                $_CONFIG    =   NULL,
                $_SESSION   =   NULL; 
    
    public function __construct(){
        $this->_DB          = NEW \classes\core\db;                                 
        $this->_CONFIG      = NEW \classes\core\config;                                         
        $this->_SESSION     = NEW \classes\core\session;   
    }


    public function post($data = []){
        
        $this->query    = "INSERT INTO `twitter` (`tweetUuid`, `title`, `mension`, `tags`, `date`, `time`, `bericht`, `tweetdate`, `postdate`) 
                                VALUES (:tweetUuid,:title, :mension, :tags, :dates, :settime, :bericht, :tweetdate, :postdate)";
        $this->return   =   $this->_DB->action($this->query, $data);
        return $this->return;    
        //debug();
    }
}
