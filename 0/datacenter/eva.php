<?php

include "inc/rain.tpl.class.php";
include "inc/eva.core.main.php";
//include "eva/eva.core.monkey.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

//get
$v_baidu = $_GET['v_baidu'];
$v_uc = $_GET['v_uc'];
$v_qq = $_GET['v_qq'];

$info = array('v_baidu' => $v_baidu, 'v_uc' => $v_uc, 'v_qq' => $v_qq);

$tpl -> assign($info);


//$monkey = new Monkey;
//$tpl -> assign("json_monkey", $monkey->toJson());

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('eva', $return_string = true);

// and then draw the output
echo $html;

?>