<?php

include "inc/rain.tpl.class.php";
include "inc/trf.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$trf = new Traffic;
// $v_baidu = $trf->run_http_api(sprintf(Constants::$trf_fetch_versions_by_browser,"baidu"));
// $v_uc = $trf->run_http_api(sprintf(Constants::$trf_fetch_versions_by_browser,"uc"));
// $v_qq = $trf->run_http_api(sprintf(Constants::$trf_fetch_versions_by_browser,"qq"));
// 
// $tpl -> assign("v_baidu", $v_baidu);
// $tpl -> assign("v_uc", $v_uc);
// $tpl -> assign("v_qq", $v_qq);

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);
$pns = $trf->run_http_api(sprintf(Constants::$trf_fetch_pns, $plid));

$versions = array();
foreach ($pns as $key => $value) {
	$ver = $trf->run_http_api(sprintf(Constants::$trf_fetch_versions_by_pn, $plid, $value));
	$versions[$value] = $ver;
}

$tpl -> assign("pns", $pns);
$tpl -> assign("versions", $versions);
$tpl -> assign("module", "trf");

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('trf_eva', $return_string = true);

// and then draw the output
echo $html;
?>