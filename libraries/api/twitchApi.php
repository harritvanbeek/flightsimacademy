<?php
namespace api;

defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class twitchApi{

    protected $_UserClientID     =   NULL,
              $_UserSecredCode   =   NULL,
              $_AccessToken      =   NULL;


    public function __construct($array = []){
        $this->_UserClientID    =   $array["UserClientID"];
        $this->_UserSecredCode  =   $array["UserSecredCode"];
        $this->_AccessToken     =   "nxk859r3hdtyl9f7bgxbbd7xbbiiw3";               
    }

    //get userchannel from twitch
    public function channel($channel){
        return $this->_send_curl('https://api.twitch.tv/helix/search/channels?query=' . $channel);
    }


    //get acces token from twitch
    protected function _access_token(){
        return $this->_send_curl("https://id.twitch.tv/oauth2/token?client_id={$this->_UserClientID}&client_secret={$this->_UserSecredCode}&grant_type=client_credentials");
    }

    //send data to twitch to get data back as json
    protected function _send_curl($url = ""){
        $curlHeader = [
            "Client-Id: {$this->_UserClientID}",
            "Authorization: Bearer ".$this->_AccessToken,
            "Accept: application/vnd.twitchtv.v5+json",
        ];
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeader);
        $data = curl_exec($ch);
        curl_close ($ch);
        return json_decode($data);
    }

}
