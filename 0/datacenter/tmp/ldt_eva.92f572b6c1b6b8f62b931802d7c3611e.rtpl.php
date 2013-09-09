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
					<select id="v_baidu" data-placeholder="请选择Baidu版本号" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter1=-1; if( isset($v_baidu) && is_array($v_baidu) && sizeof($v_baidu) ) foreach( $v_baidu as $key1 => $value1 ){ $counter1++; ?>

						<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
						<?php } ?>

					</select>
				</div>
				<div class="col-lg-3">
					<select id="v_uc" data-placeholder="请选择UC版本号" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter1=-1; if( isset($v_uc) && is_array($v_uc) && sizeof($v_uc) ) foreach( $v_uc as $key1 => $value1 ){ $counter1++; ?>

						<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
						<?php } ?>

					</select>
				</div>
				<div class="col-lg-3">
					<select id="v_qq" data-placeholder="请选择QQ版本号" class="chosen-select" tabindex="2">
						<option value=""></option>
						<?php $counter1=-1; if( isset($v_qq) && is_array($v_qq) && sizeof($v_qq) ) foreach( $v_qq as $key1 => $value1 ){ $counter1++; ?>

						<option value="<?php echo $value1;?>"><?php echo $value1;?></option>
						<?php } ?>

					</select>
				</div>
			</div>
			<hr>
            <a onclick="compare();" class="btn btn-primary btn-large">比较 &raquo;</a>
        </div>
        <div >
			<iframe id="ifr" src="" frameborder="0" height="1600" width="100%"> </iframe>
		</div>

		<script src="tpl/bootstrap_assets/js/jquery.js"></script>
		<script src="tpl/js/chosen.jquery.js"></script>
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
				$("#ifr").attr("src", "ldt_eva_content.php?v_baidu="+v_baidu+"&v_uc="+v_uc+"&v_qq="+v_qq);
			}
		</script>

	</body>
</html>