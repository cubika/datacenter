<?php

include 'inc/constants.class.php';
include 'inc/datacenter.class.php';

$dc = new DataCenter;

$v_baidu = $dc->run_http_api(sprintf(Constants::$fps_fetch_versions_by_browser,"baidu"));
$v_uc = $dc->run_http_api(sprintf(Constants::$fps_fetch_versions_by_browser,"uc"));
$v_qq = $dc->run_http_api(sprintf(Constants::$fps_fetch_versions_by_browser,"qq"));

$versions = array("baidu"=>$v_baidu,"uc"=>$v_uc,"qq"=>$v_qq);

echo json_encode($versions);

?>