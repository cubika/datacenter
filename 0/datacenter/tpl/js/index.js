$.ajaxSetup({
	timeout : 15000,
	error : function() {
		$("#timeout").modal('show');
	}
});

$(document).ajaxStart(function() {
	$("body").addClass("loading");
}).ajaxComplete(function() {
	$("body").removeClass("loading");
});

$("#tab1").load("ldt_query.php");
$("#tab4").load("ldt_eva.php");

$(".performance a").on("click", function() {
	var $this = $(this);
	$(".performance a.active").removeClass("active");
	$this.addClass("active");
	var module = $this.data("module");
	$("#tab1").load(module + "_query.php");
	$("#tab4").load(module + "_eva.php");
});

function setVersion(module){
	var browser=$("select#browser").chosen().val().toLowerCase();
	$("select#engine_version option").remove();
	$.get(module+"_version.php",function(data){
		var versions=JSON.parse(data),
			engine=$("select#engine_version");
		$.each(versions[browser],function(i,item){
			engine.append('<option value="' + item + '">' + item + '</option>');
		});
		engine.find("option:first").attr("selected","selected");
		engine.trigger("chosen:updated");
	});
}