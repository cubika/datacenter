<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;
$pl = new PageLoadRef;

$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];

if($v_baidu != NULL && $v_uc != NULL && $v_qq != NULL){
	$eva_scenarios = $pl->run_http_api(sprintf(Constants::$ldt_fetch_eva_scenarios,$v_baidu,$v_uc,$v_qq));
	for ($i=0; $i < count($eva_scenarios); $i++) {
		$tsid = $eva_scenarios[$i][0]; 
		//$json_tpl = $pl->dashboard($v_baidu, $v_uc, $v_qq, $tsid, $eva_scenarios[$i][1]);
		//array_push($eva_scenarios[$i],$json_tpl);
		
		$json_tpl = $pl->singleChart($v_baidu, $v_uc, $v_qq, $tsid,"ttsr");
		array_push($eva_scenarios[$i],$json_tpl);
		
		$t = $pl->deal($v_baidu, $v_uc, $v_qq, $tsid);
		array_push($eva_scenarios[$i], $t);
		
		$json_tpl = $pl->singleChart($v_baidu, $v_uc, $v_qq, $tsid,"ttdr");
		array_push($eva_scenarios[$i],$json_tpl);
		
		$json_tpl = $pl->singleChart($v_baidu, $v_uc, $v_qq, $tsid,"ttpl");
		array_push($eva_scenarios[$i],$json_tpl);
		
		//print_r($t);exit;
	}
	
	

	$tpl -> assign('test_scenarios', $eva_scenarios);
}

$v_baidu = $pl->run_http_api(sprintf(Constants::$ldt_fetch_versions_by_browser,"baidu"));
$v_uc = $pl->run_http_api(sprintf(Constants::$ldt_fetch_versions_by_browser,"uc"));
$v_qq = $pl->run_http_api(sprintf(Constants::$ldt_fetch_versions_by_browser,"qq"));
$tpl -> assign("v_baidu", $v_baidu);
$tpl -> assign("v_uc", $v_uc);
$tpl -> assign("v_qq", $v_qq);

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('ldt_eva', $return_string = true);

// and then draw the output
echo $html;
?>