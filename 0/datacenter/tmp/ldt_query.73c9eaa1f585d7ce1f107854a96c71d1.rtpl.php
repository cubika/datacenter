<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
		<link href="tpl/css/bootstrap-chosen.css" rel="stylesheet">
		<link href="tpl/bootstrap_assets/css/docs.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="tpl/fancybox/jquery.fancybox.css" media="screen" />
	</head>

	<body>
		<div class="bs-docs-example" d_content="请输入查询条件">
			<ul class="thumbnails">
				<li class="span3">
					<select id="browser" data-placeholder="请选择浏览器（必选）" class="chosen-select" tabindex="2">
						<option value=""></option>
						<option value="baidu">Baidu</option>
						<option value="UC">UC</option>
						<option value="QQ">QQ</option>
					</select>
				</li>
				<li class="span3">
					<select id="engine_version" data-placeholder="请选择版本号（必选）" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter1=-1; if( isset($versions) && is_array($versions) && sizeof($versions) ) foreach( $versions as $key1 => $value1 ){ $counter1++; ?>

						<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
						<?php } ?>

					</select>
				</li>
				<li class="span3">
					<select id="engine_version" data-placeholder="请选择Token（可选）" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter1=-1; if( isset($versions) && is_array($versions) && sizeof($versions) ) foreach( $versions as $key1 => $value1 ){ $counter1++; ?>

						<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
						<?php } ?>

					</select>
				</li>
			</ul>
			<a id="qry" onclick="query();" class="btn btn-primary btn-large">查询 &raquo;</a>
		</div>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li >
					<a href="#tab1" data-toggle="tab">开始渲染时间</a>
				</li>
				<li >
					<a href="#tab2" data-toggle="tab">DOM Ready时间</a>
				</li>
				<li class="active">
					<a href="#tab3" data-toggle="tab">页面加载完成时间</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane " id="tab1">
					<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

					<div id="ld-table" class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>website</th>
									<th>浏览器</th>
									<th>版本号</th>
									<th>平均值</th>
									<th>标准差/平均值</th>
									<?php $counter2=-1; if( isset($value1["2"]["0"]->details) && is_array($value1["2"]["0"]->details) && sizeof($value1["2"]["0"]->details) ) foreach( $value1["2"]["0"]->details as $key2 => $value2 ){ $counter2++; ?>

									<th>第<?php echo $counter2+1;?>轮</th>
									<?php } ?>


								</tr>
							</thead>

							<tbody>
								<?php $counter2=-1; if( isset($value1["2"]) && is_array($value1["2"]) && sizeof($value1["2"]) ) foreach( $value1["2"] as $key2 => $value2 ){ $counter2++; ?>

								<tr>
									<td><?php echo $counter2+1;?></td>
									<td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>"><?php echo $value2->website;?></a></td>
									<td><?php echo $value2->browser;?></td>
									<td><?php echo $value2->engineVersion;?></td>
									<td><?php echo $value2->avgTimeToStartRender;?></td>
									<td><?php echo $value2->v_ttsr;?></td>
									<?php $counter3=-1; if( isset($value2->details) && is_array($value2->details) && sizeof($value2->details) ) foreach( $value2->details as $key3 => $value3 ){ $counter3++; ?>

									<td><?php echo $value3->timeToStartRender;?></td>
									<?php } ?>

									<!-- <td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>">查看</a></td> -->
								</tr>
								<?php } ?>

							</tbody>

						</table>
					</div>
					<?php } ?>

				</div>
				<div class="tab-pane " id="tab2">
					<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

					<div id="ld-table" class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>website</th>
									<th>浏览器</th>
									<th>版本号</th>
									<th>平均值</th>
									<th>标准差/平均值</th>
									<?php $counter2=-1; if( isset($value1["2"]["0"]->details) && is_array($value1["2"]["0"]->details) && sizeof($value1["2"]["0"]->details) ) foreach( $value1["2"]["0"]->details as $key2 => $value2 ){ $counter2++; ?>

									<th>第<?php echo $counter2+1;?>轮</th>
									<?php } ?>


								</tr>
							</thead>

							<tbody>
								<?php $counter2=-1; if( isset($value1["2"]) && is_array($value1["2"]) && sizeof($value1["2"]) ) foreach( $value1["2"] as $key2 => $value2 ){ $counter2++; ?>

								<tr>
									<td><?php echo $counter2+1;?></td>
									<td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>"><?php echo $value2->website;?></a></td>
									<td><?php echo $value2->browser;?></td>
									<td><?php echo $value2->engineVersion;?></td>
									<td><?php echo $value2->avgTimeToDomReady;?></td>
									<td><?php echo $value2->v_ttdr;?></td>
									<?php $counter3=-1; if( isset($value2->details) && is_array($value2->details) && sizeof($value2->details) ) foreach( $value2->details as $key3 => $value3 ){ $counter3++; ?>

									<td><?php echo $value3->timeToDomReady;?></td>
									<?php } ?>

									<!-- <td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>">查看</a></td> -->
								</tr>
								<?php } ?>

							</tbody>

						</table>
					</div>
					<?php } ?>

				</div>
				<div class="tab-pane active" id="tab3">
					<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

					<div id="ld-table" class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>website</th>
									<th>浏览器</th>
									<th>版本号</th>
									<th>平均值</th>
									<th>标准差/平均值</th>
									<?php $counter2=-1; if( isset($value1["2"]["0"]->details) && is_array($value1["2"]["0"]->details) && sizeof($value1["2"]["0"]->details) ) foreach( $value1["2"]["0"]->details as $key2 => $value2 ){ $counter2++; ?>

									<th>第<?php echo $counter2+1;?>轮</th>
									<?php } ?>


								</tr>
							</thead>

							<tbody>
								<?php $counter2=-1; if( isset($value1["2"]) && is_array($value1["2"]) && sizeof($value1["2"]) ) foreach( $value1["2"] as $key2 => $value2 ){ $counter2++; ?>

								<tr>
									<td><?php echo $counter2+1;?></td>
									<td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>"><?php echo $value2->website;?></a></td>
									<td><?php echo $value2->browser;?></td>
									<td><?php echo $value2->engineVersion;?></td>
									<td><?php echo $value2->avgTimeToPageLoaded;?></td>
									<td><?php echo $value2->v_ttpl;?></td>
									<?php $counter3=-1; if( isset($value2->details) && is_array($value2->details) && sizeof($value2->details) ) foreach( $value2->details as $key3 => $value3 ){ $counter3++; ?>

									<td><?php echo $value3->timeToPageLoaded;?></td>
									<?php } ?>

									<!-- <td><a class="fancybox fancybox.iframe" href="ldt_query_content_details.php?browser=<?php echo $value2->browser;?>&engineVersion=<?php echo $value2->engineVersion;?>&website=<?php echo $value2->website;?>&tsid=<?php echo $value2->tsid;?>">查看</a></td> -->
								</tr>
								<?php } ?>

							</tbody>

						</table>
					</div>
					<?php } ?>

				</div>
			</div>
		</div>
		<script src="tpl/js/jquery.min.js"></script>
		<script src="tpl/js/chosen.jquery.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-tab.js"></script>
		<script src="tpl/fancybox/jquery.fancybox.js"></script>
		<script>
			$(function() {
				$('.chosen-select').chosen();
				$('.chosen-select-deselect').chosen({
					allow_single_deselect : true
				});
			});
			function query() {
				var browser = $("#browser").val();
				var engine_version = $("#engine_version").val();
				//$("#ifr").attr("src", "ldt_query_content.php?browser=" + browser + "&engine_version=" + engine_version);
				$("#qry").attr("href", "ldt_query.php?browser=" + browser + "&engine_version=" + engine_version);
			}
			$(document).ready(function() {
				$('.fancybox').fancybox();
			})
		</script>

	</body>
</html>