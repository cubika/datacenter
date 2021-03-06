﻿<?php

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

$needUpdate = array();

/* SETUP DATABASE */

/*替换为你自己的数据库名（可从管理中心查看到）*/
$dbname = 'dFojkTYDCrcEfcKLGRmf';

/*从环境变量里取出数据库连接需要的参数*/
$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
$user = getenv('HTTP_BAE_ENV_AK');
$pwd = getenv('HTTP_BAE_ENV_SK');

/*接着调用mysql_connect()连接服务器*/
$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
if(!$link) {
	die("Connect Server Failed: " . mysql_error());
}
/*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
if(!mysql_select_db($dbname,$link)) {
	die("Select Database Failed: " . mysql_error($link));
}

$result = mysql_query('SELECT * FROM evareport WHERE v_baidu=$v_baidu && v_uc=$v_uc && v_qq=$v_qq');
$row = mysql_fetch_array($sql_result);
$length = count($row);
//TODO: store string

//TODO: get lastest timestamp
// $lastest_monkey = ....
//TODO: if not modified, read database; 

$eva = new EVA;
// $tpl -> assign("json_radar", $eva->toRadarJson());

$monkey = new Monkey;
$json_monkey=$monkey->toJson();
//TODO: modify
$needUpdate["json_monkey"]=$json_monkey;
$tpl -> assign("json_monkey", $json_monkey);

$ldt = new PageLoadRef;
$ldt_test_scenarios = $ldt->run_http_api(sprintf(Constants::$ldt_fetch_scenarios, 'uc',$v_uc));
$ldt_size = count($ldt_test_scenarios);
for ($i=0; $i < $ldt_size; $i++) { 
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
$needUpdate["ldt_test_scenarios"]=$ldt_test_scenarios;
$tpl -> assign('ldt_test_scenarios', $ldt_test_scenarios);

$len_ldt = count($ldt_test_scenarios);
$p_ldt_baidu = round($p_ldt_baidu/$len_ldt,1);
$p_ldt_uc = round($p_ldt_uc/$len_ldt,1);
$p_ldt_qq = round($p_ldt_qq/$len_ldt,1);

$json_ldt_point=$eva -> generateTotalPoints('页面加载时间评分', $p_ldt_baidu, $p_ldt_uc, $p_ldt_qq);
$needUpdate["json_ldt_point"]=$json_ldt_point;
$tpl -> assign("json_ldt_point", $json_ldt_point);



/* cpu */

