<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
	</head>

	<body>
		<div class="row-fluid">
			<ul class="thumbnails">
				<li class="span12">
					<div class="thumbnail">
						<div class="caption">
							<div id="benchmark"> </div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		
		<script src="tpl/bootstrap_assets/js/jquery.js"></script>
		<script src="tpl/js/FusionCharts.js"></script>
		<script src="tpl/js/dc.js"></script>
		<script>
			$(document).ready(function() {

				var f_c2d = 'tpl/fusioncharts/common/MSColumn3D.swf';
				draw('benchmark', f_c2d, '<?php echo $json_benchmark;?>', '100%', 400);

			})
		</script>

	</body>
</html>