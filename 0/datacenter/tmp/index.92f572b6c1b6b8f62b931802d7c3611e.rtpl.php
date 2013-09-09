<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sumeru, 数据中心</title>

		<!-- Le styles -->
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="tpl/fancybox/jquery.fancybox.css" media="screen" />
		<link href="tpl/css/bootstrap-chosen.css" rel="stylesheet">
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}

			@media (max-width: 980px) {
				/* Enable use of floated navbar text */
				.navbar-text.pull-right {
					float: none;
					padding-left: 5px;
					padding-right: 5px;
				}
			}
		</style>
		<link href="tpl/bootstrap_assets/css/bootstrap-responsive.css" rel="stylesheet">

		<body>

			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid">
						<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="brand" href="#">Sumeru 数据中心</a>
						<div class="nav-collapse collapse">
							<p class="navbar-text pull-right">
								Logged in as <a href="#" class="navbar-link">Username</a>
							</p>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span3">
						<div class="well sidebar-nav">
							<ul class="nav nav-list">
								<li class="nav-header">
									基础性能
								</li>
								<li class="<?php echo $active_ldt;?>">
									<a href="index.php?m=ldt">页面加载时间</a>
								</li>
								<li class="<?php echo $active_cpu;?>">
									<a href="index.php?m=cpu">CPU</a>
								</li>
								<li class="<?php echo $active_mem;?>">
									<a href="index.php?m=mem">内存</a>
								</li>
								<li class="<?php echo $active_trf;?>">
									<a href="index.php?m=trf">流量</a>
								</li>
								<li class="<?php echo $active_pow;?>">
									<a href="index.php?m=pow">耗电量</a>
								</li>
								<li class="<?php echo $active_fps;?>">
									<a href="index.php?m=fps">流畅度</a>
								</li>
								<li class="<?php echo $active_benchmark;?>">
									<a href="index.php?m=benchmark">Benchmark</a>
								</li>
								<li class="nav-header">
									稳定性
								</li>
								<li class="<?php echo $active_mky;?>">
									<a href="index.php?m=mky">Monkey</a>
								</li>
								<li class="nav-header">
									兼容性
								</li>
								<li class="<?php echo $active_wpc;?>">
									<a href="index.php?m=wpc">网页兼容性</a>
								</li>
								
							</ul>
						</div><!--/.well -->

						<div class="row-fluid">
							<div class="span12">
								<div class="well sidebar-nav">
									<ul class="nav nav-list">
										<li class="nav-header">
											评测
										</li>
										<li class="<?php echo $active_eva;?>">
											<a href="index.php?m=eva">一键生成评测报告</a>
										</li>
									</ul>
								</div><!--/.well -->
							</div><!--/span-->
						</div><!--/row-->
					</div><!--/span-->

					<?php if( $module==eva ){ ?>

					<div class="span9">

						<div class="hero-unit">
							<div class="row">
								<div class="col-lg-3">
									<select id="v_baidu" data-placeholder="请选择Baidu版本号" class="chosen-select" tabindex="2">
										<option value=""></option>
										<?php $counter1=-1; if( isset($v_baidu) && is_array($v_baidu) && sizeof($v_baidu) ) foreach( $v_baidu as $key1 => $value1 ){ $counter1++; ?>

										<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
										<?php } ?>

									</select>
								</div>
								<div class="col-lg-3">
									<select id="v_uc" data-placeholder="请选择UC版本号" class="chosen-select" tabindex="2">
										<option value=""></option>
										<?php $counter1=-1; if( isset($v_uc) && is_array($v_uc) && sizeof($v_uc) ) foreach( $v_uc as $key1 => $value1 ){ $counter1++; ?>

										<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
										<?php } ?>

									</select>
								</div>
								<div class="col-lg-3">
									<select id="v_qq" data-placeholder="请选择QQ版本号" class="chosen-select" tabindex="2">
										<option value=""></option>
										<?php $counter1=-1; if( isset($v_qq) && is_array($v_qq) && sizeof($v_qq) ) foreach( $v_qq as $key1 => $value1 ){ $counter1++; ?>

										<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
										<?php } ?>

									</select>
								</div>
							</div>
							<hr>
							<a class="btn btn-primary btn-large" onclick="eva();" >一键生成评测报告 &raquo;</a>
						</div>
					</div>
					<?php }else{ ?>

					<div class="span9">
						<div class="tabbable">
							<!-- Only required for left/right tabs -->
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab1" data-toggle="tab">数据查询</a>
								</li>
								<!-- <li >
									<a href="#tab2" data-toggle="tab">Daily质量监控</a>
								</li> -->
								<li >
									<a href="#tab4" data-toggle="tab">竞品比较</a>
								</li>
							</ul>
							
							<div class="tab-content">
								<div class="tab-pane active " id="tab1">
									<iframe src="<?php echo $module;?>_query.php" frameborder="0" height="1000" width="100%"></iframe>
								</div>
								<!-- <div class="tab-pane " id="tab2">
									<iframe src="<?php echo $module;?>_daily_dashboard.php" frameborder="0" height="1000" width="100%"></iframe>
								</div> -->
								<div class="tab-pane" id="tab4">
									<iframe src="<?php echo $module;?>_eva.php" frameborder="0" height="1800" width="100%"></iframe>
								</div>
							</div>

						</div>
					</div><!--/span-->
					<?php } ?>


				</div><!--/row-->

				<hr>

				<footer>
					<p align="center">
						&copy; SumeruQA 2013
					</p>
				</footer>

			</div><!--/.fluid-container-->

			<!-- Le javascript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
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

			<script src="tpl/fancybox/jquery.fancybox.js"></script>
			<script src="tpl/js/chosen.jquery.js"></script>

			<script>
				function eva() {
					var v_baidu = $("#v_baidu").val();
					var v_uc = $("#v_uc").val();
					var v_qq = $("#v_qq").val();
					window.open("eva.php?v_baidu=" + v_baidu + "&v_uc=" + v_uc + "&v_qq=" + v_qq);
				}

				$(function() {
					$('.chosen-select').chosen();
					$('.chosen-select-deselect').chosen({
						allow_single_deselect : true
					});
				});

				$(document).ready(function() {
					$('.fancybox').fancybox();
				})
			</script>

		</body>
</html>
