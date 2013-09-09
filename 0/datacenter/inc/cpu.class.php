<?php

if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

class CPU extends DataCenter {
	
	private function sortByWebsite($array) {
		$arr_ret = array();
		foreach ($array as $key => $value) {
			$ws = $value->website;
			
			if(array_key_exists($ws, $arr_ret) == FALSE){
				$item = array($value->cpuValue);
				$arr_ret[$ws] = $item;
			}
			else{
				array_push($arr_ret[$ws], $value->cpuValue);
			}
			
			
		}
		//print_r($arr_ret);
		return $arr_ret;
	}
	
	private function exists($v, $t){
		foreach ($t as $key => $value) {
			if($v == $value) {
				return 1;
			}
		}
		
		return 0;
	}
	
	private function findWebsite($array){
		$item = array();
		foreach ($array as $key => $value) {
			if($this->exists($value->website, $item) == 0){
				array_push($item, $value->website);
			}
			
		}
		
		return $item;
	}
	
	public function dashboard($v_baidu, $v_uc, $v_qq, $tsid, $ts){
		$json_tpl = array(
			'chart' => array(
				'palette' => '2',
				'caption' => $ts, 
				'xaxisname' => '', 
				'showvalues' => '0', 
				'labeldisplay' => 'ROTATE'
			), 
			'categories' => array(
				'category' => array(
					array("label"=>"1"),array("label"=>"2"),array("label"=>"3"),array("label"=>"4"),array("label"=>"5"),
					array("label"=>"6"),array("label"=>"7"),array("label"=>"8"),array("label"=>"9"),array("label"=>"10"),
					array("label"=>"11"),array("label"=>"12"),array("label"=>"13"),array("label"=>"14"),array("label"=>"15"),
					array("label"=>"16"),
					array("label"=>"17"),array("label"=>"18"),array("label"=>"19"),array("label"=>"20"),
					array("label"=>"21"),array("label"=>"22"),array("label"=>"23"),array("label"=>"24"),array("label"=>"25"),
					array("label"=>"26"),array("label"=>"27"),array("label"=>"28"),array("label"=>"29"),array("label"=>"30"),
					array("label"=>"31"),array("label"=>"32"),array("label"=>"33"),array("label"=>"34"),array("label"=>"35"),
					array("label"=>"36"),array("label"=>"37"),array("label"=>"38"),array("label"=>"39"),array("label"=>"40")
				)
			), 
			'axis' => array( 
				// array(
					// 'title' => '', 
					// 'axisonleft' => '0', 
					// 'titlepos' => 'right', 
					// 'numdivlines' => '4', 
					// 'tickwidth' => '10', 
					// 'divlineisdashed' => '1', 
					// 'formatnumberscale' => '1', 
					// 'numberscaleunit' => '秒', 
					// 'numberscalevalue' => '1000', 
					// 'dataset' => array()
				// )
			)
		);
		
		$baidu_details = json_decode(parent::http(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, 'baidu', $v_baidu, $tsid)));
		$uc_details = json_decode(parent::http(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, 'uc', $v_uc, $tsid)));
		$qq_details = json_decode(parent::http(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, 'qq', $v_qq, $tsid)));
		$websites = $this->findWebsite($baidu_details);
		//print_r($websites);
		
		$counter = 0;
		foreach ($websites as $key => $value) {
			$counter++;
			if($counter > 6){
				break;
			}
			
			$axis_item = array( 
				'title' => $value,
				'axisonleft' => '0', 
				'titlepos' => 'right', 
				'numdivlines' => '4', 
				'tickwidth' => '10', 
				'divlineisdashed' => '1', 
				'formatnumberscale' => '1', 
				'numberscaleunit' => '%', 
				'numberscalevalue' => '1000', 
				'dataset' => array()
			);
			
			$series_baidu = array("seriesname"=>'baidu_'.$value, "color"=>"CC0000", "data"=>array());
			$baidu_data = $this->sortByWebsite($baidu_details);
			foreach ($baidu_data[$value] as $key2 => $value2) {
				$tmp = new stdClass;
				$tmp->value = $value2;
				array_push($series_baidu['data'], $tmp);
			}
			
			array_push($axis_item['dataset'], $series_baidu);
			//array_push($json_tpl['axis'], $axis_item);
			
			$series_uc = array("seriesname"=>'uc_'.$value, "color"=>"0372AB", "data"=>array());
			$uc_data = $this->sortByWebsite($uc_details);
			foreach ($uc_data[$value] as $key2 => $value2) {
				$tmp = new stdClass;
				$tmp->value = $value2;
				array_push($series_uc['data'], $tmp);
			}
			
			array_push($axis_item['dataset'], $series_uc);
			
			$series_qq = array("seriesname"=>'qq_'.$value, "color"=>"00FF40", "data"=>array());
			$qq_data = $this->sortByWebsite($qq_details);
			foreach ($qq_data[$value] as $key2 => $value2) {
				$tmp = new stdClass;
				$tmp->value = $value2;
				array_push($series_qq['data'], $tmp);
			}
			
			array_push($axis_item['dataset'], $series_qq);
			
			
			array_push($json_tpl['axis'], $axis_item);
		}
		
		
		return json_encode($json_tpl);
	}

	public function generateEvaPoints($v_baidu, $v_uc, $v_qq, $tsid){
		
		$eva_points_by_website = $this->generateWebsiteEVADetails($v_baidu, $v_uc, $v_qq, $tsid);
		
		if($tsid == 16){
			//print_r($eva_points_by_website);//exit;
		}
		
		$eva_points = array("baidu"=>0, "uc"=>0, "qq"=>0);
		foreach ($eva_points_by_website as $key => $value) {
			$eva_points["baidu"] += $value["baidu"];
			$eva_points["uc"] += $value["uc"];
			$eva_points["qq"] += $value["qq"];
		}
		$eva_points["baidu"] = round($eva_points["baidu"] / count($eva_points_by_website),1);
		$eva_points["uc"] = round($eva_points["uc"] / count($eva_points_by_website),1);
		$eva_points["qq"] = round($eva_points["qq"] / count($eva_points_by_website),1);
		
		return $eva_points;
	}

	public function generateWebsiteEVADetails($v_baidu, $v_uc, $v_qq, $tsid){
		$arr_baidu = parent::run_http_api(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, "baidu", $v_baidu, $tsid));
		$arr_uc = parent::run_http_api(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, "uc", $v_uc, $tsid));
		$arr_qq = parent::run_http_api(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, "qq", $v_qq, $tsid));
		
		$websites = $this->findWebsite($arr_baidu);
		$baidu_data = $this->sortByWebsite($arr_baidu);
		$uc_data = $this->sortByWebsite($arr_uc);
		$qq_data = $this->sortByWebsite($arr_qq);
		$eva_points_by_website = array();
		foreach ($websites as $key => $value) {
			$eva_points_by_website[$value] = array('baidu'=>0, 'uc'=>0, 'qq'=>0);
			$tmp = 0;
			foreach ($baidu_data[$value] as $key2 => $value2) {
				$tmp += $value2;
			}
			$eva_points_by_website[$value]['baidu'] = $tmp;
			$tmp = 0;
			foreach ($uc_data[$value] as $key2 => $value2) {
				$tmp += $value2;
			}
			$eva_points_by_website[$value]['uc'] = $tmp;
			$tmp = 0;
			foreach ($qq_data[$value] as $key2 => $value2) {
				$tmp += $value2;
			}
			$eva_points_by_website[$value]['qq'] = $tmp;
			
			
			asort($eva_points_by_website[$value]);
			
			$counter = 0;
			$base = 1;
			foreach ($eva_points_by_website[$value] as $key2 => $value2) {
				if($counter == 0){
					$base = $value2;
				}
				$p = 10 * (1- round(($value2 - $base)/$base,2));
				if ($p < 0){
					$p = 0;
				}
				$eva_points_by_website[$value][$key2] = $p;
				$counter++;
			}
		}
		
		return $eva_points_by_website;
	}

	

}
