<?php

//include the RainTPL class
include "inc/rain.tpl.class.php";
include "inc/eva.core.benchmark.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$browsers = $_GET['browsers'];
list($baidu, $uc, $qq) = split(',', $browsers);
$tpl -> assign("browsers", $browsers);

$mky = new Monkey;
$mky -> setPoints();
$tpl -> assign("evapoints", $mky -> getPoints());
$tpl -> assign("p_json", $mky -> genPointsJson('Monkey'));

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_monkey', $return_string = true);

// and then draw the output
echo $html;

?>