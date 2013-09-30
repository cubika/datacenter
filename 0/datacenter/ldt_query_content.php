<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
include "inc/dc.util.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$pl = new PageLoadRef();

$browser = $_GET['browser'];
$engine_version = $_GET['engine_version'];

$test_scenarios = $pl->run_http_api(sprintf(Constants::$ldt_fetch_scenarios, $browser, $engine_version));

for ($i=0; $i < count($test_scenarios); $i++) {
	$tsid = $test_scenarios[$i][0];
	$avg_data = $pl->run_http_api(sprintf(Constants::$ldt_fetch_avg_by_browser_version_tsid,$browser, $engine_version, $tsid));
	//$avg_dto = array();
	for ($j=0; $j < count($avg_data); $j++) { 
		$website = $avg_data[$j]->website;
		$website_details = $pl->run_http_api(sprintf(Constants::$ldt_fetch_website_details_by_browser_version_website_tsid,$browser, $engine_version, $website, $tsid));
		$avg_data[$j]->details = $website_details;
		//print_r($avg_data[$j]);exit;
		// $real_details = array();
		// for ($k=0; $k < count($website_details); $k++) { 
			// $website_details[$k]->v_ttsr = Util::getVariance($website_details, "ttsr");
			// $website_details[$k]->v_ttdr = Util::getVariance($website_details, "ttdr");
			// $website_details[$k]->v_ttpl = Util::getVariance($website_details, "ttpl");
// 			
// 			
			// //if($website_details[$k]->v_ttsr < 2000 && $website_details[$k]->v_ttdr < 2000 && $website_details[$k]->v_ttpl < 2000) {
				// array_push($real_details, $website_details[$k]);
			// //}
		// }
// 		
		// //avg
		// if(count($real_details) > 0){
// 			
			// $avg_ttsr = round(Util::getAverage($real_details, "ttsr"),2);
			// $avg_ttdr = round(Util::getAverage($real_details, "ttdr"),2);
			// $avg_ttpl = round(Util::getAverage($real_details, "ttpl"),2);
// 		
			// $tmp = new stdClass;
			// $tmp->id = $real_details[0]->id;
			// $tmp->website = $real_details[0]->website;
			// $tmp->browser = $real_details[0]->browser;
			// $tmp->engineVersion = $real_details[0]->engineVersion;
			// $tmp->tsid = $real_details[0]->testScenarioId;
			// $tmp->avgTTSR = $avg_ttsr;
			// $tmp->avgTTDR = $avg_ttdr;
			// $tmp->avgTTPL = $avg_ttpl;
// 			
			// array_push($avg_dto, $tmp);
		// }
		
	}

	
	array_push($test_scenarios[$i], $avg_data);
	//print_r($test_scenarios[$i]);exit;
}




$tpl -> assign('test_scenarios', $test_scenarios);


// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('ldt_query', $return_string = true);

// and then draw the output
echo $html;
?>