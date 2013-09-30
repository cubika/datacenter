<?php

include "inc/rain.tpl.class.php";
include "inc/fps.class.php";
if(!class_exists('Constants')){ include 'inc/constants.class.php'; }

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$fps = new Fps;

$versions = $fps->run_http_api(Constants::$fps_fetch_versions);
$tpl->assign("versions", $versions);
$html = $tpl -> draw('fps_query', $return_string = true);

// and then draw the output
echo $html;
?>