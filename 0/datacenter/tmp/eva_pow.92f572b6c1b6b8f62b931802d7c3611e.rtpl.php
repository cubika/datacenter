<?php if(!class_exists('raintpl')){exit;}?>﻿<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="tpl/css/main.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="tpl/fancybox/jquery.fancybox.css" media="screen" />

		<script type="text/javascript" src="tpl/js/jquery.min.js"></script>
		<script type="text/javascript" src="tpl/js/FusionCharts.js"></script>
		<script type="text/javascript" src="tpl/js/dc.js"></script>
	</head>
	<body >
		<div id="content"> </div>
		<script type='text/javascript'>
			$(document).ready(function() {
				var f = '/tpl/fusioncharts/common/ZoomLine.swf';
				draw('content', f, '<?php echo $json_content;?>', '100%', 400);
			})
		</script>

	</body>
</html>
