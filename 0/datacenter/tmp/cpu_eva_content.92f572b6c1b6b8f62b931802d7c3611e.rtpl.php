<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link href="tpl/bootstrap_assets/css/bootstrap.css" rel="stylesheet">
	</head>

	<body>
		<?php $counter1=-1; if( isset($eva_scenarios) && is_array($eva_scenarios) && sizeof($eva_scenarios) ) foreach( $eva_scenarios as $key1 => $value1 ){ $counter1++; ?>	
		<div class="row-fluid">
			<ul class="thumbnails">
				<li class="span12">
					<div class="thumbnail">
						<div class="caption">
							<div id="ts_<?php echo $value1["0"];?>"> </div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<?php } ?>

		
		<script src="tpl/bootstrap_assets/js/jquery.js"></script>

		<script src="tpl/js/FusionCharts.js"></script>
		<script src="tpl/js/dc.js"></script>
		<script>
			$(document).ready(function() {

				var f = '/tpl/fusioncharts/power/MultiAxisLine.swf';
				<?php $counter1=-1; if( isset($eva_scenarios) && is_array($eva_scenarios) && sizeof($eva_scenarios) ) foreach( $eva_scenarios as $key1 => $value1 ){ $counter1++; ?>

					
					draw('ts_<?php echo $value1["0"];?>', f, '<?php echo $value1["2"];?>', '100%', 400);
				<?php } ?>


			})
		</script>

	</body>
</html>