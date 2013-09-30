<?php
class DataCenter {

	public function http($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	public function curl_del($url) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return $result;
	}

	public function run_http_api($url) {
		$resp = $this -> http($url);
		return json_decode($resp);
	}

	public function parsePNS($pns) {
		
		$pns = str_ireplace("[", "", $pns);
		$pns = str_ireplace("]", "", $pns);
		$tmp = split(",", $pns);
		$_pns = array();
		foreach ($tmp as $key => $value) {
			$item = split(":", $value);
			$_pns[$item[0]] = $item[1];
		}
		
		return $_pns;
	}

}
