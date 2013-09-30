<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $productLine;?>, 数据中心</title>

<!-- Le styles -->
<link rel="stylesheet" href="tpl/bootstrap/css/docs.css">
<link rel="stylesheet" href="tpl/css/bootstrap-chosen.css">
<link href="tpl/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="tpl/fancybox/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" href="tpl/css/style.css">
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<button type="button" class="btn btn-navbar" data-toggle="collapse"
					data-target=".nav-collapse">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="brand" href="#"><?php echo $productLine;?>,  	数据中心</a>
				<div class="nav-collapse collapse">
					<ul class="nav link">
						<li><a href="/eva_query.php?plid=<?php echo $plid;?>">一键生成评测报告</a></li>
					</ul>

					<ul class="nav pull-right">
						<li>
							<div>
								<a class="btn btn-success" href="/users/sign_up"> <i
									class="icon-edit"></i> 注册
								</a> <a class="btn btn-info" href="/users/sign_in"> <i
									class="icon-user"></i> 登录
								</a>
							</div>
						</li>
					</ul>

				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span3">

				<div class="panel panel-primary performance">
					
					<?php $counter1=-1; if( isset($menus) && is_array($menus) && sizeof($menus) ) foreach( $menus as $key1 => $value1 ){ $counter1++; ?>
					<div class="panel-group">
						<h4><?php echo $key1;?></h4>
						<div class="list-group">
							<?php $counter2=-1; if( isset($value1) && is_array($value1) && sizeof($value1) ) foreach( $value1 as $key2 => $value2 ){ $counter2++; ?>
							<?php if( $value2->dataModule == $default_module ){ ?>
							<a data-module="<?php echo $value2->dataModule;?>" class="list-group-item active" href="#<?php echo $value2->dataModule;?>"><?php echo $value2->menuName;?></a>
							<?php }else{ ?>
							<a data-module="<?php echo $value2->dataModule;?>" class="list-group-item" href="#<?php echo $value2->dataModule;?>"><?php echo $value2->menuName;?></a>
							<?php } ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>

			</div>

			<div class="span9">
				<div id="modal"></div>
				<div class="tabbable">
					<!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1" data-toggle="tab">数据查询</a>
						</li>
						<li><a href="#tab2" data-toggle="tab">竞品比较</a></li>
						<li><a href="#tab3" data-toggle="tab">质量趋势</a></li>
					</ul>

					<div class="tab-content" style="min-height:400px">
						<div class="tab-pane active " id="tab1"></div>
						<div class="tab-pane" id="tab2"></div>
						<div class="tab-pane" id="tab3"></div>
					</div>
				</div>
			</div>

		</div>

	</div>
	<!--/.fluid-container-->
	
	<footer class="footer">
		<p>&copy; SumeruQA 2013</p>
	</footer>

	<div class="modal fade" id="timeout">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h3>提示</h3>
		</div>
		<div class="modal-body">
			<p>请求超时或错误</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-primary" data-dismiss="modal"
				aria-hidden="true">关闭</a>
		</div>
	</div>
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<script src="tpl/js/jquery-1.9.1.min.js"></script>
	<script src="tpl/bootstrap/js/bootstrap.min.js"></script>
	<script src="tpl/fancybox/jquery.fancybox.js"></script>
	<script src="tpl/js/chosen.jquery.min.js"></script>
	<script src="tpl/js/FusionCharts.js"></script>
	<script src="tpl/js/dc.js"></script>
	<script src="tpl/js/index.js"></script>
	
	<script>
		load('<?php echo $plid;?>', '<?php echo $default_module;?>');
		
		$(".performance a").on("click", function() {
			var $this = $(this);
			$(".performance a.active").removeClass("active");
			$this.addClass("active");
			var module = $this.data("module");
			$("#tab1").load(module + "_query.php?plid=<?php echo $plid;?>" );
			$("#tab2").load(module + "_eva.php?plid=<?php echo $plid;?>");
		});
		
	</script>

</body>
</html>
