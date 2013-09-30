<?php

//include the RainTPL class
include "inc/rain.tpl.class.php";
include "inc/eva.core.ldt.php";
include "inc/datacenter.class.php";
include "inc/pageload-ref.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;
$dc = new DataCenter;

$plid= $_GET['plid'];

$pns = $_GET['pns'];
$tpl -> assign('pns', $pns);

$_pns = $dc->parsePNS($pns);

$tsid = $_GET['tsid'];
$ts = $_GET['ts'];

$ldt = new PageLoadRef;
$json_tpl = $ldt->dashboard($plid, $_pns, $tsid, $ts);
$tpl -> assign("json_content", $json_tpl);

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva_ldt', $return_string = true);

// and then draw the output
echo $html;
?>