$cpu = new CPU;
$cpu_test_scenarios = $cpu->run_http_api(sprintf(Constants::$cpu_fetch_scenarios, 'uc',$v_uc));
//print_r($cpu_test_scenarios);
$cpu_size = count($cpu_test_scenarios);
for ($i=0; $i < $cpu_size; $i++) { 
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
$needUpdate["cpu_test_scenarios"]=$cpu_test_scenarios;
$tpl -> assign('cpu_test_scenarios', $cpu_test_scenarios);


$len_cpu = count($cpu_test_scenarios);
$p_cpu_baidu = round($p_cpu_baidu/$len_cpu,1);
$p_cpu_uc = round($p_cpu_uc/$len_cpu,1);
$p_cpu_qq = round($p_cpu_qq/$len_cpu,1);
$json_cpu_point = $eva -> generateTotalPoints('CPU表现评分', $p_cpu_baidu, $p_cpu_uc, $p_cpu_qq);
$needUpdate["json_cpu_point"]=$json_cpu_point;
$tpl -> assign("json_cpu_point", $json_cpu_point);



/* MEM */

$mem = new Memory;
$mem_test_scenarios = $mem->run_http_api(sprintf(Constants::$mem_fetch_scenarios, 'uc',$v_uc));
$mem_size = count($mem_test_scenarios);
for ($i=0; $i < $mem_size; $i++) { 
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
$needUpdate["mem_test_scenarios"]=$mem_test_scenarios;
$tpl -> assign('mem_test_scenarios', $mem_test_scenarios);

$len_mem = count($mem_test_scenarios);
$p_mem_baidu = round($p_mem_baidu/$len_mem,1);
$p_mem_uc = round($p_mem_uc/$len_mem,1);
$p_mem_qq = round($p_mem_qq/$len_mem,1);
$json_mem_point = $eva -> generateTotalPoints('内存表现评分', $p_mem_baidu, $p_mem_uc, $p_mem_qq);
$needUpdate["json_mem_point"]=$json_mem_point;
$tpl -> assign("json_mem_point", $json_mem_point);



/* TRF */

$trf = new Traffic;
$trf_test_scenarios = $trf->run_http_api(sprintf(Constants::$trf_fetch_scenarios, 'uc',$v_uc));
$trf_size = count($trf_test_scenarios);
for ($i=0; $i < $trf_size; $i++) { 
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
$needUpdate["trf_test_scenarios"]=$trf_test_scenarios;
$tpl -> assign('trf_test_scenarios', $trf_test_scenarios);

$len_trf = count($trf_test_scenarios);
$p_trf_baidu = round($p_trf_baidu/$len_trf,1);
$p_trf_uc = round($p_trf_uc/$len_trf,1);
$p_trf_qq = round($p_trf_qq/$len_trf,1);
$json_traffic_point = $eva -> generateTotalPoints('省流表现评分', $p_trf_baidu, $p_trf_uc, $p_trf_qq);
$needUpdate["json_traffic_point"]=$json_traffic_point;
$tpl -> assign("json_traffic_point", $json_traffic_point);



/* FPS */
$fps = new Fps;
$fps_test_scenarios = $fps->run_http_api(sprintf(Constants::$fps_fetch_scenarios, 'uc',$v_uc));
$fps_size = count($fps_test_scenarios);
for ($i=0; $i < $fps_size; $i++) { 
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
$needUpdate["fps_test_scenarios"]=$fps_test_scenarios;
$tpl -> assign('fps_test_scenarios', $fps_test_scenarios);


$len_fps = count($fps_test_scenarios);
$p_fps_baidu = round($p_fps_baidu/$len_fps,1);
$p_fps_uc = round($p_fps_uc/$len_fps,1);
$p_fps_qq = round($p_fps_qq/$len_fps,1);
$json_fps_point = $eva -> generateTotalPoints('流畅度表现评分', $p_fps_baidu, $p_fps_uc, $p_fps_qq);
$needUpdate["json_fps_point"]=$json_fps_point;
$tpl -> assign("json_fps_point",$json_fps_point);



/* POW */

$pow = new Power;
$pow_test_scenarios = $pow->run_http_api(sprintf(Constants::$pow_fetch_scenarios, 'uc',$v_uc));
//print_r($pow_test_scenarios);
$pow_size = count($pow_test_scenarios);
for ($i=0; $i < $pow_size; $i++) { 
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
$needUpdate["pow_test_scenarios"]=$pow_test_scenarios;
$tpl -> assign('pow_test_scenarios', $pow_test_scenarios);


$len_pow = count($pow_test_scenarios);
$p_pow_baidu = round($p_pow_baidu/$len_pow,1);
$p_pow_uc = round($p_pow_uc/$len_pow,1);
$p_pow_qq = round($p_pow_qq/$len_pow,1);
$json_pow_point = $eva -> generateTotalPoints('省电表现评分', $p_pow_baidu, $p_pow_uc, $p_pow_qq);
$needUpdate["json_pow_point"]=$json_pow_point;
$tpl -> assign("json_pow_point", $json_pow_point);



/* BEN */

$bcm = new Benchmark;
$eva_benchmark_details = $bcm->generateEvaPointsDetails($v_baidu, $v_uc, $v_qq);
$needUpdate["eva_benchmark_details"]=$eva_benchmark_details;
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
$json_benchmark_point = $eva -> generateTotalPoints('benchmark表现评分', $p_bcm_baidu, $p_bcm_uc, $p_bcm_qq);
$needUpdate["json_benchmark_point"]=$json_benchmark_point;
$tpl -> assign("json_benchmark_point", $json_benchmark_point);


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
$json_radar = json_encode($radar_json);
$needUpdate["json_radar"]=$json_radar;
$tpl -> assign("json_radar", $json_radar);


// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_tech', $return_string = true);

if($length == 0){
	mysql_query('INSERT INTO evareport VALUES($v_baidu,$v_uc,$v_qq,$json_monkey,
				$ldt_test_scenarios,$json_ldt_point,$cpu_test_scenarios,$json_cpu_point,
				$mem_test_scenarios,$json_mem_point,$trf_test_scenarios,$json_traffic_point,
				$fps_test_scenarios,$json_fps_point,$pow_test_scenarios,$json_pow_point,
				$eva_benchmark_details,$json_benchmark_point,$json_radar);');
}else{
	//TODO: remove uncessary
	mysql_query('UPDATE evareport SET json_monkey=$json_monkey,
				ldt_test_scenarios=$ldt_test_scenarios,json_ldt_point=$json_ldt_point,
				cpu_test_scenarios=$cpu_test_scenarios,json_cpu_point=$json_cpu_point,
				mem_test_scenarios=$mem_test_scenarios,json_mem_point=$json_mem_point,
				trf_test_scenarios=$trf_test_scenarios,json_traffic_point=$json_traffic_point,
				fps_test_scenarios=$fps_test_scenarios,json_fps_point=$json_fps_point,
				pow_test_scenarios=$pow_test_scenarios,json_pow_point=$json_pow_point,
				eva_benchmark_details=$eva_benchmark_details,json_benchmark_point=$json_benchmark_point,
				json_radar=$json_radar;');
}
mysql_close($link);

// and then draw the output
echo $html;

?>