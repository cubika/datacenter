
(function($) {
	
	$.ajaxSetup({
		timeout:5000,
		error:function(){
			$("#timeout").modal('show');
		}
	});

	$(document).ajaxStart(function() {
		$("body").addClass("loading");
	}).ajaxStop(function() {
		$("body").removeClass("loading");
	});

	$("#tab1").load("ldt_query.php");
	$("#tab4").load("ldt_eva.php");

	$(".performance a").on("click", function() {
		var $this=$(this);
		$(".performance a.active").removeClass("active");
		$this.addClass("active");
		var module = $this.data("module");
		$("#tab1").load(module + "_query.php");
		$("#tab4").load(module + "_eva.php");
	});
})(jQuery);