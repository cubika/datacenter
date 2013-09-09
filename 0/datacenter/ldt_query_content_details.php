<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
include "inc/dc.util.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }


raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$pl = new PageLoadRef();

$browser = $_GET['browser'];
$engineVersion = $_GET['engineVersion'];
$website = $_GET['website'];
$tsid = $_GET['tsid'];

$website_details = $pl->run_http_api(sprintf(Constants::$ldt_fetch_website_details_by_browser_version_website_tsid,$browser, $engineVersion, $website, $tsid));
		

for ($j=0; $j < count($website_details); $j++) {
	$website_details[$j]->timeStamp = date("Y-m-d H:i:s", $website_details[$j]->timeStamp);//date("Y/m/d H:i:s",$details[$j]->timeStamp);
	$website_details[$j]->v_ttsr = Util::getVariance($website_details, "ttsr");
	$website_details[$j]->v_ttdr = Util::getVariance($website_details, "ttdr");
	$website_details[$j]->v_ttpl = Util::getVariance($website_details, "ttpl");
}

$tpl -> assign('website_details', $website_details);

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('ldt_query_content_details', $return_string = true);

// and then draw the output
echo $html;
?>