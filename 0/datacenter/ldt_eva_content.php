<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$dc = new DataCenter;

$pl = new PageLoadRef();

$plid = $_GET['plid'];

$pns = $_GET['pns'];
$tpl -> assign('pns', $pns);

$_pns = $dc->parsePNS($pns);
$tpl -> assign('_pns', $_pns);

$eva_scenarios = $pl->run_http_api(sprintf(Constants::$ldt_fetch_eva_scenarios,$plid,$pns));

for ($i=0; $i < count($eva_scenarios); $i++) {
	$tsid = $eva_scenarios[$i][0]; 
	//$json_tpl = $pl->dashboard($v_baidu, $v_uc, $v_qq, $tsid, $eva_scenarios[$i][1]);
	//array_push($eva_scenarios[$i],$json_tpl);
	
	$json_tpl = $pl->singleChart($plid, $_pns, $tsid,"ttsr");
	array_push($eva_scenarios[$i],$json_tpl);
	
	$t = $pl->deal($plid,$_pns, $tsid);
	array_push($eva_scenarios[$i], $t);
	
	$json_tpl = $pl->singleChart($plid,$_pns, $tsid,"ttdr");
	array_push($eva_scenarios[$i],$json_tpl);
	
	$json_tpl = $pl->singleChart($plid,$_pns, $tsid,"ttpl");
	array_push($eva_scenarios[$i],$json_tpl);
	
	//print_r($t);exit;
}
	
$tpl -> assign('test_scenarios', $eva_scenarios);
// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('ldt_eva_content', $return_string = true);

// and then draw the output
echo $html;
?>