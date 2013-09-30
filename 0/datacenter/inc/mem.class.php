<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

class Memory extends DataCenter {
	
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
			$o->memValue = $item -> memValue;
			
			array_push($t[$website], $o);
		}
		
		return $t;
	}
	
	// private function deal($v_baidu, $v_uc, $v_qq, $tsid) {
// 		
		// $baidu_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "baidu",$v_baidu,$tsid));
		// $uc_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "uc",$v_uc,$tsid));
		// $qq_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "qq",$v_qq,$tsid));
// 		
		// $baidu_details = $this -> sortByWebsite($baidu_details);
		// $uc_details = $this -> sortByWebsite($uc_details);
		// $qq_details = $this -> sortByWebsite($qq_details);
// 		
// 		
		// //print_r($baidu_details);
		// $t = array();
		// foreach ($baidu_details as $key => $value) {
			// //print $key;
			// if(array_key_exists($key, $t) == FALSE && array_key_exists($key, $uc_details) && array_key_exists($key, $qq_details)){
				// $t[$key] = array('baidu'=>$value, 'uc'=>$uc_details[$key], 'qq'=>$qq_details[$key]);
			// }
// 			
		// }
// 		
		// return $t;
	// }
	
	public function deal($plid, $pns, $tsid) {
		$v_baidu = $pns['baidu'];
		$baidu_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_pn_version_tsid, $plid, "baidu",$v_baidu,$tsid));
		// $uc_details = parent::run_http_api(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "uc",$v_uc,$tsid));
		// $qq_details = parent::run_http_api(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid, "qq",$v_qq,$tsid));
		
		$baidu_details = $this -> sortByWebsite($baidu_details);
		// $uc_details = $this -> sortByWebsite($uc_details);
		// $qq_details = $this -> sortByWebsite($qq_details);
		
		$t = array();
		foreach ($baidu_details as $key => $value) {
			if(array_key_exists($key, $t) == FALSE){
				foreach ($pns as $key2 => $value2) {
					$details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_pn_version_tsid, $plid, $key2, $value2, $tsid));
					$details = $this -> sortByWebsite($details);
					if(array_key_exists($key, $details)){
						$t[$key][$key2] = $details[$key];
					}
					else {
						unset($t[$key]);
						break;
					}
				}
			}
			
			// if(array_key_exists($key, $t) == FALSE && array_key_exists($key, $uc_details) && array_key_exists($key, $qq_details)){
				// $t[$key] = array('baidu'=>$value, 'uc'=>$uc_details[$key], 'qq'=>$qq_details[$key]);
			// }
			
		}
		
		return $t;
	}
	
	public function dashboard($plid, $pns, $tsid, $ts){
		$json_tpl = array(
			'chart' => array(
				"numberprefix"=>"",
        		"numbersuffix"=>" M",
        		"caption"=>$ts,
        		"subcaption"=>"",
        		"xaxisname"=>"",
        		"yaxisname"=>"内存消耗",
        		"legendposition"=>"BOTTOM",
        		"divlineisdashed"=>"1",
        		"palette1"=>"3",
        		"pixelsperpoint"=>"15",
        		"numminorlogdivlines"=>"3",
        		"palettethemecolor1"=>"FF0000",
        		"anchorminrenderdistance"=>"20",
        		"showtooltip"=>"1",
        		"connectnulldata"=>"1",
        		"rotatevalues"=>"1",
        		"palette"=>"4",
        		"compactdatamode"=>"1",
        		"dataseparator"=>"|"
			), 
			'categories' => array(
				"category"=>""
			),
			'dataset' => array(
				// array(
					// "seriesname"=>"Baidu",
            		// "color"=>"AFD8F8",
            		// "linethickness"=>"1",
            		// "data"=>""
				// ),
				// array(
					// "seriesname"=>"UC",
            		// "color"=>"F6BD0F",
            		// "linethickness"=>"1",
            		// "data"=>""
				// ),
				// array(
					// "seriesname"=>"QQ",
            		// "color"=>"CC0000",
            		// "linethickness"=>"1",
            		// "data"=>""
				// )
			)
		);
		
		$t = $this->deal($plid, $pns, $tsid);
		//print_r($t);exit;
		$cate = "";
		foreach ($t as $key => $value) {
			$cate .= $key."|";
			$json_tpl['categories']['category'] = $cate;
		}
		
		//fill axis
		//$config = array("baidu", "uc", "qq");	
		//,"color"=>"CC0000"
		foreach($pns as $key => $value) {
			$data = "";
			foreach ($t as $t_key => $t_value) {
				$data .= $t_value[$key][0]->memValue."|";
			}
			$item = array("seriesname"=>$key, "data"=>$data);
			array_push($json_tpl['dataset'], $item);
		}
		
		return json_encode($json_tpl);
	}

	public function generateEvaPoints($plid, $pns, $tsid){
		
		$eva_points_details = array();
		$t = $this->deal($plid, $pns, $tsid);
		foreach ($t as $key => $value) {
			$item = array();
			foreach ($pns as $key2 => $value2) {
				$item[$key2] = $value[$key2][0]->memValue;
			}
			asort($item);
			$factor = 1;
			foreach ($item as $key => $value) {
				$item[$key] = 10 * $factor;
				$factor = $factor - 0.2;
			}
			$eva_points_details[$key] = $item;	
		}
		
		$eva_points = array();
		foreach ($pns as $key => $value) {
			$eva_points[$key] = 0;
		}
		foreach ($eva_points_details as $key => $value) {
			foreach ($pns as $key2 => $value2) {
				$eva_points[$key2] += $value[$key2];
			}
		}
		
		foreach ($pns as $key => $value) {
			$eva_points[$key] = round($eva_points[$key] / count($eva_points_details),1);
		}
		
		ksort($eva_points);
		return $eva_points;
	}	
}
