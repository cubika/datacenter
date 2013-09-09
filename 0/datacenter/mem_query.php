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

$versions = $mem->run_http_api(Constants::$mem_fetch_versions);
$tpl->assign("versions", $versions);
$html = $tpl -> draw('mem_query', $return_string = true);

// and then draw the output
echo $html;
?>