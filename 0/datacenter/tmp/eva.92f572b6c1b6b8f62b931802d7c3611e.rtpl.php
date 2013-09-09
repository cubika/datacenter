<?php if(!class_exists('raintpl')){exit;}?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta name="author" content="Luka Cvrk (cssMoban.com.com)" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="tpl/css/main.css" type="text/css" media="screen, projection" />
		<script type="text/javascript" src="tpl/js/jquery.min.js"></script>
		<script type="text/javascript" src="tpl/js/FusionCharts.js"></script>
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
	</head>
	<body >

		<div class="wrap">
				<div align="left">
					<h1> 浏览内核评测报告</h1>
					<div align="center">评测版本：Baidu(<b><?php echo $v_baidu;?></b>) 、 UC(<b><?php echo $v_uc;?></b>) 、 QQ(<b><?php echo $v_qq;?></b>)</div>
				</div>
				<p>
					&nbsp;&nbsp;
				</p>
				<div class="tabbable">
					<!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
						<li >
							<a href="#tab1" data-toggle="tab">总体概述</a>
						</li>
						<li >
							<a href="#tab2" data-toggle="tab">业务指标</a>
						</li>
						<li class="active"	>
							<a href="#tab3" data-toggle="tab">技术指标</a>
						</li>
						<li >
							<a href="#tab4" data-toggle="tab">BadCase</a>
						</li>
						<li>
							<a href="#tab5" data-toggle="tab">用户反馈</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane" id="tab1">
							<iframe src="" frameborder="0" height="1000" width="100%"></iframe>
						</div>
						<div class="tab-pane " id="tab2">
							<iframe src="" frameborder="0" height="1000" width="100%"></iframe>
						</div>
						<div class="tab-pane active" id="tab3">
							<iframe src="eva_tech.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>" frameborder="0" height="2000" width="100%"></iframe>
						</div>
						<div class="tab-pane" id="tab4">
							<iframe src="eva_badcase.php" frameborder="0" height="1000" width="100%"></iframe>
						</div>
						<div class="tab-pane" id="tab5">
							<iframe src="" frameborder="0" height="1000" width="100%"></iframe>
						</div>
					</div>

				</div>

		</div>
		<script src="tpl/bootstrap_assets/js/jquery.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-transition.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-alert.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-modal.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-dropdown.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-scrollspy.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-tab.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-tooltip.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-popover.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-button.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-collapse.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-carousel.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-typeahead.js"></script>
		<script src="tpl/js/dc.js"></script>

	</body>
</html>
