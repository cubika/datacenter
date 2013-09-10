(function($){

	$('.fancybox').fancybox();
	$('.chosen-select').chosen();
	$('.chosen-select-deselect').chosen({
		allow_single_deselect : true
	});
	$("#tab1").load("ldt_query.php");
	$("#tab4").load("ldt_eva.php");


	$(".sidebar-nav a").on("click",function(){
		$(".sidebar-nav li.active").removeClass("active");
		var li=$(this).closet("li");
		$(li).addClass("active");
		var module=$(li).data("module");
		if(module !== "eva"){
			$("#tab1").load(module+"_query.php");
			$("#tab4").load(module+"_eva.php");
		}
	});
})(jQuery);