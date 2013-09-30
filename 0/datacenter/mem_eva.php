<?php

include "inc/rain.tpl.class.php";
include "inc/mem.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$mem = new Memory;

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);
$pns = $mem->run_http_api(sprintf(Constants::$mem_fetch_pns, $plid));

$versions = array();
foreach ($pns as $key => $value) {
	$ver = $mem->run_http_api(sprintf(Constants::$mem_fetch_versions_by_pn, $plid, $value));
	$versions[$value] = $ver;
}

$tpl -> assign("pns", $pns);
$tpl -> assign("versions", $versions);
$tpl -> assign("module", "mem");

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('mem_eva', $return_string = true);

// and then draw the output
echo $html;
?>