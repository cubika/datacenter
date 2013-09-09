<?php if(!class_exists('raintpl')){exit;}?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta name="author" content="Luka Cvrk (cssMoban.com.com)" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="tpl/js/jquery.min.js"></script>
		<script type="text/javascript" src="tpl/js/FusionCharts.js"></script>
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="tpl/fancybox/jquery.fancybox.css" media="screen" />
	</head>
	<body >

		<div class="wrap">
			<div id="left">
				<p>
					<h3>一、性能评测</h3>
					<div class="tabbable">
						<ul class="nav nav-pills">
							<li class="active">
								<a href="#tab1" data-toggle="tab">雷达图</a>
							</li>
							<li >
								<a href="#tab2" data-toggle="tab">1. 页面加载时间</a>
							</li>
							<li >
								<a href="#tab3" data-toggle="tab">2. CPU</a>
							</li>
							<li >
								<a href="#tab4" data-toggle="tab">3. 内存</a>
							</li>
							<li>
								<a href="#tab5" data-toggle="tab">4. 流量</a>
							</li>
							<li>
								<a href="#tab6" data-toggle="tab">5. 流畅度</a>
							</li>
							<li>
								<a href="#tab7" data-toggle="tab">6. 耗电量</a>
							</li>
							<li>
								<a href="#tab8" data-toggle="tab">7. Benchmark</a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<div id="perf_radar"></div>
							</div>
							<div class="tab-pane " id="tab2">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="ldt_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($ldt_test_scenarios) && is_array($ldt_test_scenarios) && sizeof($ldt_test_scenarios) ) foreach( $ldt_test_scenarios as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_ldt.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>"><?php echo $value1["1"];?></td>
												<td><?php echo $value1["2"]['baidu'];?></td>
												<td><?php echo $value1["2"]['uc'];?></td>
												<td><?php echo $value1["2"]['qq'];?></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
							<div class="tab-pane" id="tab3">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="cpu_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
													<th>各站点详细打分</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($cpu_test_scenarios) && is_array($cpu_test_scenarios) && sizeof($cpu_test_scenarios) ) foreach( $cpu_test_scenarios as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_cpu.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>"><?php echo $value1["1"];?></td>
												<td><?php echo $value1["2"]['baidu'];?></td>
												<td><?php echo $value1["2"]['uc'];?></td>
												<td><?php echo $value1["2"]['qq'];?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_cpu_details.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>">查看</a></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
							<div class="tab-pane" id="tab4">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="mem_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($mem_test_scenarios) && is_array($mem_test_scenarios) && sizeof($mem_test_scenarios) ) foreach( $mem_test_scenarios as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_mem.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>"><?php echo $value1["1"];?></td>
												<td><?php echo $value1["2"]['baidu'];?></td>
												<td><?php echo $value1["2"]['uc'];?></td>
												<td><?php echo $value1["2"]['qq'];?></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
							<div class="tab-pane" id="tab5">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="traffic_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($trf_test_scenarios) && is_array($trf_test_scenarios) && sizeof($trf_test_scenarios) ) foreach( $trf_test_scenarios as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_trf.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>"><?php echo $value1["1"];?></td>
												<td><?php echo $value1["2"]['baidu'];?></td>
												<td><?php echo $value1["2"]['uc'];?></td>
												<td><?php echo $value1["2"]['qq'];?></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
							<div class="tab-pane" id="tab6">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="fps_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($fps_test_scenarios) && is_array($fps_test_scenarios) && sizeof($fps_test_scenarios) ) foreach( $fps_test_scenarios as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_fps.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>"><?php echo $value1["1"];?></td>
												<td><?php echo $value1["2"]['baidu'];?></td>
												<td><?php echo $value1["2"]['uc'];?></td>
												<td><?php echo $value1["2"]['qq'];?></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
							<div class="tab-pane" id="tab7">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="power_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($pow_test_scenarios) && is_array($pow_test_scenarios) && sizeof($pow_test_scenarios) ) foreach( $pow_test_scenarios as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_pow.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $value1["0"];?>&ts=<?php echo $value1["1"];?>"><?php echo $value1["1"];?></td>
												<td><?php echo $value1["2"]['baidu'];?></td>
												<td><?php echo $value1["2"]['uc'];?></td>
												<td><?php echo $value1["2"]['qq'];?></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
							<div class="tab-pane" id="tab8">
								<div>
									<ul>
										<li><h4>综合评分</h4></li>
										<div id="benchmark_total"></div>
										<li><h4>详细评测场景评分</h4></li>
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>评测场景</th>
													<th>百度浏览器</th>
													<th>UC浏览器</th>
													<th>QQ浏览器</th>
												</tr>
											</thead>
											<tbody>
											<?php $counter1=-1; if( isset($eva_benchmark_details) && is_array($eva_benchmark_details) && sizeof($eva_benchmark_details) ) foreach( $eva_benchmark_details as $key1 => $value1 ){ $counter1++; ?>
											<tr>
												<td><?php echo $counter1+1;?></td>
												<td><a class="fancybox fancybox.iframe" href="/eva_benchmark.php?v_baidu=<?php echo $v_baidu;?>&v_uc=<?php echo $v_uc;?>&v_qq=<?php echo $v_qq;?>&tsid=<?php echo $key1;?>"><?php echo $key1;?></td>
												<td><?php echo $value1['baidu'];?></td>
												<td><?php echo $value1['uc'];?></td>
												<td><?php echo $value1['qq'];?></td>
											</tr>
											<?php } ?>
											</tbody> 
										</table>
									</ul>

								</div>
							</div>
						</div>

					</div>
				</p>
			</div>

			<h3>二、稳定性评测</h3>
			<div class="tabbable">
				<ul class="nav nav-pills">
					<li class="active">
						<a href="#tab21" data-toggle="tab">Monkey</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab21">
						<div id="monkey"></div>
					</div>
				</div>
			</div>
			<h3>三、兼容性评测</h3>
			<div class="tabbable">
				<ul class="nav nav-pills">
					<li class="active">
						<a href="#tab31" data-toggle="tab">网页兼容性</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab31">
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
		<script src="tpl/fancybox/jquery.fancybox.js"></script>
		<script src="tpl/js/dc.js"></script>
		<script type='text/javascript'>
			$(document).ready(function() {
				$('.fancybox').fancybox();
				
				var f_radar = 'tpl/fusioncharts/power/Radar.swf';
				draw('perf_radar', f_radar, '<?php echo $json_radar;?>', 600, 300);

				var f_mal = 'tpl/	fusioncharts/common/ScrollCombiDY2D.swf';
				draw('monkey', f_mal, '<?php echo $json_monkey;?>', 600, 300);
				
				var f_c2d = 'tpl/fusioncharts/common/Column2D.swf';
				draw('ldt_total', f_c2d, '<?php echo $json_ldt_point;?>', 600, 300);
				draw('cpu_total', f_c2d, '<?php echo $json_cpu_point;?>', 600, 300);
				draw('mem_total', f_c2d, '<?php echo $json_mem_point;?>', 600, 300);
				draw('traffic_total', f_c2d, '<?php echo $json_traffic_point;?>', 600, 300);
				draw('fps_total', f_c2d, '<?php echo $json_fps_point;?>', 600, 300);
				draw('power_total', f_c2d, '<?php echo $json_pow_point;?>', 600, 300);
				draw('benchmark_total', f_c2d, '<?php echo $json_benchmark_point;?>', 600, 300);
				
			})

		</script>

	</body>
</html>
