<?php

include "inc/rain.tpl.class.php";
include "inc/mem.class.php";
include "inc/constants.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$mem = new Memory;

$browser = $_GET['browser'];
$engine_version = $_GET['engine_version'];

$test_scenarios = $mem->run_http_api(sprintf(Constants::$mem_fetch_scenarios, $browser, $engine_version));

for ($i=0; $i < count($test_scenarios); $i++) {
	$tsid = $test_scenarios[$i][0];
	$details = $mem->run_http_api(sprintf(Constants::$mem_fetch_details_by_browser_version_tsid, $browser, $engine_version, $tsid));
	array_push($test_scenarios[$i], $details);
}

//print_r($test_scenarios);
$tpl -> assign('test_scenarios', $test_scenarios);


// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('mem_query_content', $return_string = true);

// and then draw the output
echo $html;
?>