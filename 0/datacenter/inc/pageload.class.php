<?php
include "inc/constants.class.php";

class PageLoad {
	
	public function http_fetch($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$jsonArray = curl_exec($ch);
		curl_close($ch);
		
		return $jsonArray;
	}
	
	
	public function current_fetch($browser,$engineVersion,$netEnv,$iscache,$websiteType) {
		$url = "http://172.17.192.11:8080/sdc/page/avg?browser=".$browser."&engineVersion=".$engineVersion."&netEnv=".$netEnv."&iscache=".$iscache."&websiteType=".$websiteType;
		
		$tpl = array(
			'chart'=>array('caption'=>''),
			'categories'=>array('category'=>array()),
			'dataset'=>array(
				array('seriesname'=>'开始渲染时间','data'=>array()),
				array('seriesname'=>'DOM Ready时间','data'=>array()),
				array('seriesname'=>'页面加载时间','data'=>array()) 
			)
		);
		
		$jsonArray = $this->http_fetch($url);
		
		if ($jsonArray != '[]') {
			$jsonArray = json_decode($jsonArray);
			foreach ($jsonArray as $json) {
				array_push($tpl['categories']['category'], array('label'=>$json->website));
				array_push($tpl['dataset'][0]['data'], array('value'=>$json->avgTimeToStartRender));
				array_push($tpl['dataset'][1]['data'], array('value'=>$json->avgTimeToDomReady));
				array_push($tpl['dataset'][2]['data'], array('value'=>$json->avgTimeToPageLoaded));
			}
			
			return json_encode($tpl);
		}
		
		return '';
	}

	private function genTable($array) {
		if( is_null($array)){
			return;
		}
		$t = array();
		foreach ($array as $item) {
			$engine_version = $item -> engineVersion;
			if($this->exists($engine_version, $t) == 0){
				$t[$engine_version] = array();
			}
			
			$o = new stdClass();
			$o->website = $item -> website;
			$o->avgTimeToStartRender = $item -> avgTimeToStartRender;
			$o->avgTimeToDomReady = $item -> avgTimeToDomReady;
			$o->avgTimeToPageLoaded = $item -> avgTimeToPageLoaded;
			
			array_push($t[$engine_version], $o);
		}
		
		return $t;
	}
	
	private function exists($item, $t){
		foreach ($t as $key => $value) {
			if($item == $key) {
				return 1;
			}
		}
		
		return 0;
	}

	private function fillDataSet($seriesname, $value, $index){
		$o = new stdClass();
		$o->seriesname = $seriesname;
		$o->data = array();
					
		$o1 = new stdClass();
		if($index == 0){
			$o1->value = $value->avgTimeToStartRender;
			
		}
		elseif ($index == 1) {
			$o1->value = $value->avgTimeToDomReady;
		}
		elseif ($index == 2) {
			$o1->value = $value->avgTimeToPageLoaded;
		}
		
		array_push($o->data, $o1);
		array_push($tpl['axis'][0]['dataset'], $o);
	}
	
	public function fetch($tpl,$browser,$url,$tsid, $color){
		
		$jsonArray = $this->http_fetch($url);
		
		if ($jsonArray != '[]') {
			$arr = json_decode($jsonArray);
			//print_r($arr);
			$t = $this -> genTable($arr);
			//print_r($t);
			
			//fill in categories -> category
			if(count($tpl['categories']['category']) == 0){
				foreach ($t as $key => $value_arr) {
					foreach($value_arr as $value){
						//print_r($value);
						$o = new stdClass();
						$o->label = $value->website;
						array_push($tpl['categories']['category'], $o);
					}
					break;
				}
			}
			
			
			//fill axis
			foreach ($t as $key => $value_arr) {
				//array_push($tpl->axis[0]->dataset, array('seriesname'=>$key, 'data'=>array()));
				$o1 = new stdClass();
				$o1->seriesname = $browser."_".$key."_TimeToStartRender";
				$o1->color = $color;
				$o1->data = array();
				foreach($value_arr as $value){
					$o11 = new stdClass();
					$o11->value = $value->avgTimeToStartRender;
					array_push($o1->data, $o11);
				}
				array_push($tpl['axis'][0]['dataset'], $o1);
				
				
				$o2 = new stdClass();
				$o2->seriesname = $browser."_".$key."_TimeToDOMReady";
				$o2->color = $color;
				$o2->data = array();
				foreach($value_arr as $value){
					$o21 = new stdClass();
					$o21->value = $value->avgTimeToDOMReady;
					array_push($o2->data, $o21);
				}
				array_push($tpl['axis'][1]['dataset'], $o2);
				
				$o3 = new stdClass();
				$o3->seriesname = $browser."_".$key."_TimeToPageLoaded";
				$o3->color = $color;
				$o3->data = array();
				foreach($value_arr as $value){
					$o31 = new stdClass();
					$o31->value = $value->avgTimeToPageLoaded;
					array_push($o3->data, $o31);
				}
				array_push($tpl['axis'][2]['dataset'], $o3);
			}
		}
		return $tpl;
	}

	public function fetchCatagories(){
		
	}

	public function fetchScenarios($browser, $engineVersion){
		$url = sprintf(Constants::$ldt_fetch_scenarios, $browser, $engineVersion);
		print $url;
		
		$arr_test_scenarios = $this->http_fetch($url);
		
		return json_decode($arr_test_scenarios);
	}
	
	public function fetchEVAScenarios($v_baidu, $v_uc, $v_qq){
		$url = "http://172.17.192.11:8080/sdc/page?eva=[v_baidu:".$v_baidu.",v_uc:".$v_uc.",v_qq:".$v_qq."]";
		$arr_test_scenarios = $this->http_fetch($url);
		
		return json_decode($arr_test_scenarios);
	}
	
	public function fetchByBrowserAndVersionAndTSID($browser, $engineVersion, $tsid){
		$url = "http://172.17.192.11:8080/sdc/page/avg?browser=".$browser."&engineVersion=".$engineVersion."&ts=".$tsid;
		$arr_data = $this->http_fetch($url);
		//print $url;
		
		return json_decode($arr_data);
	}
	
	public function fetchByBrowserAndVersionAndWebsiteAndTSID($browser,$engineVersion, $website,$tsid){
		$url = "http://172.17.192.11:8080/sdc/page/website?browser=".$browser."&engineVersion=".$engineVersion."&website=".$website."&tsid=".$tsid;
		$arr_data = $this->http_fetch($url);
		return json_decode($arr_data);
	}
	
	public function fetchVersions(){
		$url = "http://172.17.192.11:8080/sdc/page/vers";
		$arr_data = $this->http_fetch($url);
		return json_decode($arr_data);
	}
	
	public function fetchVersionsByBrowser($browser){
		$url = "http://172.17.192.11:8080/sdc/page/vers?browser=".$browser;
		$arr_data = $this->http_fetch($url);
		return json_decode($arr_data);
	}

}
