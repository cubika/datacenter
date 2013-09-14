<?php
header("Content-Type:   application/msword");
header("Content-Disposition:   attachment;   filename=doc.doc"); //指定文件名称
header("Pragma:   no-cache");
header("Expires:   0");
$html='<html>
		<head>
			<style>
				table,th,td{ border:1px solid black;}
				table{border-collapse:collapse;}
				th,td{padding: 5px;}
				h1{text-align:center;}
			</style>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>
		<body>
			<h1>浏览内核评测报告</h1>
			<h2>一、性能评测</h2>
			<h3>1.雷达图</h3>
			FLASH HERE
			<h3>2.平均加载时间</h3>
				<h4>综合评分</h4>
				  FLASH HERE
				<h4>详细评测场景评分</h4><br>'.$_POST["ldt"].
			  '
			 <h3>3.CPU</h3>
			  	<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["cpu"].
			  	'
			 <h3>4.内存</h3>
			  		<h4>综合评分</h4>
			  		FLASH HERE
			  		<h4>详细评测场景评分</h4><br>'.$_POST["mem"].
			  	'
			 <h3>5.流量</h3>
			  		<h4>综合评分</h4>
			  		FLASH HERE
			  		<h4>详细评测场景评分</h4><br>'.$_POST["trf"].
			  	'
			 <h3>6.流畅度</h3>
			  		<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["fps"].
			  	 '
			 <h3>7.耗电量</h3>
			  	 	<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["pow"].
			  	 '
			 <h3>8.Benchmark</h3>
			  	 	<h4>综合评分</h4>
			  		FLASH HERE
			  	<h4>详细评测场景评分</h4><br>'.$_POST["ben"].
			  	 '
			 <h2>二、稳定性评测</h2>
			 <h2>三、兼容性评测</h2>
		</body>
		</html>
		';
echo  $html;
?>