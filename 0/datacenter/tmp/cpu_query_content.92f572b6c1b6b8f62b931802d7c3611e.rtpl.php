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
		<?php $counter1=-1; if( isset($test_scenarios) && is_array($test_scenarios) && sizeof($test_scenarios) ) foreach( $test_scenarios as $key1 => $value1 ){ $counter1++; ?>	
        <div id="ld-table" class="bs-docs-example" d_content="测试场景：<?php echo $value1["1"];?>">
        <table class="table table-striped">
 			 <thead>
                <tr>
                  <th>#</th>
                  <th>website</th>
                  <th>浏览器</th>
                  <th>版本号</th>
                  <th>CPU占用率(%)</th>
                  <th>测试时间</th>
                  <th>操作</th>
                </tr>
              </thead>
              
              <tbody>
              	<?php $counter2=-1; if( isset($value1["2"]) && is_array($value1["2"]) && sizeof($value1["2"]) ) foreach( $value1["2"] as $key2 => $value2 ){ $counter2++; ?>

                <tr>
                  <td><?php echo $counter2+1;?></td>
                  <td><?php echo $value2->website;?></td>
                  <td><?php echo $value2->browser;?></td>
                  <td><?php echo $value2->engineVersion;?></td>
                  <td><?php echo $value2->cpuValue;?></td>
                  <td><?php echo $value2->timeStamp;?></td>
                  <td><a>删除</a></td>
                </tr>
                <?php } ?>

              </tbody>
              
		</table>
		</div>
		<?php } ?>

		

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