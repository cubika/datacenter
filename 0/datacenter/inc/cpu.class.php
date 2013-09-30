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
	
	public function dashboard($plid, $pns, $tsid, $ts){
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
			'axis' => array()
		);
		
		$pns = substr($pns, 1, strlen($pns) - 2);
		$arr_pns = split(",", $pns);
		$_pns = array();
		foreach ($arr_pns as $key => $value) {
			$items = split(":", $value);
			$_pns[$items[0]] = $items[1];
		}
		
		
		$_baidu = $_pns['baidu'];
			$details = parent::run_http_api(sprintf(Constants::$cpu_fetch_details, $plid, 'baidu', $_baidu, $tsid));
			$websites = $this->findWebsite($details);
			$counter = 0;
			//print_r($websites);exit;
			foreach ($websites as $index => $website) {
				$counter++;
				if($counter > 1){
					break;
				}
				
				$axis_item = array( 
					'title' => $website,
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
				
				foreach ($_pns as $pn => $v) {
					$series = array("seriesname"=>$pn.'_'.$website, "data"=>array());
					
					$_details = parent::run_http_api(sprintf(Constants::$cpu_fetch_details, $plid, $pn, $v, $tsid));
					$data = $this->sortByWebsite($_details);
					foreach ($data[$website] as $key => $value) {
						$tmp = new stdClass;
						$tmp->value = $value;
						array_push($series['data'], $tmp);
					}
			
					array_push($axis_item['dataset'], $series);
				}
				array_push($json_tpl['axis'], $axis_item);
				
			}
		
		return json_encode($json_tpl);
	}

	public function generateEvaPoints($plid, $pns, $tsid){
		
		$eva_points_by_website = $this->generateWebsiteEVADetails($plid, $pns, $tsid);
		
		if($tsid == 16){
			//print_r($eva_points_by_website);//exit;
		}
		
		$eva_points = array();
		foreach ($pns as $key2 => $value2) {
			$eva_points[$key2] = 0;
		}
		
		foreach ($eva_points_by_website as $key => $value) {
			foreach ($pns as $key2 => $value2) {
				$eva_points[$key2] += $value[$key2];
			}
		}
		
		foreach ($pns as $key => $value) {
			$eva_points[$key] = round($eva_points[$key] / count($eva_points_by_website),1);
		}
		ksort($eva_points);
		return $eva_points;
	}

	public function generateWebsiteEVADetails($plid, $pns, $tsid){
		$v_baidu = $pns['baidu'];
		$arr_baidu = parent::run_http_api(sprintf(Constants::$cpu_fetch_details, $plid, "baidu", $v_baidu, $tsid));
		// $arr_uc = parent::run_http_api(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, "uc", $v_uc, $tsid));
		// $arr_qq = parent::run_http_api(sprintf(Constants::$cpu_fetch_details_by_browser_version_tsid, "qq", $v_qq, $tsid));
		
		$websites = $this->findWebsite($arr_baidu);
		$baidu_data = $this->sortByWebsite($arr_baidu);
		// $uc_data = $this->sortByWebsite($arr_uc);
		// $qq_data = $this->sortByWebsite($arr_qq);
		$eva_points_by_website = array();
		
		foreach ($websites as $key => $value) {
			foreach ($pns as $pkey => $pvalue) {
				$eva_points_by_website[$value][$pkey] = 0;
			}
			
			// $tmp = 0;
			// foreach ($baidu_data[$value] as $key2 => $value2) {
				// $tmp += $value2;
			// }
			// $eva_points_by_website[$value]['baidu'] = $tmp;
			// $tmp = 0;
			// foreach ($uc_data[$value] as $key2 => $value2) {
				// $tmp += $value2;
			// }
			// $eva_points_by_website[$value]['uc'] = $tmp;
			// $tmp = 0;
			// foreach ($qq_data[$value] as $key2 => $value2) {
				// $tmp += $value2;
			// }
			// $eva_points_by_website[$value]['qq'] = $tmp;
			
			foreach ($pns as $key2 => $value2) {
				$arr = parent::run_http_api(sprintf(Constants::$cpu_fetch_details, $plid, $key2, $value2, $tsid));
				$_data = $this->sortByWebsite($arr);
				$tmp = 0;
				foreach ($_data[$value] as $key3 => $value3) {
					$tmp += $value3;
				}
				$eva_points_by_website[$value][$key2] = $tmp;
			}
			
			asort($eva_points_by_website[$value]);
			
			$counter = 0;
			$base = 1;
			foreach ($eva_points_by_website[$value] as $key3 => $value3) {
				if($counter == 0){
					$base = $value3;
				}
				$p = 10 * (1- round(($value3 - $base)/$base,2));
				if ($p < 0){
					$p = 0;
				}
				$eva_points_by_website[$value][$key3] = $p;
				$counter++;
			}
		}
		
		return $eva_points_by_website;
	}

	

}
