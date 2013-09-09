<?php

include "inc/rain.tpl.class.php";
include "inc/benchmark.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$ben = new Benchmark();

$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];

$baidu_details = $ben->run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'baidu', $v_baidu));
$uc_details = $ben->run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'uc', $v_uc));
$qq_details = $ben->run_http_api(sprintf(Constants::$ben_fetch_details_by_browser_version, 'qq', $v_qq));

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
			'dataset' => array(
				array('seriesname' => 'Baidu', 'color' => '8BBA00', 'data' => array(
					array('value'=>$baidu_details[0]->html5test),
					array('value'=>$baidu_details[0]->sunspider),
					array('value'=>$baidu_details[0]->domCoreTests),
					array('value'=>$baidu_details[0]->peaceKeeper),
					array('value'=>$baidu_details[0]->css3SelectorsTest),
					array('value'=>$baidu_details[0]->guimark3Bitmap),
					array('value'=>$baidu_details[0]->guimark3Vector),
					array('value'=>$baidu_details[0]->guimark3Compute),
					array('value'=>$baidu_details[0]->cavasPerformanceTest),
					array('value'=>$baidu_details[0]->fishIetank),
					array('value'=>$baidu_details[0]->mazeSolver),
					array('value'=>$baidu_details[0]->webGlAquarium),
					array('value'=>$baidu_details[0]->webGlBlob)
				)),
				array('seriesname' => 'UC', 'color' => 'A66EDD', 'data' => array(
					array('value'=>$uc_details[0]->html5test),
					array('value'=>$uc_details[0]->sunspider),
					array('value'=>$uc_details[0]->domCoreTests),
					array('value'=>$uc_details[0]->peaceKeeper),
					array('value'=>$uc_details[0]->css3SelectorsTest),
					array('value'=>$uc_details[0]->guimark3Bitmap),
					array('value'=>$uc_details[0]->guimark3Vector),
					array('value'=>$uc_details[0]->guimark3Compute),
					array('value'=>$uc_details[0]->cavasPerformanceTest),
					array('value'=>$uc_details[0]->fishIetank),
					array('value'=>$uc_details[0]->mazeSolver),
					array('value'=>$uc_details[0]->webGlAquarium),
					array('value'=>$uc_details[0]->webGlBlob)
				)),
				array('seriesname' => 'QQ', 'color' => 'F6BD0F', 'data' => array(
					array('value'=>$qq_details[0]->html5test),
					array('value'=>$qq_details[0]->sunspider),
					array('value'=>$qq_details[0]->domCoreTests),
					array('value'=>$qq_details[0]->peaceKeeper),
					array('value'=>$qq_details[0]->css3SelectorsTest),
					array('value'=>$qq_details[0]->guimark3Bitmap),
					array('value'=>$qq_details[0]->guimark3Vector),
					array('value'=>$qq_details[0]->guimark3Compute),
					array('value'=>$qq_details[0]->cavasPerformanceTest),
					array('value'=>$qq_details[0]->fishIetank),
					array('value'=>$qq_details[0]->mazeSolver),
					array('value'=>$qq_details[0]->webGlAquarium),
					array('value'=>$qq_details[0]->webGlBlob)
				))
			)
		);

$tpl -> assign('json_benchmark', json_encode($json_tpl));

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('benchmark_eva_content', $return_string = true);

// and then draw the output
echo $html;
?>