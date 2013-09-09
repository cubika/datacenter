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
	
	private function deal($v_baidu, $v_uc, $v_qq, $tsid) {
		
		$baidu_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "baidu",$v_baidu,$tsid));
		$uc_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "uc",$v_uc,$tsid));
		$qq_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "qq",$v_qq,$tsid));
		
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
	
	public function dashboard($v_baidu, $v_uc, $v_qq, $tsid, $ts){
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
				array(
					"seriesname"=>"Baidu",
            		"color"=>"AFD8F8",
            		"linethickness"=>"1",
            		"data"=>""
				),
				array(
					"seriesname"=>"UC",
            		"color"=>"F6BD0F",
            		"linethickness"=>"1",
            		"data"=>""
				),
				array(
					"seriesname"=>"QQ",
            		"color"=>"CC0000",
            		"linethickness"=>"1",
            		"data"=>""
				)
			)
		);
		
		// $baidu_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, 'baidu', $v_baidu, $tsid));
// 		
		// $baidu_data = "";
		// $baidu_category = "";
		// foreach ($baidu_details as $key => $value) {
// 
			// $baidu_category = $baidu_category.$value->website."|";
			// $baidu_data = $baidu_data.$value->memValue."|";
		// }
		// $json_tpl['categories']['category'] =$baidu_category;
		// $json_tpl['dataset'][0]['data'] =$baidu_data;
// 		
		// $uc_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, 'uc', $v_uc, $tsid));
		// $uc_data = "";
		// foreach ($uc_details as $key => $value) {
			// $uc_data = $uc_data.$value->memValue."|";
		// }
		// $json_tpl['dataset'][1]['data'] =$uc_data;
// 		
		// $qq_details = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, 'qq', $v_qq, $tsid));
		// $qq_data = "";
		// foreach ($qq_details as $key => $value) {
			// $qq_data = $qq_data.$value->memValue."|";
		// }
		// $json_tpl['dataset'][2]['data'] =$qq_data;
// 		

		$t = $this->deal($v_baidu, $v_uc, $v_qq, $tsid);
		//print_r($t);exit;
		foreach ($t as $key => $value) {
			$cate .= $key."|";
			$json_tpl['categories']['category'] = $cate;
		}
		
		//fill axis
		$config = array("baidu", "uc", "qq");	
		//,"color"=>"CC0000"
		foreach($config as $ckey => $cvalue) {
			$data = "";
				foreach ($t as $t_key => $t_value) {
					//print_r($t_value);exit;
					$data .= $t_value[$cvalue][0]->memValue."|";
				}
				//print_r($data);exit;
				$json_tpl['dataset'][$ckey]['data'] = $data;
			
		}
		
		return json_encode($json_tpl);
	}

	public function generateEvaPoints($v_baidu, $v_uc, $v_qq, $tsid){
		// $arr_baidu = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "baidu", $v_baidu, $tsid));
		// $arr_uc = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "uc", $v_uc, $tsid));
		// $arr_qq = parent::run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "qq", $v_qq, $tsid));
		// //print_r(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, "qq", $v_qq, $tsid));
		// $eva_points_details = array();
		// for ($i=0; $i < count($arr_baidu); $i++) {
			// //print_r($arr_baidu);
			// $item = array("baidu"=>$arr_baidu[$i]->memValue, "uc"=>$arr_uc[$i]->memValue, "qq"=>$arr_qq[$i]->memValue); 
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
			$item = array("baidu"=>$value['baidu'][0]->memValue, "uc"=>$value['uc'][0]->memValue, "qq"=>$value['qq'][0]->memValue); 
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
}
