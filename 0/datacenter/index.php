<?php

include "inc/rain.tpl.class.php";
include "inc/pageload.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$module = $_GET['m'];
if(!$module){
	$module = "ldt";
}
$tpl -> assign("active_".$module, "active");
$tpl -> assign("module", $module);

$pl = new PageLoad;
$v_baidu = $pl->fetchVersionsByBrowser("baidu");
$v_uc = $pl->fetchVersionsByBrowser("uc");
$v_qq = $pl->fetchVersionsByBrowser("qq");

$tpl -> assign("v_baidu", $v_baidu);
$tpl -> assign("v_uc", $v_uc);
$tpl -> assign("v_qq", $v_qq);

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('index', $return_string = true);

// and then draw the output
echo $html;

?>