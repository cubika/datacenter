<?php

include "inc/rain.tpl.class.php";
include "inc/benchmark.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$ben = new Benchmark;

// $browser = $_GET['browser'];
// $engine_version = $_GET['engine_version'];

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);

$pn = $_GET['pn'];
$v = $_GET['v'];

$details = $ben->run_http_api(sprintf(Constants::$ben_fetch_details_by_pn_version, $plid, $pn, $v));
$item = $details[0];
$arr_details = array(
	'html5test' => $item->html5test,
	'sunspider' => $item->sunspider,
	'domCoreTests' => $item->domCoreTests,
	'peaceKeeper' => $item->peaceKeeper,
	'css3SelectorsTest' => $item->css3SelectorsTest,
	'guimark3Bitmap' => $item->guimark3Bitmap,
	'guimark3Vector' => $item->guimark3Vector,
	'guimark3Compute' => $item->guimark3Compute,
	'canvasPerformanceTest' => $item->cavasPerformanceTest,
	'fishIetank' => $item->fishIetank,
	'mazeSolver' => $item->mazeSolver, 
	'webGlAquarium' => $item->webGlAquarium,
	'webGlBlob' => $item->webGlBlob

);
$tpl -> assign('details', $arr_details);
$tpl -> assign('pn', $pn);
$tpl -> assign('v', $v);

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('benchmark_query_content', $return_string = true);

// and then draw the output
echo $html;
?>