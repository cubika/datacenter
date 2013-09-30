<?php

include "inc/rain.tpl.class.php";
include "inc/benchmark.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }
if(!class_exists('DataCenter')){ include 'inc/datacenter.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;
$dc = new DataCenter;
$ben = new Benchmark;

$plid = $_GET['plid'];

$pns = $_GET['pns'];
$_pns = $dc->parsePNS($pns);
$tpl -> assign('_pns', $_pns);

$json_tpl = array(
			'chart' => array('palette' => '1', 'caption' => 'Benchmark比较', 'xaxisname' => ''), 
			'categories' => array('font' => "Arial", 'category' => array(
				array('label'=>'html5test'),
				array('label'=>'sunspider'),
				array('label'=>'domCoreTests'),
				array('label'=>'peaceKeeper'),
				array('label'=>'css3SelectorsTest'),
				array('label'=>'guimark3Bitmap'),
				array('label'=>'guimark3Vector'),
				array('label'=>'guimark3Compute'),
				array('label'=>'canvasPerformanceTest'),
				array('label'=>'fishIetank'),
				array('label'=>'mazeSolver'),
				array('label'=>'webGlAquarium'),
				array('label'=>'webGlBlob')
			)), 
			'dataset' => array()
		);


foreach ($_pns as $key => $value) {
	$details = $ben->run_http_api(sprintf(Constants::$ben_fetch_details_by_pn_version,$plid, $key, $value));
	
	$item = array("seriesname"=>$key, "data"=>array());
	array_push($item['data'], array('value'=>$details[0]->html5test));
	array_push($item['data'], array('value'=>$details[0]->sunspider));
	array_push($item['data'], array('value'=>$details[0]->domCoreTests));
	array_push($item['data'], array('value'=>$details[0]->peaceKeeper));
	array_push($item['data'], array('value'=>$details[0]->css3SelectorsTest));
	array_push($item['data'], array('value'=>$details[0]->guimark3Bitmap));
	array_push($item['data'], array('value'=>$details[0]->guimark3Vector));
	array_push($item['data'], array('value'=>$details[0]->guimark3Compute));
	array_push($item['data'], array('value'=>$details[0]->cavasPerformanceTest));
	array_push($item['data'], array('value'=>$details[0]->fishIetank));
	array_push($item['data'], array('value'=>$details[0]->mazeSolver));
	array_push($item['data'], array('value'=>$details[0]->webGlAquarium));
	array_push($item['data'], array('value'=>$details[0]->webGlBlob));
	
	array_push($json_tpl['dataset'], $item);
}

$tpl -> assign('json_benchmark', json_encode($json_tpl));

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('benchmark_eva_content', $return_string = true);

// and then draw the output
echo $html;
?>