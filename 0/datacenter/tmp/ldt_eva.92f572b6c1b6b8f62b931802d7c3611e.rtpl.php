<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
		<link href="tpl/css/bootstrap-chosen.css" rel="stylesheet">
		<link href="tpl/bootstrap_assets/css/docs.css" rel="stylesheet">
	</head>

	<body>
		<div class="bs-docs-example" d_content="请输入比较条件">
			<ul class="thumbnails">
				<li class="span3">
					<div  class="bs-docs-example" d_content="baidu浏览器">
						<select id="v_baidu" data-placeholder="请选择版本号（必选）" class="chosen-select" tabindex="2">
							<option value=""></option>
							<?php $counter1=-1; if( isset($v_baidu) && is_array($v_baidu) && sizeof($v_baidu) ) foreach( $v_baidu as $key1 => $value1 ){ $counter1++; ?>

							<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
							<?php } ?>

						</select>
						<p></p>
						<select id="v_baidu" data-placeholder="请选择Token（可选）" class="chosen-select" tabindex="2">
							<option value=""></option>
						</select>
					</div>
				</li>
				<li class="span3">

					<div  class="bs-docs-example" d_content="UC浏览器">
						<select id="v_uc" data-placeholder="请选择版本号（必选）" class="chosen-select" tabindex="2">
							<option value=""></option>
							<?php $counter1=-1; if( isset($v_uc) && is_array($v_uc) && sizeof($v_uc) ) foreach( $v_uc as $key1 => $value1 ){ $counter1++; ?>

							<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
							<?php } ?>

						</select>
						<p></p>
						<select id="v_baidu" data-placeholder="请选择Token（可选）" class="chosen-select" tabindex="2">
							<option value=""></option>
						</select>
					</div>
				</li>
				<li class="span3">
					<div  class="bs-docs-example" d_content="QQ浏览器">
						<select id="v_qq" data-placeholder="请选择版本号（必选）" class="chosen-select" tabindex="2">
							<option value=""></option>
							<?php $counter1=-1; if( isset($v_qq) && is_array($v_qq) && sizeof($v_qq) ) foreach( $v_qq as $key1 => $value1 ){ $counter1++; ?>

							<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
							<?php } ?>

						</select>
						<p></p>
						<select id="v_baidu" data-placeholder="请选择Token（可选）" class="chosen-select" tabindex="2">
							<option value=""></option>
						</select>
					</div>
				</li>
			</ul>
			<a id="comp" onclick="compare();" class="btn btn-primary btn-large">比较 &raquo;</a>
		</div>
		<!-- <div >
		<iframe id="ifr" src="" frameborder="0" height="1600" width="100%"></iframe>
		</div> -->
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

					<div class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
						<div class="row-fluid">
							<ul class="thumbnails">
								<li class="span12">
									<div class="thumbnail">
										<div class="caption">
											<div id="ts_<?php echo $value1["0"];?>"></div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>website</th>
									<th>baidu</th>
									<th>uc</th>
									<th>qq</th>
									<th>uc-baidu</th>
									<th>%</th>
									<th>qq-baidu</th>
									<th>%</th>
								</tr>
							</thead>
								<?php $counter2=-1; if( isset($value1["3"]) && is_array($value1["3"]) && sizeof($value1["3"]) ) foreach( $value1["3"] as $key2 => $value2 ){ $counter2++; ?>

								<tr>
									<td><?php echo $counter2+1;?></td>
									<td><?php echo $key2;?></td>
									<td><?php echo $value2['baidu'][0]->avgTimeToStartRender;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToStartRender;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToStartRender;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToStartRender - $value2['baidu'][0]->avgTimeToStartRender;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToStartRender/$value2['baidu'][0]->avgTimeToStartRender - 1;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToStartRender - $value2['baidu'][0]->avgTimeToStartRender;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToStartRender/$value2['baidu'][0]->avgTimeToStartRender - 1;?></td>
								</tr>
								<?php } ?>

							<tbody>
								
							</tbody>

						</table>
					</div>
					<?php } ?>

				</div>
				<div class="tab-pane" id="tab2">
					<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

					<div class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
						<div class="row-fluid">
							<ul class="thumbnails">
								<li class="span12">
									<div class="thumbnail">
										<div class="caption">
											<div id="ttdr_ts_<?php echo $value1["0"];?>"></div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>website</th>
									<th>baidu</th>
									<th>uc</th>
									<th>qq</th>
									<th>uc-baidu</th>
									<th>%</th>
									<th>qq-baidu</th>
									<th>%</th>
								</tr>
							</thead>
								<?php $counter2=-1; if( isset($value1["3"]) && is_array($value1["3"]) && sizeof($value1["3"]) ) foreach( $value1["3"] as $key2 => $value2 ){ $counter2++; ?>

								<tr>
									<td><?php echo $counter2+1;?></td>
									<td><?php echo $key2;?></td>
									<td><?php echo $value2['baidu'][0]->avgTimeToDomReady;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToDomReady;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToDomReady;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToDomReady - $value2['baidu'][0]->avgTimeToDomReady;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToDomReady/$value2['baidu'][0]->avgTimeToDomReady - 1;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToDomReady - $value2['baidu'][0]->avgTimeToDomReady;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToDomReady/$value2['baidu'][0]->avgTimeToDomReady - 1;?></td>
								</tr>
								<?php } ?>

							<tbody>
								
							</tbody>

						</table>
					</div>
					<?php } ?>

				</div>
				<div class="tab-pane active" id="tab3">
					<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

					<div class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
						<div class="row-fluid">
							<ul class="thumbnails">
								<li class="span12">
									<div class="thumbnail">
										<div class="caption">
											<div id="ttpl_ts_<?php echo $value1["0"];?>"></div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>website</th>
									<th>baidu</th>
									<th>uc</th>
									<th>qq</th>
									<th>uc-baidu</th>
									<th>%</th>
									<th>qq-baidu</th>
									<th>%</th>
								</tr>
							</thead>
								<?php $counter2=-1; if( isset($value1["3"]) && is_array($value1["3"]) && sizeof($value1["3"]) ) foreach( $value1["3"] as $key2 => $value2 ){ $counter2++; ?>

								<tr>
									<td><?php echo $counter2+1;?></td>
									<td><?php echo $key2;?></td>
									<td><?php echo $value2['baidu'][0]->avgTimeToPageLoaded;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToPageLoaded;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToPageLoaded;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToPageLoaded - $value2['baidu'][0]->avgTimeToPageLoaded;?></td>
									<td><?php echo $value2['uc'][0]->avgTimeToPageLoaded/$value2['baidu'][0]->avgTimeToPageLoaded - 1;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToPageLoaded - $value2['baidu'][0]->avgTimeToPageLoaded;?></td>
									<td><?php echo $value2['qq'][0]->avgTimeToPageLoaded/$value2['baidu'][0]->avgTimeToPageLoaded - 1;?></td>
								</tr>
								<?php } ?>

							<tbody>
								
							</tbody>

						</table>
					</div>
					<?php } ?>

				</div>
			</div>
		</div>
		<script src="tpl/bootstrap_assets/js/jquery.js"></script>
		<script src="tpl/js/chosen.jquery.js"></script>
		<script src="tpl/js/FusionCharts.js"></script>
		<script src="tpl/js/dc.js"></script>
		<script src="tpl/bootstrap_assets/js/bootstrap-tab.js"></script>
		<script>
			$(function() {
				$('.chosen-select').chosen();
				$('.chosen-select-deselect').chosen({
					allow_single_deselect : true
				});
			});
			function compare() {
				var v_baidu = $("#v_baidu").val();
				var v_uc = $("#v_uc").val();
				var v_qq = $("#v_qq").val();
				// $("#ifr").attr("src", "ldt_eva_content.php?v_baidu=" + v_baidu + "&v_uc=" + v_uc + "&v_qq=" + v_qq);
				$("#comp").attr("href", "ldt_eva.php?v_baidu=" + v_baidu + "&v_uc=" + v_uc + "&v_qq=" + v_qq);
			}
			$(document).ready(function() {

				//var f = '/tpl/fusioncharts/power/MultiAxisLine.swf';
				var f = 'tpl/fusioncharts/common/MSColumn3D.swf';
				<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>

				    //alert('<?php echo $value1["0"];?>');
					draw('ts_<?php echo $value1["0"];?>', f, '<?php echo $value1["2"];?>', '100%', 400);
					draw('ttdr_ts_<?php echo $value1["0"];?>', f, '<?php echo $value1["4"];?>', '100%', 400);
					draw('ttpl_ts_<?php echo $value1["0"];?>', f, '<?php echo $value1["5"];?>', '100%', 400);
				<?php } ?>


			})
		</script>

	</body>
</html>