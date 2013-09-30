<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Le styles -->
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
		<link href="tpl/bootstrap_assets/css/docs.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="tpl/fancybox/jquery.fancybox.css" media="screen" />

	</head>

	<body>

		<div class="span9">
			<div class="tabbable">
				<!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab1" data-toggle="tab">开始渲染时间</a>
					</li>
					<li >
						<a href="#tab2" data-toggle="tab">DOM Ready时间</a>
					</li>
					<li >
						<a href="#tab3" data-toggle="tab">页面加载完成时间</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active " id="tab1">
						<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

						<div id="ld-table" class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>website</th>
										<th>开始渲染时间(avg)</th>
										<th>DOM Ready时间(avg)</th>
										<th>页面加载完成时间(avg)</th>
										<th>浏览器</th>
										<th>版本号</th>
										<th>详细数据</th>
									</tr>
								</thead>

								<tbody>
									<?php $counter2=-1; if( isset($value1["2"]) && is_array($value1["2"]) && sizeof($value1["2"]) ) foreach( $value1["2"] as $key2 => $value2 ){ $counter2++; ?>

									<tr>
										<td><?php echo $counter2+1;?></td>
										<td><?php echo $value2->website;?></td>
										<td><?php echo $value2->avgTTSR;?></td>
										<td><?php echo $value2->avgTTDR;?></td>
										<td><?php echo $value2->avgTTPL;?></td>
										<td><?php echo $value2->browser;?></td>
										<td><?php echo $value2->engineVersion;?></td>
										<td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>">查看</a></td>
									</tr>
									<?php } ?>

								</tbody>

							</table>
						</div>
						<?php } ?>

					</div>
					<div class="tab-pane " id="tab2">
						
					</div>
					<div class="tab-pane" id="tab3">
						
					</div>
				</div>

			</div>
		</div><!--/span-->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="tpl/bootstrap_assets/js/jquery.js"></script>
		<script src="tpl/fancybox/jquery.fancybox.js"></script>

		<script>
			$(document).ready(function() {
$('.fancybox').fancybox();
})

		</script>

	</body>
</html>