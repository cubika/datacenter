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

function load(plid, default_module){
	$("#tab1").load(default_module + "_query.php?plid="+plid);
	$("#tab2").load(default_module + "_eva.php?plid="+plid);
	//$("#tab3").load(default_module + "_trend.php?plid="+plid);
}



function setVersion(plid, module){

	$("select#version option").remove();
	$.get("query_conditions.php?plid="+plid+"&s=v&m="+module,function(data){
		var versions=JSON.parse(data);
		
		var engine=$("select#version"),
			browser=$("select#productName").chosen().val();
		$.each(versions[browser],function(i,item){
			engine.append('<option value="' + item + '">' + item + '</option>');
		});
		engine.find("option:first").attr("selected","selected");
		engine.trigger("chosen:updated");
	});
}


function setProductName(plid, module){
	$.get("query_conditions.php?plid="+plid+"&s=pn&m="+module,function(data){
		var pns = JSON.parse(data);
		var target=$("select#productName");
		$.each(pns,function(i,item){
			target.append('<option value="' + item + '">' + item + '</option>');
		});
		target.find("option:first").attr("selected","selected");
		target.trigger("chosen:updated");
		
		setVersion(plid, module);
	});
}