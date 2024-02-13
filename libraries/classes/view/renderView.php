<?php
namespace classes\view;

defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class renderView{
    public      $_language      =   NULL;
    private     $_DB            =   NULL,
                $_CONFIG        =   NULL,
                $_SESSION       =   NULL,

                $_CONTROLLER    =   "home",
                $_INDEX         =   "index",
                $_PAGE          =   "",

                $_PARAMS        =   [],
                $_MODEL         =   NULL,
                $_URL           =   NULL;

    public function __construct(){
        /* $this->_DB          = NEW \classes\core\db;
        $this->_CONFIG      = NEW \classes\core\config;
        $this->_SESSION     = NEW \classes\core\session;
        $this->_language      = NEW \classes\core\language;
        */
        $this->_URL           = $this->_parseURL();

        if($this->_URL[0]){
            $this->_CONTROLLER  =   $this->_URL[0];
            $this->_PAGE        =   $this->_URL[0];
        }

        if(class_exists('classes\view\\'.$this->_CONTROLLER) > 0){
            $this->className    =   'classes\view\\'.$this->_CONTROLLER;
            $this->_CONTROLLER  =   NEW     $this->className;
        };


        if( isset($this->_URL[1]) ){
            $this->_MODEL   =   $this->_URL[1];
            unset($this->_URL[1]);
        }

        $this->params = $this->_URL ? array_values($this->_URL) : [];
        //call_user_func_array($this->_CONTROLLER, $this->_MODEL, $this->params);


        //custom 404
        if(self::urlFolderExist() < 1){
            self::Custom404Pgage();
        }else{
            unset($this->_URL[0]);
        } 

    }

    public function activeUrl($data = ""){
        if($this->_PAGE === $data){
            return "active";
        }
    }

    public function RenderPages(){
        return "html/site/{$this->_PAGE}.php";
        //return "view/com_{$this->_PAGE}/{$this->_INDEX}.php";
    }

    protected function Custom404Pgage(){
        /*require_once "templates/".TEMPLATE_NAME."/old/404.php";
        die;*/
    }

    protected function urlFolderExist(){
        if(is_dir("view/com_{$this->_PAGE}")){
            return true;
        }else{
            return false;
        }
    }

    protected function urlExist(){
        return file_exists("view/com_{$this->_URL[0]}/index.php");
    }

    public function view($view = null){
        require_once "templates/index.php";
    }


    protected function _parseURL(){
        if(!empty($_GET["request"])){
            return explode("/",  filter_var(rtrim($_GET["request"], '/'), FILTER_SANITIZE_URL));
        }
    }

}
