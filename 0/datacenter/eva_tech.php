<?php

include "inc/rain.tpl.class.php";
include "inc/eva.core.main.php";
include "inc/eva.core.monkey.php";
include "inc/pageload-ref.class.php";
include "inc/benchmark.class.php";
include "inc/cpu.class.php";
include "inc/mem.class.php";
include "inc/trf.class.php";
include "inc/fps.class.php";
include "inc/pow.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

//get
$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];

$info = array('v_baidu' => $v_baidu, 'v_uc' => $v_uc, 'v_qq' => $v_qq);

$tpl -> assign($info);

$eva = new EVA;
// $tpl -> assign("json_radar", $eva->toRadarJson());

$monkey = new Monkey;
$tpl -> assign("json_monkey", $monkey->toJson());

$ldt = new PageLoadRef;
$ldt_test_scenarios = $ldt->run_http_api(sprintf(Constants::$ldt_fetch_scenarios, 'uc',$v_uc));
for ($i=0; $i < count($ldt_test_scenarios); $i++) { 
	$eva_points = $ldt->generateEvaPoints($v_baidu, $v_uc, $v_qq, $ldt_test_scenarios[$i][0]);
	array_push($ldt_test_scenarios[$i], $eva_points);
}

$p_ldt_baidu = 0;
$p_ldt_uc = 0;
$p_ldt_qq = 0;
foreach ($ldt_test_scenarios as $key => $value) {
	$p_ldt_baidu += $value[2]['baidu'];
	$p_ldt_uc += $value[2]['uc'];
	$p_ldt_qq += $value[2]['qq'];
}
$tpl -> assign('ldt_test_scenarios', $ldt_test_scenarios);

$len_ldt = count($ldt_test_scenarios);
$p_ldt_baidu = round($p_ldt_baidu/$len_ldt,1);
$p_ldt_uc = round($p_ldt_uc/$len_ldt,1);
$p_ldt_qq = round($p_ldt_qq/$len_ldt,1);
$tpl -> assign("json_ldt_point", $eva -> generateTotalPoints('页面加载时间评分', $p_ldt_baidu, $p_ldt_uc, $p_ldt_qq));





$cpu = new CPU;
$cpu_test_scenarios = $cpu->run_http_api(sprintf(Constants::$cpu_fetch_scenarios, 'uc',$v_uc));
//print_r($cpu_test_scenarios);
for ($i=0; $i < count($cpu_test_scenarios); $i++) { 
	$cpu_eva_points = $cpu->generateEvaPoints($v_baidu, $v_uc, $v_qq, $cpu_test_scenarios[$i][0]);
	array_push($cpu_test_scenarios[$i], $cpu_eva_points);
}

$p_cpu_baidu = 0;
$p_cpu_uc = 0;
$p_cpu_qq = 0;
foreach ($cpu_test_scenarios as $key => $value) {
	$p_cpu_baidu += $value[2]['baidu'];
	$p_cpu_uc += $value[2]['uc'];
	$p_cpu_qq += $value[2]['qq'];
}

$tpl -> assign('cpu_test_scenarios', $cpu_test_scenarios);


$len_cpu = count($cpu_test_scenarios);
$p_cpu_baidu = round($p_cpu_baidu/$len_cpu,1);
$p_cpu_uc = round($p_cpu_uc/$len_cpu,1);
$p_cpu_qq = round($p_cpu_qq/$len_cpu,1);
$tpl -> assign("json_cpu_point", $eva -> generateTotalPoints('CPU表现评分', $p_cpu_baidu, $p_cpu_uc, $p_cpu_qq));

$mem = new Memory;
$mem_test_scenarios = $mem->run_http_api(sprintf(Constants::$mem_fetch_scenarios, 'uc',$v_uc));
for ($i=0; $i < count($mem_test_scenarios); $i++) { 
	$mem_eva_points = $mem->generateEvaPoints($v_baidu, $v_uc, $v_qq, $mem_test_scenarios[$i][0]);
	array_push($mem_test_scenarios[$i], $mem_eva_points);
}

