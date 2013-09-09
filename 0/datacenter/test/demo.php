<?php

include "inc/rain.tpl.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$filename = "test.json";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize ($filename));
fclose($handle);

$tpl -> assign("content", $contents);

// you can draw the output
// $tpl->draw( 'page' );
// or the template output string by setting $return_string = true:
$html = $tpl -> draw('demo', $return_string = true);

// and then draw the output
echo $html;

?>