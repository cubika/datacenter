<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

class Fps extends DataCenter {
	public function dashboard($v_baidu, $v_uc, $v_qq, $tsid, $ts){
		$json_tpl = array(
			'chart' => array(
				"numberprefix"=>"",
        		"numbersuffix"=>" ",
        		"caption"=>$ts,
        		"subcaption"=>"",
        		"xaxisname"=>"",
        		"yaxisname"=>"FPS",
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
				"category"=>"1|2|34|5|6|7|8|9|10"
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
		$baidu_details = json_decode(parent::http(sprintf(Constants::$fps_fetch_details_by_browser_version_tsid, 'baidu', $v_baidu, $tsid)));
		//print_r($baidu_details);
		$baidu_data = "";
		foreach ($baidu_details as $key => $value) {
			$baidu_data = $baidu_data.$value->fpsValue."|";
		}
		$json_tpl['dataset'][0]['data'] =$baidu_data;
		
		$uc_details = json_decode(parent::http(sprintf(Constants::$fps_fetch_details_by_browser_version_tsid, 'uc', $v_uc, $tsid)));
		$uc_data = "";
		foreach ($uc_details as $key => $value) {
			$uc_data = $uc_data.$value->fpsValue."|";
		}
		$json_tpl['dataset'][1]['data'] =$uc_data;
		
		$qq_details = json_decode(parent::http(sprintf(Constants::$fps_fetch_details_by_browser_version_tsid, 'qq', $v_qq, $tsid)));
		$qq_data = "";
		foreach ($qq_details as $key => $value) {
			$qq_data = $qq_data.$value->fpsValue."|";
		}
		$json_tpl['dataset'][2]['data'] =$qq_data;
		
		return json_encode($json_tpl);
	}
	
	public function generateEvaPoints($v_baidu, $v_uc, $v_qq, $tsid){
		$arr_baidu = parent::run_http_api(sprintf(Constants::$fps_fetch_details_by_browser_version_tsid, "baidu", $v_baidu, $tsid));
		$arr_uc = parent::run_http_api(sprintf(Constants::$fps_fetch_details_by_browser_version_tsid, "uc", $v_uc, $tsid));
		$arr_qq = parent::run_http_api(sprintf(Constants::$fps_fetch_details_by_browser_version_tsid, "qq", $v_qq, $tsid));
		
		$eva_points_details = array();
		for ($i=0; $i < count($arr_baidu); $i++) {
			//print_r($arr_baidu);
			$item = array("baidu"=>$arr_baidu[$i]->fpsValue, "uc"=>$arr_uc[$i]->fpsValue, "qq"=>$arr_qq[$i]->fpsValue); 
			arsort($item);
			//print_r($item);
			$factor = 1;
			foreach ($item as $key => $value) {
				$item[$key] = 10 * $factor;
				$factor = $factor - 0.2;
			}
			$eva_points_details[$arr_baidu[$i]->website] = $item;
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
