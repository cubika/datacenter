<?php

//include the RainTPL class
include "inc/rain.tpl.class.php";
include "inc/benchmark.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];
$tsid = $_GET['tsid'];

$bcm = new Benchmark;
$json_tpl = $bcm->singleChart($tsid, $v_baidu, $v_uc, $v_qq, $bcm->benchmarks[$tsid]['unit']);
$tpl -> assign("json_content", $json_tpl);

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_benchmark', $return_string = true);

// and then draw the output
echo $html;

?>