<?php 

namespace classes\core;

defined('_BOANN') or header("Location:{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["SERVER_NAME"]}");

class discord{

	public function post($url, $array = []){
		self::curl($url, $array);
	}

	protected function curl($url, $array){
		$make_json = json_encode($array);		
		$ch = curl_init( "{$url}" );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $make_json);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec( $ch );
		return $response;
	}

	public function eventMessinger(){
		
	}

}
