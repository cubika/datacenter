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
		<div id="ld-table" class="bs-docs-example" d_content="<?php echo $ts;?>:站点详细打分">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>website</th>
						<th>百度浏览器</th>
						<th>UC浏览器</th>
						<th>QQ浏览器</th>
					</tr>
				</thead>

				<tbody>
					<?php $counter1=-1; if( isset($eva_points_by_website) && is_array($eva_points_by_website) && sizeof($eva_points_by_website) ) foreach( $eva_points_by_website as $key1 => $value1 ){ $counter1++; ?>

					<tr>
						<td><?php echo $counter1+1;?></td>
						<td><?php echo $key1;?></td>
						<td><?php echo $value1['baidu'];?></td>
						<td><?php echo $value1['uc'];?></td>
						<td><?php echo $value1['qq'];?></td>
					</tr>
					<?php } ?>

				</tbody>

			</table>
		</div>

	</body>
</html>