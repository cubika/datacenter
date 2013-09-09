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
			
        <div id="ld-table" class="bs-docs-example" d_content="">
        <table class="table table-striped">
 			 <thead>
                <tr>
                  <th>#</th>
                  <th>Value</th>
                  <th>浏览器</th>
                  <th>版本号</th>
                </tr>
              </thead>
              
              <tbody>
              	<?php $counter1=-1; if( isset($details) && is_array($details) && sizeof($details) ) foreach( $details as $key1 => $value1 ){ $counter1++; ?>

                <tr>
                  <td><?php echo $key1;?></td>
                  <td><?php echo $value1;?></td>
                  <td><?php echo $browser;?></td>
                  <td><?php echo $engine_version;?></td>
                </tr>
                <?php } ?>

              </tbody>
              
		</table>
		</div>
		
		<script src="tpl/bootstrap_assets/js/jquery.js"></script>
		<script src="tpl/fancybox/jquery.fancybox.js"></script>

		<script>
			$(document).ready(function() {
				$('.fancybox').fancybox();
			})
			
		</script>

	</body>
</html>