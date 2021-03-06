<?php

include "inc/rain.tpl.class.php";
include "inc/pow.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }
if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;
$dc = new DataCenter;
$pow = new Power;

// $v_baidu = $_GET['v_baidu'];
// $v_uc = $_GET['v_uc'];
// $v_qq = $_GET['v_qq'];
// 
// 
// $eva_scenarios = $pow->run_http_api(sprintf(Constants::$pow_fetch_eva_scenarios,$v_baidu,$v_uc,$v_qq));
// for ($i=0; $i < count($eva_scenarios); $i++) { 
	// $json_tpl = $pow->dashboard($v_baidu, $v_uc, $v_qq, $eva_scenarios[$i][0], $eva_scenarios[$i][1]);
	// array_push($eva_scenarios[$i], $json_tpl);
// }

$plid = $_GET['plid'];

$pns = $_GET['pns'];
$_pns = $dc->parsePNS($pns);

if(! isset($_SESSION['eva_scenarios']['pow'][$pns])){
	$eva_scenarios = $pow->run_http_api(sprintf(Constants::$pow_fetch_eva_scenarios,$plid,$pns));
	$scenarios_size = count($eva_scenarios);
	for ($i=0; $i < $scenarios_size ; $i++) { 
		$json_tpl = $pow->dashboard($plid, $_pns, $eva_scenarios[$i][0], $eva_scenarios[$i][1]);
		array_push($eva_scenarios[$i],$json_tpl);
	}
	session_start();
	session_set_cookie_params(3600);
	$_SESSION['eva_scenarios']['pow'][$pns]=$eva_scenarios;
}else{
	$eva_scenarios = $_SESSION['eva_scenarios']['pow'][$pns];
}

$tpl -> assign('eva_scenarios', $eva_scenarios);
// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('pow_eva_content', $return_string = true);

// and then draw the output
echo $html;
?>