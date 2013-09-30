<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
include "inc/dc.util.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
//raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$pl = new PageLoadRef();

$pn = $_GET['pn'];
$v = $_GET['v'];

$id = $_GET['id'];
if($id != NULL){
	$pl->curl_del(sprintf(Constants::$ldt_del_by_id, $id));
}

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);

$test_scenarios = $pl->run_http_api(sprintf(Constants::$ldt_fetch_scenarios, $plid, $pn, $v));

	for ($i=0; $i < count($test_scenarios); $i++) {
		$tsid = $test_scenarios[$i][0];
		$avg_data = $pl->run_http_api(sprintf(Constants::$ldt_fetch_avg_by_pn_version_tsid, $plid, $pn, $v, $tsid));
		for ($j=0; $j < count($avg_data); $j++) { 
			$website = $avg_data[$j]->website;
			$website_details = $pl->run_http_api(sprintf(Constants::$ldt_fetch_website_details_by_pn_version_website_tsid, $plid, $pn, $v, $website, $tsid));
			$avg_data[$j]->details = $website_details;
			
			$avg_data[$j]->v_ttsr = round(Util::getVariance($website_details, "ttsr") / $avg_data[$j]->avgTimeToStartRender,2);
			$avg_data[$j]->v_ttdr = round(Util::getVariance($website_details, "ttdr") / $avg_data[$j]->avgTimeToDomReady,2);
			$avg_data[$j]->v_ttpl = round(Util::getVariance($website_details, "ttpl") / $avg_data[$j]->avgTimeToPageLoaded,2);
			
			$avg_data[$j]->tsid = $tsid;
		}
		array_push($test_scenarios[$i], $avg_data);
		//print_r($test_scenarios[$i]);exit;
	}
	

$tpl-> assign('test_scenarios', $test_scenarios);


// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('ldt_query_content', $return_string = true);

// and then draw the output
echo $html;
?>