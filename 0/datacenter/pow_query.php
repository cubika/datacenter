<?php

include "inc/rain.tpl.class.php";

raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "tpl/");
// raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$html = $tpl -> draw('pow_query', $return_string = true);

// and then draw the output
echo $html;
?>