$p_mem_baidu = 0;
$p_mem_uc = 0;
$p_mem_qq = 0;
foreach ($mem_test_scenarios as $key => $value) {
	$p_mem_baidu += $value[2]['baidu'];
	$p_mem_uc += $value[2]['uc'];
	$p_mem_qq += $value[2]['qq'];
}

$tpl -> assign('mem_test_scenarios', $mem_test_scenarios);

$len_mem = count($mem_test_scenarios);
$p_mem_baidu = round($p_mem_baidu/$len_mem,1);
$p_mem_uc = round($p_mem_uc/$len_mem,1);
$p_mem_qq = round($p_mem_qq/$len_mem,1);
$tpl -> assign("json_mem_point", $eva -> generateTotalPoints('内存表现评分', $p_mem_baidu, $p_mem_uc, $p_mem_qq));

$trf = new Traffic;
$trf_test_scenarios = $trf->run_http_api(sprintf(Constants::$trf_fetch_scenarios, 'uc',$v_uc));
for ($i=0; $i < count($trf_test_scenarios); $i++) { 
	$trf_eva_points = $trf->generateEvaPoints($v_baidu, $v_uc, $v_qq, $trf_test_scenarios[$i][0]);
	array_push($trf_test_scenarios[$i], $trf_eva_points);
}

$p_trf_baidu = 0;
$p_trf_uc = 0;
$p_trf_qq = 0;
foreach ($trf_test_scenarios as $key => $value) {
	$p_trf_baidu += $value[2]['baidu'];
	$p_trf_uc += $value[2]['uc'];
	$p_trf_qq += $value[2]['qq'];
}

$tpl -> assign('trf_test_scenarios', $trf_test_scenarios);

$len_trf = count($trf_test_scenarios);
$p_trf_baidu = round($p_trf_baidu/$len_trf,1);
$p_trf_uc = round($p_trf_uc/$len_trf,1);
$p_trf_qq = round($p_trf_qq/$len_trf,1);
$tpl -> assign("json_traffic_point", $eva -> generateTotalPoints('省流表现评分', $p_trf_baidu, $p_trf_uc, $p_trf_qq));


$fps = new Fps;
$fps_test_scenarios = $fps->run_http_api(sprintf(Constants::$fps_fetch_scenarios, 'uc',$v_uc));
for ($i=0; $i < count($fps_test_scenarios); $i++) { 
	$fps_eva_points = $fps->generateEvaPoints($v_baidu, $v_uc, $v_qq, $fps_test_scenarios[$i][0]);
	array_push($fps_test_scenarios[$i], $fps_eva_points);
}

$p_fps_baidu = 0;
$p_fps_uc = 0;
$p_fps_qq = 0;
foreach ($fps_test_scenarios as $key => $value) {
	$p_fps_baidu += $value[2]['baidu'];
	$p_fps_uc += $value[2]['uc'];
	$p_fps_qq += $value[2]['qq'];
}

$tpl -> assign('fps_test_scenarios', $fps_test_scenarios);


$len_fps = count($fps_test_scenarios);
$p_fps_baidu = round($p_fps_baidu/$len_fps,1);
$p_fps_uc = round($p_fps_uc/$len_fps,1);
$p_fps_qq = round($p_fps_qq/$len_fps,1);
$tpl -> assign("json_fps_point", $eva -> generateTotalPoints('流畅度表现评分', $p_fps_baidu, $p_fps_uc, $p_fps_qq));



$pow = new Power;
$pow_test_scenarios = $pow->run_http_api(sprintf(Constants::$pow_fetch_scenarios, 'uc',$v_uc));
//print_r($pow_test_scenarios);
for ($i=0; $i < count($pow_test_scenarios); $i++) { 
	$pow_eva_points = $pow->generateEvaPoints($v_baidu, $v_uc, $v_qq, $pow_test_scenarios[$i][0]);
	array_push($pow_test_scenarios[$i], $pow_eva_points);
}

