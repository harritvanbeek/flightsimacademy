<?php 
namespace classes\view;
defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class blogView{
    private     $_DB        =   NULL,
                $_CONFIG    =   NULL,
                $_SESSION   =   NULL; 
    
    public function __construct(){
        $this->_DB          = NEW \classes\core\db;                                 
        $this->_CONFIG      = NEW \classes\core\config;                                         
        $this->_SESSION     = NEW \classes\core\session;   
    }

    public function exist($data = "", $item = ""){
        switch($data){
            case 'catogory':
                $this->query = "SELECT COUNT(`alias`) as `exist` FROM `blog_catogory` WHERE `alias` = '{$item}' ";
            break;

            case 'tags':
                $this->query = "SELECT COUNT(`alias`) as `exist` FROM `blog_tags` WHERE `alias` = '{$item}' ";
            break;           
        }

            return $this->_DB->get($this->query)->exist; 
    }

    //blog
    public function getContent($array = []){
        $this->query = "SELECT * FROM `blog_content`"; 
        return $this->_DB->getAll($this->query);
    }
    
    public function postContent($array = []){
        $this->query = "INSERT INTO `blog_content` (`uuid`, `title`, `alias`, `uuidCat`, `uuidTag`, `content`, `post_data`) 
                               VALUES(:uuid, :title, :alias, :uuidCat, :uuidTag, :content, :post_data)";
        return $this->_DB->action($this->query, $array);
    }

    public function removeBlog($data){
        $array = [
            "uuid" => "{$data}",
        ];
        $this->query = "DELETE FROM `blog_content` WHERE `uuid` = :uuid";
        return $this->_DB->action($this->query, $array);
    }
    

    //tags
    public function postTags($array = []){
        $this->query = "INSERT INTO `blog_tags` (`uuid`,`name`, `alias`, `post_data`)  VALUES(:uuid, :name, :alias, :post_data)";
        return $this->_DB->action($this->query, $array);
    }

    public function getTags(){
        $this->query = "SELECT * FROM `blog_tags`"; 
        return $this->_DB->getAll($this->query);
    }

    //catogory
    public function getCatogory(){
        $this->query = "SELECT * FROM `blog_catogory`"; 
        return $this->_DB->getAll($this->query);
    }


    public function postCatogory($array = []){
        $this->query = "INSERT INTO `blog_catogory` (`uuid`,`name`, `alias`, `post_data`)  VALUES(:uuid, :name, :alias, :post_data)";
        return $this->_DB->action($this->query, $array);
    }
}