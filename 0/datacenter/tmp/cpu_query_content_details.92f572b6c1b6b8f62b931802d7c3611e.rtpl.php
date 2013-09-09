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
		<div id="ld-table" class="bs-docs-example" d_content="每轮详细数据">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>website</th>
						<th>CPU占用</th>
						<th>浏览器</th>
						<th>版本号</th>
						<th>测试时间</th>
						<th>操作</th>
					</tr>
				</thead>

				<tbody>
					<?php $counter1=-1; if( isset($website_details) && is_array($website_details) && sizeof($website_details) ) foreach( $website_details as $key1 => $value1 ){ $counter1++; ?>

					<tr>
						<td><?php echo $counter1+1;?></td>
						<td><?php echo $value1->website;?></td>
						<td><?php echo $value1->cpuValue;?></td>
						<td><?php echo $value1->browser;?></td>
						<td><?php echo $value1->engineVersion;?></td>
						<td><?php echo $value1->timeStamp;?></td>
						<td><a onclick="del()">删除</a></td>
					</tr>
					<?php } ?>

				</tbody>

			</table>
		</div>

	</body>
	<script>
		function addScriptTag(src) {
			var script = document.createElement('script');
			script.setAttribute("type", "text/javascript");
			script.src = src;
			document.body.appendChild(script);
		}

		function del() {
			addScriptTag("http://172.17.192.11:8080/sdc/page/vers");
		}
	</script>
</html>