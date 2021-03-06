<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }
include "inc/dc.util.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$plid = $_GET['plid'];
$tpl -> assign("plid", $plid);
$tpl -> assign("module", "ldt");

$pl = new PageLoadRef();

$versions = $pl->run_http_api(sprintf(Constants::$ldt_fetch_versions,$plid));
$tpl->assign("versions", $versions);


$html = $tpl -> draw('ldt_query', $return_string = true);

// and then draw the output
echo $html;
?>