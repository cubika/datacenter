<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }


class Benchmark extends DataCenter {
	
	public $benchmarks = array(
		"html5test" => array("sort"=>"r", "unit"=>"分"),
		"sunspider" => array("sort"=>"a", "unit"=>"ms"),
		"domCoreTests" =>array("sort"=> "r", "unit"=>"run/ s"),
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
	
	public $benchmark_radar = array(
		'chart' => array(
			'caption' => '', 
			'canvasBorderAlpha' => '0', 
			'yAxisMaxValue' => '10', 
			'showLimits' => '0', 
			'bgColor' => 'FFFFFF', 
			'plotBorderThickness' => '1', 
			'radarSpikeThickness' => '3', 
			'divlineColor' => '9A9F9B', 
			'anchorRadius' => '4', 
			'anchorBorderThickness' => '2'
		), 
		'categories' => array( array('category' => array())), 
		'dataset' => array()
	);
	
	public function generateRadar($plid, $pns) {
		foreach ($pns as $key => $value) {
			array_push($this->benchmark_radar['dataset'], array('seriesname' => $key, 'data' => array()));
		}
		$details = $this->generateEvaPointsDetails($plid, $pns);
		
		foreach ($details as $key => $value) {
			array_push($this->benchmark_radar['categories'][0]['category'], array('label' => $key));
			$counter = 0;
			foreach ($pns as $pkey => $pvalue) {
				array_push($this->benchmark_radar['dataset'][$counter++]['data'], array('value' => $value[$pkey]));
			}
		}
		
		return json_encode($this->benchmark_radar);
		
	}
	
	public function generateEvaPointsDetails($plid, $pns){
		// $arr_baidu = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'baidu', $v_baidu));
		// $arr_uc = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'uc', $v_uc));
		// $arr_qq = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'qq', $v_qq));
		
		
		
		$eva_points_details = array();
		foreach ($this->benchmarks as $key => $value) {
			$item = array();
			foreach ($pns as $pkey => $pvalue) {
				$details = parent::run_http_api(sprintf(Constants::$ben_fetch_details_by_pn_version, $plid, $pkey, $pvalue));
				$item[$pkey] = $details[0]->$key;
			}
			//$item = array("baidu"=>$arr_baidu[0]->$key, "uc"=>$arr_uc[0]->$key, "qq"=>$arr_qq[0]->$key); 
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
			
			ksort($item);
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
