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

$versions = $ben->run_http_api(Constants::$ben_fetch_versions);
$tpl->assign("versions", $versions);
$html = $tpl -> draw('benchmark_query', $return_string = true);

// and then draw the output
echo $html;
?>