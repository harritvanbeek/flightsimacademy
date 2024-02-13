<?php
namespace classes\core;

defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class language {
    private $_DB        =   NULL,
            $_SESSION   =   NULL,
            $_language  =   NULL;

    public function __construct(){
        $this->_language = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        $this->_language = strtoupper($this->_language) . '-' . $this->_language;
        $this->_dirname   = dirname(dirname(dirname(__FILE__))).DS."language";
        
        
    }


    public function get($values = "", $filename = "", $dirname = ""){

        switch($this->_language){
            case "NL-nl" :
                if(self::_dirExist()){
                    return self::_fileExist($values, $filename);
                }; 
            break;   

            case "EN-en" :
                if(self::_dirExist()){
                    return self::_fileExist($values, $filename);
                }; 
            break; 

            default :
                $this->_language = "EN-en";
                if(self::_dirExist()){
                    return self::_fileExist($values, $filename);
                }; 
            break;  
        }        
    }


    protected function _dirExist(){
        if( is_dir($this->_dirname.DS.$this->_language) ){
            return true;
        }else{
            return false;
        }
    }

    protected function _fileExist($values = "", $filename = ""){
        if(file_exists($this->_dirname.DS.$this->_language.DS."{$filename}.ini")){
            $this->file = parse_ini_file($this->_dirname.DS.$this->_language.DS."{$filename}.ini", true);
            if(!empty($this->file[$values])){
                return $this->file[$values];
            }            
        }else{
            $DataArray  =   [
                "data"              =>  "error",
                "errorMessinger"    =>  "The file : {$filename}.ini is not extist",
            ];
            echo debug($DataArray);            
        }
    }





}