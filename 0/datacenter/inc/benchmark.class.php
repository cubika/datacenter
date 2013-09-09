<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }


class Benchmark extends DataCenter {
	
	public $benchmarks = array(
		"html5test" => array("sort"=>"r", "unit"=>"分"),
		"sunspider" => array("sort"=>"a", "unit"=>"ms"),
		"domCoreTests" =>array("sort"=> "r", "unit"=>"run/s"),
		"octane" => array("sort"=>"r", "unit"=>"分"),
		"acid3" => array("sort"=>"r", "unit"=>"分"),
		"peaceKeeper" => array("sort"=>"r", "unit"=>"分"),
		"css3SelectorsTest" => array("sort"=>"r", "unit"=>"分"),
		"guimark3Bitmap" => array("sort"=>"r","unit"=>"fps"),
		"guimark3Vector" => array("sort"=>"r","unit"=>"fps"),
		"guimark3Compute" =>array("sort"=> "r","unit"=>"fps"),
		"cavasPerformanceTest" =>array("sort"=>"r","unit"=>"fps"),
		"fishIetank" => array("sort"=>"r","unit"=>"fps"),
		"mazeSolver" =>array( "sort"=>"a","unit"=>"s"),
		"webGlAquarium" =>array( "sort"=>"r","unit"=>"fps"),
		"webGlBlob" =>array( "sort"=>"r","unit"=>"fps")
	);
	
	public function generateEvaPointsDetails($v_baidu, $v_uc, $v_qq){
		$arr_baidu = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'baidu', $v_baidu));
		$arr_uc = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'uc', $v_uc));
		$arr_qq = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'qq', $v_qq));
		
		$eva_points_details = array();
		foreach ($this->benchmarks as $key => $value) {
			$item = array("baidu"=>$arr_baidu[0]->$key, "uc"=>$arr_uc[0]->$key, "qq"=>$arr_qq[0]->$key); 
			if($value['sort'] == "r"){
				arsort($item);
			}
			elseif ($value['sort'] == "a") {
				asort($item);
			}
			
		
			$factor = 1;
			foreach ($item as $item_key => $item_value) {
				$item[$item_key] = 10 * $factor;
				$factor = $factor - 0.2;
			}
			$eva_points_details[$key] = $item;
		}
		
		return $eva_points_details;
	}	

	public function generateEvaPoints($v_baidu, $v_uc, $v_qq){
		$eva_points_details = $this->generateEvaPointsDetails($v_baidu, $v_uc, $v_qq);		
		
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
	
	public function singleChart($caption, $v_baidu, $v_uc, $v_qq, $unit) {
		$arr_baidu = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'baidu', $v_baidu));
		$arr_uc = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'uc', $v_uc));
		$arr_qq = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'qq', $v_qq));
		
		$json_tpl = array(
			'chart' => array(
				 "yaxisname"=> "",
        		 "caption"=> $caption."(".$unit.")",
        		 "numberprefix"=> "",
        		 "showborder"=> "1",
			),
			'data' => array(
				array("label"=>"baidu", "value"=>$arr_baidu[0]->$caption),
				array("label"=>"uc", "value"=>$arr_uc[0]->$caption),
				array("label"=>"qq", "value"=>$arr_qq[0]->$caption)
			) 
		);
		
		return json_encode($json_tpl);
	}

}
