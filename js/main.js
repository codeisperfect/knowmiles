
function isallfilled(obj){
	return ($("#pac-input").val()!='' && $("#pac-input2").val()!='' );
}


var funcs={
	f1:function(obj){
		var submit_button=$(obj).find("button[type=submit]");
		submit_button[0].disabled=true;
		submit_button.find("img")[0].style.display="";
	},
	seepassword:function(obj){
		var jobj=$(obj).parent().parent().parent().parent().find("input[name=password]");
		jobj.attr("type",jobj.attr("type")=="text"?"password":"text" );
	}
};

function filterpic(){
	var cpossible=$("#cartypefilter").find("input[type=checkbox]");
	var carselected=[];
	for(var i=0;i<cpossible.length;i++){
		if(!cpossible[i].checked)
			carselected.push($(cpossible[i]).attr("data-filterpic") );
	}
	var clisting=$("#carlisting").children();
	for(var i=0;i<clisting.length;i++){
		var fpic=$(clisting[i]).attr("data-filterpic");
		if((carselected.indexOf(fpic)==-1))
			$(clisting[i]).slideDown();
		else
			$(clisting[i]).slideUp();
	}
}

function carresultsort(basedon){
	return;
	var clist=$("#carlisting").children().get();
	clist.sort(function(a,b){
		var comp=($(a).attr("data-"+basedon)>$(b).attr("data-"+basedon));
		if(basedon=='price')
			return comp?1:-1;
		else if(basedon=='rating')
			return comp?-1:1;
		else
			return 0;
	});
	$("#carlisting").html('');
	function appendall(i){
		if(i<clist.length){
			clist[i].style.display="none";
			$("#carlisting")[0].appendChild(clist[i]);
			$(clist[i]).slideDown(100,function(){appendall(i+1);});
		}
	}
	appendall(0);
}


function lspopup(inp){
	$(".boxer-close").click();
	setTimeout(function(){
		$("#"+inp+"button").click();
	},1000);
}
