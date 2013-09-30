<?php

include "inc/rain.tpl.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);
$tpl -> assign("module", "mem");

$html = $tpl -> draw('mem_query', $return_string = true);

// and then draw the output
echo $html;
?>