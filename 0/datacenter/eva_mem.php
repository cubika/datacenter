<?php

//include the RainTPL class
include "inc/rain.tpl.class.php";
include "inc/mem.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];
$tsid = $_GET['tsid'];
$ts = $_GET['ts'];

$mem = new Memory;
$json_tpl = $mem->dashboard($v_baidu, $v_uc, $v_qq, $tsid, $ts);
$tpl -> assign("json_content", $json_tpl);

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_mem', $return_string = true);

// and then draw the output
echo $html;
?>