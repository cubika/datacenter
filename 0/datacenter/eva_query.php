<?php

include "inc/rain.tpl.class.php";
if (!class_exists('DataCenter')) {
	include 'inc/datacenter.class.php';
}
include "inc/menu.class.php";
if (!class_exists('Constants')) {
	include 'inc/constants.class.php';
}
include "inc/cpu.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;
$dc = new DataCenter;

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);
$productLine = $dc->run_http_api(sprintf(Constants::$product_fetch_name, $plid));
$tpl -> assign("productLine", $productLine[0]->product);

$menu = new Menu;
$menus = $menu->classifyMenu($plid);

$tpl -> assign("menus", $menus);

$default = "";
foreach ($menus as $key => $value) {
	foreach ($value as $_key => $_value) {
		$default = $_value->dataModule;
		break;
	}
	break;
}

$tpl -> assign("default_module", $default);

$cpu = new CPU;
$pns = $cpu->run_http_api(sprintf(Constants::$cpu_fetch_pns, $plid));
$vers = $cpu->run_http_api(sprintf(Constants::$cpu_fetch_versions,$plid));
// 
$tpl -> assign("vers", $vers);
$tpl -> assign("pns", $pns);

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_query', $return_string = true);

// and then draw the output
echo $html;


?>