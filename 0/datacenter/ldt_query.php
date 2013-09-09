<?php

include "inc/rain.tpl.class.php";
include "inc/pageload-ref.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$pl = new PageLoadRef();

$versions = $pl->run_http_api(Constants::$ldt_fetch_versions);
$tpl->assign("versions", $versions);

$html = $tpl -> draw('ldt_query', $return_string = true);

// and then draw the output
echo $html;
?>