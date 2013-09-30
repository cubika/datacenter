<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("common/query") . ( substr("common/query",-1,1) != "/" ? "/" : "" ) . basename("common/query") );?>

<script>
	$('.chosen-select').chosen();
	$(".chosen-container-single").css("width", "192px");

	setProductName("<?php echo $plid;?>", "pow");
	setVersion("<?php echo $plid;?>", "pow");

	$("select#productName").on("change", function() {
		setVersion("<?php echo $plid;?>", "pow");
	});
	function query() {
		var pn = $("#productName").val();
		var v = $("#version").val();
		$("#query_content").load("pow_query_content.php?plid=<?php echo $plid;?>&pn=" + pn + "&v=" + v);
	}

</script>