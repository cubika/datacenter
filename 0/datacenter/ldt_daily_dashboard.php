<?php

include "inc/rain.tpl.class.php";
include "inc/pageload.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$pl = new PageLoad();

//$json_wifi_nocache_pc = $page -> daily_fetch("baidu","2G","false","m",1);
//$tpl -> assign('json_wifi_nocache_pc', $json_wifi_nocache_pc);


// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('ldt_daily_dashborad', $return_string = true);

// and then draw the output
echo $html;
?>