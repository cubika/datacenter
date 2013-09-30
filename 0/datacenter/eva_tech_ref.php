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
if (!class_exists('DataCenter')) {
	include 'inc/datacenter.class.php';
}
include "inc/menu.class.php";
if (!class_exists('Constants')) {
	include 'inc/constants.class.php';
}

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
//raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$eva = new EVA;

$dc = new DataCenter;

$pns = $_GET['pns'];
$tpl -> assign('pns', $pns);

$_pns = $dc -> parsePNS($pns);

$plid = $_GET['plid'];
$tpl -> assign('plid', $plid);

$productLine = $dc->run_http_api(sprintf(Constants::$product_fetch_name, $plid));
$tpl -> assign("productLine", $productLine[0]->product);

$menu = new Menu;
$menus = $menu -> classifyMenu($plid);

//print_r($menus);exit ;
$radars = array();

foreach ($menus as $mkey => $mvalue) {
	$radar = array('chart' => array('caption' => '', 'canvasBorderAlpha' => '0', 'yAxisMaxValue' => '10', 'showLimits' => '0', 'bgColor' => 'FFFFFF', 'plotBorderThickness' => '1', 'radarSpikeThickness' => '3', 'divlineColor' => '9A9F9B', 'anchorRadius' => '4', 'anchorBorderThickness' => '2'), 'categories' => array( array('category' => array())), 'dataset' => array());

	foreach ($_pns as $key => $value) {
		array_push($radar['dataset'], array('seriesname' => $key, 'data' => array()));
	}

	foreach ($mvalue as $index => $item) {
		$m = $item -> dataModule;

		if ($item -> dataModule == "ldt") {
			$dc = new PageLoadRef;
		} elseif ($item -> dataModule == "cpu") {
			$dc = new CPU;
		} elseif ($item -> dataModule == "mem") {
			$dc = new Memory;
		} elseif ($item -> dataModule == "trf") {
			$dc = new Traffic;
		} elseif ($item -> dataModule == "pow") {
			$dc = new Power;
		} elseif ($item -> dataModule == "benchmark") {
			$dc = new Benchmark;
		} else {
			break;
		}

		$test_scenarios = $dc -> run_http_api(sprintf(Constants::$common_fetch_scenarios, $m, $plid, 'baidu', $_pns['baidu']));

		$_size = count($test_scenarios);
		for ($i = 0; $i < $_size; $i++) {
			$eva_points = $dc -> generateEvaPoints($plid, $_pns, $test_scenarios[$i][0]);
			array_push($test_scenarios[$i], $eva_points);
		}

		//$tpl -> assign('test_scenarios', $test_scenarios);
		foreach ($test_scenarios as $key => $value) {
			$test_scenarios[$key]['mod'] = $m;
		}
		$menus[$mkey][$index] -> test_scenarios = $test_scenarios;

		$p_pns = array();
		foreach ($_pns as $key => $value) {
			$p_pns[$key] = 0;
		}
		foreach ($test_scenarios as $key => $value) {
			foreach ($_pns as $key2 => $value2) {
				$p_pns[$key2] += $value[2][$key2];
			}
		}

		$len_ = count($test_scenarios);
		foreach ($p_pns as $key => $value) {
			$p_pns[$key] = round($value / $len_, 1);
		}

		$json_point = $eva -> generateTotalPoints('评分', $p_pns);

		$menus[$mkey][$index] -> json_point = $json_point;

		array_push($radar['categories'][0]['category'], array('label' => $item -> menuName));
		$counter = 0;
		foreach ($p_pns as $key => $value) {
			array_push($radar['dataset'][$counter++]['data'], array('value' => $value));
		}

	}

	if (count($mvalue) > 0) {
		$radars[$mkey] = json_encode($radar);
	}

	//benchmark
	if ($mkey == "Benchmark") {
		$bcm = new Benchmark;
		$eva_benchmark_details = $bcm -> generateEvaPointsDetails($plid, $_pns);
		$tpl -> assign('eva_benchmark_details', $eva_benchmark_details);
		
		$benchmark_radar = $bcm ->generateRadar($plid, $_pns);
		$tpl -> assign('benchmark_radar', $benchmark_radar);
	}

}

$tpl -> assign("radars", $radars);
$tpl -> assign("menus", $menus);

ksort($_pns);
$tpl -> assign('_pns', $_pns);

// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_tech_ref', $return_string = true);

// and then draw the output
echo $html;
?>