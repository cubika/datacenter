<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
		<link href="tpl/css/bootstrap-chosen.css" rel="stylesheet">

	</head>

	<body>
		<div class="hero-unit">
			<div class="row">
				<div class="col-lg-3">
					<select id="browser" data-placeholder="请选择浏览器" class="chosen-select" tabindex="2">
						<option value=""></option>
						<option value="baidu">Baidu</option>
						<option value="UC">UC</option>
						<option value="QQ">QQ</option>
					</select>
				</div>
				<div class="col-lg-3">
					<select id="engine_version" data-placeholder="请选择版本号" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter1=-1; if( isset($versions) && is_array($versions) && sizeof($versions) ) foreach( $versions as $key1 => $value1 ){ $counter1++; ?>

						<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
						<?php } ?>

					</select>
				</div>
			</div>
			<hr>
			<a onclick="query();" class="btn btn-primary btn-large">查询 &raquo;</a>
		</div>
		<div >
			<iframe id="ifr" src="" frameborder="0" height="600" width="100%"></iframe>
		</div>

		<script src="tpl/js/jquery.min.js"></script>
		<script src="tpl/js/chosen.jquery.js"></script>
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
				$("#ifr").attr("src", "mem_query_content.php?browser=" + browser + "&engine_version=" + engine_version);
			}
		</script>

	</body>
</html>