$p_pow_baidu = 0;
$p_pow_uc = 0;
$p_pow_qq = 0;
foreach ($pow_test_scenarios as $key => $value) {
	$p_pow_baidu += $value[2]['baidu'];
	$p_pow_uc += $value[2]['uc'];
	$p_pow_qq += $value[2]['qq'];
}

$tpl -> assign('pow_test_scenarios', $pow_test_scenarios);


$len_pow = count($pow_test_scenarios);
$p_pow_baidu = round($p_pow_baidu/$len_pow,1);
$p_pow_uc = round($p_pow_uc/$len_pow,1);
$p_pow_qq = round($p_pow_qq/$len_pow,1);
$tpl -> assign("json_pow_point", $eva -> generateTotalPoints('省电表现评分', $p_pow_baidu, $p_pow_uc, $p_pow_qq));

$bcm = new Benchmark;
$eva_benchmark_details = $bcm->generateEvaPointsDetails($v_baidu, $v_uc, $v_qq);

$tpl -> assign('eva_benchmark_details', $eva_benchmark_details);

$p_bcm_baidu = 0;
$p_bcm_uc = 0;
$p_bcm_qq = 0;
foreach ($eva_benchmark_details as $key => $value) {
	$p_bcm_baidu += $value['baidu'];
	$p_bcm_uc += $value['uc'];
	$p_bcm_qq += $value['qq'];
}
$len_bcm = count($eva_benchmark_details);
$p_bcm_baidu = round($p_bcm_baidu/$len_bcm,1);
$p_bcm_uc = round($p_bcm_uc/$len_bcm,1);
$p_bcm_qq = round($p_bcm_qq/$len_bcm,1);
$tpl -> assign("json_benchmark_point", $eva -> generateTotalPoints('benchmark表现评分', $p_bcm_baidu, $p_bcm_uc, $p_bcm_qq));


$radar_json = array(
		'chart' => array('caption'=>'浏览内核性能评测', 'canvasBorderAlpha'=>'0', 'yAxisMaxValue'=>'10', 'showLimits'=>'0', 'bgColor'=>'FFFFFF', 'plotBorderThickness' => '1', 'radarSpikeThickness'=>'3', 'divlineColor'=>'9A9F9B', 'anchorRadius'=>'4', 'anchorBorderThickness'=>'2'),
		'categories' => array(array('category'=>array(
			array('label'=>'页面加载时间'),
			array('label'=>'CPU'),
			array('label'=>'内存'),
			array('label'=>'省流表现'),
			//array('label'=>'流畅度'),
			array('label'=>'省电表现'),
			array('label'=>'Benchmark')
		))),
		'dataset' => array(
				array('seriesname'=>'baidu','data'=>array(
					array('value'=>$p_ldt_baidu),
					array('value'=>$p_cpu_baidu),
					array('value'=>$p_mem_baidu),
					array('value'=>$p_trf_baidu),
					//array('value'=>$p_fps_baidu),
					array('value'=>$p_pow_baidu),
					array('value'=>$p_bcm_baidu)
				)),
				array('seriesname'=>'uc','data'=>array(
					array('value'=>$p_ldt_uc),
					array('value'=>$p_cpu_uc),
					array('value'=>$p_mem_uc),
					array('value'=>$p_trf_uc),
					//array('value'=>$p_fps_uc),
					array('value'=>$p_pow_uc),
					array('value'=>$p_bcm_uc)
				)),
				array('seriesname'=>'qq','data'=>array(
					array('value'=>$p_ldt_qq),
					array('value'=>$p_cpu_qq),
					array('value'=>$p_mem_qq),
					array('value'=>$p_trf_qq),
					//array('value'=>$p_fps_qq),
					array('value'=>$p_pow_qq),
					array('value'=>$p_bcm_qq)
				))
		)
	);
$tpl -> assign("json_radar", json_encode($radar_json));


// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_tech', $return_string = true);

// and then draw the output
echo $html;

?>