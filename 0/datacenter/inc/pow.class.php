<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

class Power extends DataCenter {
	
	public function dashboard($plid, $pns, $tsid, $ts){
		$json_tpl = array(
			'chart' => array(
				"numberprefix"=>"",
        		"numbersuffix"=>" mA",
        		"caption"=>$ts,
        		"subcaption"=>"",
        		"xaxisname"=>"",
        		"yaxisname"=>"平均耗电量",
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
				"category"=>"1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|32|32|33|34|35|36|37|38|39|40|41|42|43|44|45|46|47|48|49|50|51|52|53|54|55|56|57|58|59|60|61|62|63|64|65|66|67|68|69|70|71|72|73|74|75|76|77|78|79|80"
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
		// $baidu_details = json_decode(parent::http(sprintf(Constants::$pow_fetch_details_by_browser_version_tsid, 'baidu', $v_baidu, $tsid)));
		// //print_r($baidu_details);
		// $baidu_data = "";
		// foreach ($baidu_details as $key => $value) {
			// $baidu_data = $baidu_data.$value->powerValue."|";
		// }
		// $json_tpl['dataset'][0]['data'] =$baidu_data;
// 		
		// $uc_details = json_decode(parent::http(sprintf(Constants::$pow_fetch_details_by_browser_version_tsid, 'uc', $v_uc, $tsid)));
		// $uc_data = "";
		// foreach ($uc_details as $key => $value) {
			// $uc_data = $uc_data.$value->powerValue."|";
		// }
		// $json_tpl['dataset'][1]['data'] =$uc_data;
// 		
		// $qq_details = json_decode(parent::http(sprintf(Constants::$pow_fetch_details_by_browser_version_tsid, 'qq', $v_qq, $tsid)));
		// $qq_data = "";
		// foreach ($qq_details as $key => $value) {
			// $qq_data = $qq_data.$value->powerValue."|";
		// }
		// $json_tpl['dataset'][2]['data'] =$qq_data;
		
		foreach ($pns as $key => $value) {
			$details = json_decode(parent::http(sprintf(Constants::$pow_fetch_details_by_pn_version_tsid, $plid, $key, $value, $tsid)));
			$data = "";
			foreach ($details as $_key => $_value) {
				$data = $data.$_value->powerValue."|";
			}
			//$json_tpl['dataset'][0]['data'] =$baidu_data;
			$item = array("seriesname"=>$key, "data"=>$data);
			array_push($json_tpl['dataset'], $item);
		}
		
		return json_encode($json_tpl);
	}
	
	public function generateEvaPoints($plid, $pns, $tsid){
		
		$eva_points = array();
		foreach ($pns as $key => $value) {
			$details = parent::run_http_api(sprintf(Constants::$pow_fetch_details_by_pn_version_tsid,$plid, $key, $value, $tsid));
			$sum = 0;
			for ($i=0; $i < count($details); $i++) {
				$sum += $details[$i]->powerValue;
			}
			$avg = $sum / count($details);
			
			$eva_points[$key] = $avg;
		}
		
		
		asort($eva_points);
		
		//$factor = 1;
		$counter = 0;
		$base = 1;
		foreach ($eva_points as $key => $value) {
			if($counter == 0){
				$base = $value;
			}
			$eva_points[$key] = 10 * (1- round(($value - $base)/$base,2));
			//$factor = $factor - 0.2;
			$counter++;
		}
		
		ksort($eva_points);
		return $eva_points;
	}

}
