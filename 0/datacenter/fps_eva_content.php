<?php

include "inc/rain.tpl.class.php";
include "inc/fps.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$fps = new Fps();

$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];


$eva_scenarios = $fps->run_http_api(sprintf(Constants::$fps_fetch_eva_scenarios,$v_baidu,$v_uc,$v_qq));
for ($i=0; $i < count($eva_scenarios); $i++) { 
	$json_tpl = $fps->dashboard($v_baidu, $v_uc, $v_qq, $eva_scenarios[$i][0], $eva_scenarios[$i][1]);
	array_push($eva_scenarios[$i], $json_tpl);
}

$tpl -> assign('eva_scenarios', $eva_scenarios);
// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('fps_eva_content', $return_string = true);

// and then draw the output
echo $html;
?>