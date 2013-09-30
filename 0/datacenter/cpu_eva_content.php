<?php

include "inc/rain.tpl.class.php";
include "inc/cpu.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }
if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;
$dc = new DataCenter;
$cpu = new CPU;

$plid = $_GET['plid'];

$pns = $_GET['pns'];
$_pns = $dc->parsePNS($pns);
$tpl -> assign('_pns', $_pns);


if(! isset($_SESSION['eva_scenarios']['cpu'][$pns])){
	$eva_scenarios = $cpu->run_http_api(sprintf(Constants::$cpu_fetch_eva_scenarios,$plid,$pns));
	$scenarios_size = count($eva_scenarios);
	for ($i=0; $i < $scenarios_size ; $i++) { 
		$json_tpl = $cpu->dashboard($plid, $pns, $eva_scenarios[$i][0], $eva_scenarios[$i][1]);
		array_push($eva_scenarios[$i],$json_tpl);
	}
	session_start();
	session_set_cookie_params(3600);
	$_SESSION['eva_scenarios']['cpu'][$pns]=$eva_scenarios;
}else{
	$eva_scenarios = $_SESSION['eva_scenarios']['cpu'][$pns];
}

$tpl -> assign('eva_scenarios', $eva_scenarios);


// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('cpu_eva_content', $return_string = true);

// and then draw the output
echo $html;
?>