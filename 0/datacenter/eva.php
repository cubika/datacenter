<?php

include "inc/rain.tpl.class.php";
include "inc/eva.core.main.php";
include "inc/datacenter.class.php";
if (!class_exists('Constants')) {
	include 'inc/constants.class.php';
}

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;


$dc = new DataCenter;

$plid = $_GET['plid'];
$tpl -> assign('plid', $plid);

$productLine = $dc->run_http_api(sprintf(Constants::$product_fetch_name, $plid));
$tpl -> assign("productLine", $productLine[0]->product);

$pns = $_GET['pns'];
$tpl -> assign('pns', $pns);

$_pns = $dc->parsePNS($pns);


$tpl -> assign('_pns', $_pns);


//$monkey = new Monkey;
//$tpl -> assign("json_monkey", $monkey->toJson());

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_ref', $return_string = true);

// and then draw the output
echo $html;

?>