<?php if(!class_exists('raintpl')){exit;}?>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("common/eva") . ( substr("common/eva",-1,1) != "/" ? "/" : "" ) . basename("common/eva") );?>

<script>
(function(){
	$('.chosen-select').chosen();
	$(".chosen-container-single").css("width","192px");
	$("button#compare").on("click",function(){
		var pns = "";
		<?php $counter1=-1; if( isset($pns) && is_array($pns) && sizeof($pns) ) foreach( $pns as $key1 => $value1 ){ $counter1++; ?>
		if(pns != "") {
			pns += ",";
		}
		pns +="<?php echo $value1;?>:" + $("#<?php echo $value1;?>").val();
		<?php } ?>
		$("#eva_content").load("pow_eva_content.php?plid=<?php echo $plid;?>&pns=["+ pns +"]");
	});
})();
</script>
