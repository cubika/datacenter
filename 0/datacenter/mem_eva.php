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
$v_baidu = $mem->run_http_api(sprintf(Constants::$mem_fetch_versions_by_browser,"baidu"));
$v_uc = $mem->run_http_api(sprintf(Constants::$mem_fetch_versions_by_browser,"uc"));
$v_qq = $mem->run_http_api(sprintf(Constants::$mem_fetch_versions_by_browser,"qq"));

$tpl -> assign("v_baidu", $v_baidu);
$tpl -> assign("v_uc", $v_uc);
$tpl -> assign("v_qq", $v_qq);

// you can draw the output
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('mem_eva', $return_string = true);

// and then draw the output
echo $html;
?>