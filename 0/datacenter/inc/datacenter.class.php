<?php
class DataCenter {
	
	public function http($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$jsonArray = curl_exec($ch);
		curl_close($ch);
		
		return $jsonArray;
	}
	
	public function run_http_api($url){
		$resp = $this -> http($url);
		return json_decode($resp);
	}

}
