<?php
namespace classes\core;

defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class env {
    protected 
        $_FILENAME = NULL,
        $_LINES    = NULL,
        $_LINE     = NULL,
        $_MATCHES  = NULL;


    public function get($data = ""){
        self::setenv(); 
        return getenv($data);  
    }
    
    protected function setenv(){
        $this->_FILENAME   =  file_get_contents(dirname(dirname(dirname(__DIR__))).DS."includes".DS.".env");
        $this->_LINES      = explode("\n",$this->_FILENAME);
        foreach($this->_LINES as $this->_LINE){
            preg_match("/([^#]+)\=(.*)/",$this->_LINE, $this->_MATCHES);            
            if(isset($this->_MATCHES[2])){
                putenv(trim($this->_LINE));
            }
        }                  
    }

}
