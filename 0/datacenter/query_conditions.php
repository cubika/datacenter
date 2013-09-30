<?php

include 'inc/constants.class.php';
include 'inc/datacenter.class.php';

$dc = new DataCenter;

$plid = $_GET['plid'];
$sel = $_GET['s'];
$mod = $_GET['m'];

$pns = array();
$versions = array();

$pns = $dc->run_http_api(sprintf(Constants::$common_fetch_pns, $mod, $plid));

foreach ($pns as $key => $value) {
	$ver = $dc->run_http_api(sprintf(Constants::$common_fetch_versions_by_pn, $mod, $plid, $value));
	$versions[$value] = $ver;
}

if($sel == 'v'){
	echo json_encode($versions);
}
elseif ($sel == "pn") {
	echo json_encode($pns);
}



?>