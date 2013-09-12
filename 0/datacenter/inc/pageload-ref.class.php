<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

class PageLoadRef extends DataCenter {
	
	private function sortByVersion($array) {
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
	
	private function sortByWebsite($array) {
		if( is_null($array)){
			return;
		}
		$t = array();
		foreach ($array as $item) {
			$website = $item -> website;
			if(array_key_exists($website, $t) == FALSE){
				$t[$website] = array();
			}
			
			$o = new stdClass();
			//$o->website = $item -> website;
			$o->avgTimeToStartRender = $item -> avgTimeToStartRender;
			$o->avgTimeToDomReady = $item -> avgTimeToDomReady;
			$o->avgTimeToPageLoaded = $item -> avgTimeToPageLoaded;
			
			array_push($t[$website], $o);
		}
		
		return $t;
	}
	
	public function deal($v_baidu, $v_uc, $v_qq, $tsid) {
		
		$baidu_details = parent::run_http_api(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "baidu",$v_baidu,$tsid));
		$uc_details = parent::run_http_api(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "uc",$v_uc,$tsid));
		$qq_details = parent::run_http_api(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "qq",$v_qq,$tsid));
		
		$baidu_details = $this -> sortByWebsite($baidu_details);
		$uc_details = $this -> sortByWebsite($uc_details);
		$qq_details = $this -> sortByWebsite($qq_details);
		
		
		//print_r($baidu_details);
		$t = array();
		foreach ($baidu_details as $key => $value) {
			//print $key;
			if(array_key_exists($key, $t) == FALSE && array_key_exists($key, $uc_details) && array_key_exists($key, $qq_details)){
				$t[$key] = array('baidu'=>$value, 'uc'=>$uc_details[$key], 'qq'=>$qq_details[$key]);
			}
			
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


	public function dashboard($v_baidu, $v_uc, $v_qq, $tsid, $ts) {
		$json_tpl = array(
			'chart' => array(
				'palette' => '2',
				'caption' => '', 
				'xaxisname' => '', 
				'showvalues' => '0', 
				'labeldisplay' => 'ROTATE'
			), 
			'categories' => array(
				'category' => array()
			), 
			'axis' => array( 
				array(
					'title' => 'ttsr',  
					'titlepos' => 'left', 
					'tickwidth' => '10', 
					'divlineisdashed' => '1', 
					'numberscaleunit' => '秒', 
					'numberscalevalue' => '1000', 
					'dataset' => array()
				), 
				array(
					'title' => 'ttdr', 
					'axisonleft' => '0', 
					'titlepos' => 'right', 
					'numdivlines' => '4', 
					'tickwidth' => '10', 
					'divlineisdashed' => '1', 
					'formatnumberscale' => '1', 
					'numberscaleunit' => '秒', 
					'numberscalevalue' => '1000', 
					'dataset' => array()
				), 
				array(
					'title' => 'ttpd', 
					'axisonleft' => '0', 
					'titlepos' => 'right', 
					'numdivlines' => '4', 
					'tickwidth' => '10', 
					'divlineisdashed' => '1', 
					'formatnumberscale' => '1', 
					'numberscaleunit' => '秒', 
					'numberscalevalue' => '1000', 
					'dataset' => array()
				)
			)
		);
		
		$json_tpl['chart']['caption'] = '测试场景：' . $ts;
		
		// if ($v_baidu != "") {
			// $json_tpl = $this -> multi_axis_chart($json_tpl, 'baidu', sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "baidu",$v_baidu,$tsid), $tsid, "CC0000");
// 			
		// }
// 
		// if ($v_uc != "") {
			// $json_tpl = $this -> multi_axis_chart($json_tpl, 'uc', sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "uc",$v_uc,$tsid), $tsid, "0372AB");
		// }
// 		
		// if ($v_qq != "") {
			// $json_tpl = $this -> multi_axis_chart($json_tpl, 'qq', sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "qq",$v_qq,$tsid), $tsid, "00FF40");
		// }
		
		$t = $this->deal($v_baidu, $v_uc, $v_qq, $tsid);
		//print_r($t);exit;
		foreach ($t as $key => $value) {
			$o = new stdClass();
			$o->label = $key;
			array_push($json_tpl['categories']['category'], $o);
		}
		
		//fill axis
		$config = array(
			"baidu"=>array("avgTimeToStartRender", "avgTimeToDomReady", "avgTimeToPageLoaded", "color"=>"CC0000"),
			"uc"=>array("avgTimeToStartRender", "avgTimeToDomReady", "avgTimeToPageLoaded", "color"=>"0372AB"),
			"qq"=>array("avgTimeToStartRender", "avgTimeToDomReady", "avgTimeToPageLoaded", "color"=>"00FF40")
		);	
		//,"color"=>"CC0000"
		foreach($config as $ckey => $cvalue) {
			foreach ($cvalue as $key => $value) {
				if($key === "color") break;
				$dataset = new stdClass();
				$dataset->seriesname = $ckey."_".$value;
				$dataset->color = $cvalue['color'];
				$dataset->data = array();
				foreach ($t as $t_key => $t_value) {
					$data = new stdClass();
					//print_r($sub_value);exit;
					$data->value = $t_value[$ckey][0]->$value;
					array_push($dataset->data, $data);
				}
				//print_r($dataset);exit;
				array_push($json_tpl['axis'][$key]['dataset'], $dataset);
			}
			
		}
				
		//print_r($json_tpl['axis'][0]['dataset']);exit;
				
				
				// $dataset = new stdClass();
				// $dataset->seriesname = $key."_TimeToDOMReady";
				// $dataset->color = "0372AB";
				// $dataset->data = array();
				// foreach($value as $sub_key => $sub_value){
					// $data = new stdClass();
					// $data->value = $sub_value->avgTimeToDomReady;
					// array_push($dataset->data, $data);
				// }
				// array_push($tpl['axis'][1]['dataset'], $dataset);
// 				
				// $dataset = new stdClass();
				// $dataset->seriesname = $key."_TimeToPageLoaded";
				// $dataset->color = "00FF40";
				// $dataset->data = array();
				// foreach($value as $sub_key => $sub_value){
					// $data = new stdClass();
					// $data->value = $sub_value->avgTimeToPageLoaded;
					// array_push($dataset->data, $data);
				// }
				// array_push($tpl['axis'][2]['dataset'], $dataset);
				
				
			

		return json_encode($json_tpl);
	}

	public function generateEvaPoints($v_baidu, $v_uc, $v_qq, $tsid){
		// $arr_baidu = json_decode(parent::http(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "baidu", $v_baidu, $tsid)));
		// $arr_uc = json_decode(parent::http(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "uc", $v_uc, $tsid)));
		// $arr_qq = json_decode(parent::http(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "qq", $v_qq, $tsid)));
// 		
		// $eva_points_details = array();
		// for ($i=0; $i < count($arr_baidu); $i++) {
			// //print_r($arr_baidu);
			// $item = array("baidu"=>$arr_baidu[$i]->avgTimeToPageLoaded, "uc"=>$arr_uc[$i]->avgTimeToPageLoaded, "qq"=>$arr_qq[$i]->avgTimeToPageLoaded); 
			// asort($item);
			// //print_r($item);
			// $factor = 1;
			// foreach ($item as $key => $value) {
				// $item[$key] = 10 * $factor;
				// $factor = $factor - 0.2;
			// }
			// $eva_points_details[$arr_baidu[$i]->website] = $item;
		// }
		
		$eva_points_details = array();
		$t = $this->deal($v_baidu, $v_uc, $v_qq, $tsid);
		//print_r($t);exit;
		foreach ($t as $key => $value) {
			$item = array("baidu"=>$value['baidu'][0]->avgTimeToPageLoaded, "uc"=>$value['uc'][0]->avgTimeToPageLoaded, "qq"=>$value['qq'][0]->avgTimeToPageLoaded); 
			asort($item);
			//print_r($item);
			$factor = 1;
			foreach ($item as $key => $value) {
				$item[$key] = 10 * $factor;
				$factor = $factor - 0.2;
			}
			$eva_points_details[$key] = $item;	
		}
		
		$eva_points = array("baidu"=>0, "uc"=>0, "qq"=>0);
		foreach ($eva_points_details as $key => $value) {
			$eva_points["baidu"] += $value["baidu"];
			$eva_points["uc"] += $value["uc"];
			$eva_points["qq"] += $value["qq"];
		}
		$eva_points["baidu"] = round($eva_points["baidu"] / count($eva_points_details),1);
		$eva_points["uc"] = round($eva_points["uc"] / count($eva_points_details),1);
		$eva_points["qq"] = round($eva_points["qq"] / count($eva_points_details),1);
		
		return $eva_points;
	}	

	public function singleChart($v_baidu, $v_uc, $v_qq, $tsid, $type) {
		$t = $this->deal($v_baidu, $v_uc, $v_qq, $tsid);
		
		$json_tpl = array(
			'chart' => array('palette' => '1', 'caption' => '', 'xaxisname' => ''), 
			'categories' => array('font' => "Arial", 'category' => array()), 
			'dataset' => array(
				array('seriesname' => 'Baidu', 'color' => '8BBA00', 'data' => array()),
				array('seriesname' => 'UC', 'color' => 'A66EDD', 'data' => array()),
				array('seriesname' => 'QQ', 'color' => 'F6BD0F', 'data' => array())
			)
		);
		
		//print_r($t);exit;
		
		foreach ($t as $key => $value) {
			$o = new stdClass();
			$o->label = $key;
			array_push($json_tpl['categories']['category'], $o);
			
			if($type == "ttsr"){
				$o = new stdClass();
				$o->value = $value['baidu'][0]->avgTimeToStartRender;
				array_push($json_tpl['dataset'][0]['data'], $o);
				
				$o = new stdClass();
				$o->value = $value['uc'][0]->avgTimeToStartRender;
				array_push($json_tpl['dataset'][1]['data'], $o);
				
				$o = new stdClass();
				$o->value = $value['qq'][0]->avgTimeToStartRender;
				array_push($json_tpl['dataset'][2]['data'], $o);
			}
			elseif($type == "ttdr"){
				$o = new stdClass();
				$o->value = $value['baidu'][0]->avgTimeToDomReady;
				array_push($json_tpl['dataset'][0]['data'], $o);
				
				$o = new stdClass();
				$o->value = $value['uc'][0]->avgTimeToDomReady;
				array_push($json_tpl['dataset'][1]['data'], $o);
				
				$o = new stdClass();
				$o->value = $value['qq'][0]->avgTimeToDomReady;
				array_push($json_tpl['dataset'][2]['data'], $o);
			}
			elseif($type == "ttpl"){
				$o = new stdClass();
				$o->value = $value['baidu'][0]->avgTimeToPageLoaded;
				array_push($json_tpl['dataset'][0]['data'], $o);
				
				$o = new stdClass();
				$o->value = $value['uc'][0]->avgTimeToPageLoaded;
				array_push($json_tpl['dataset'][1]['data'], $o);
				
				$o = new stdClass();
				$o->value = $value['qq'][0]->avgTimeToPageLoaded;
				array_push($json_tpl['dataset'][2]['data'], $o);
			}
		}
		
		return json_encode($json_tpl);
	}
	
}
