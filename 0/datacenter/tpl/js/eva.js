function post(url, params) {
    var temp = document.createElement("form");
    temp.action = url;        
    temp.method = "post";        
    temp.style.display = "none";        
    for (var x in params) {        
        var opt = document.createElement("textarea");
        opt.maxlength=8000;
        opt.name = x;        
        opt.value = params[x];
        temp.appendChild(opt);
    }        
    document.body.appendChild(temp);
    temp.submit();
    return temp;
}

$("#word").on("click",function(){
	var tech=$("#iframe_tech").contents();
	post("exportword.php",{
		ldt:tech.find("#tableldt").html(),
		cpu:tech.find("#tablecpu").html(),
		mem:tech.find("#tablemem").html(),
		trf:tech.find("#tabletrf").html(),
		fps:tech.find("#tablefps").html(),
		pow:tech.find("#tablepow").html(),
		ben:tech.find("#tableben").html()
	});
});

$("#pdf").on("click",function(){
	var tech=$("#iframe_tech").contents();
	post("exportpdf.php",{
		ldt:tech.find("#tableldt").html(),
		cpu:tech.find("#tablecpu").html(),
		mem:tech.find("#tablemem").html(),
		trf:tech.find("#tabletrf").html(),
		fps:tech.find("#tablefps").html(),
		pow:tech.find("#tablepow").html(),
		ben:tech.find("#tableben").html()
	});
});


tinymce.init({
    selector: "textarea#summary",
    theme: "modern",
    menubar:false,
    height:300,
    plugins: [
              "link image lists hr pagebreak",
              "searchreplace wordcount code fullscreen insertdatetime",
              "table contextmenu  textcolor"
    ],
    toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table fullscreen | forecolor backcolor",
    init_instance_callback : function(){tinymce.activeEditor.getBody().setAttribute('contenteditable', false);}
 });
$("button#edit").on("click",function(e){
	e.preventDefault();
	tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
});
$("button#save").on("click",function(e){
	tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
})