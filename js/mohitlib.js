var button={
	attrs:function(obj){
		var alla=obj.attributes;
		var attrso={};
		for(var i=0;i<alla.length;i++)
			attrso[alla[i].name]=alla[i].value;
		return attrso;
	},
	tosendattrs:function(obj,allattrs){
		var dontneed=["data-restext","data-waittext","data-res","data-wait","data-error","data-params","data-eparams"];
		var sendparams={};
		for(var i in allattrs){
			if(i.substr(0,5)=="data-" && dontneed.indexOf(i)==-1 )
				sendparams[i.substr(5)]=allattrs[i];
		}
		return sendparams;
	},
	parse:function (d){
		try{
			return JSON.parse(d);
		}catch(e){
			mohit.alert("Unexpected error! ");
			return null;
		}
	},
	hasattr:function (allattrs,a){
		return (typeof(allattrs[a])!='undefined');
	},
	objhasattr:function (obj,a){
		return button.hasattr(button.attrs(obj),a);
	},
	sendreq:function(obj){
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		params['action']=allattrs["data-action"];
		obj.disabled=true;
		var prvvalue=obj.innerHTML;
		obj.innerHTML=(!button.hasattr(allattrs,"data-waittext"))?' ... ':(allattrs["data-waittext"]==''?prvvalue:allattrs["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			obj.disabled=false;
			var respo=button.parse(d);
			obj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					obj.innerHTML=(typeof(allattrs["data-restext"])=='undefined')?prvvalue:allattrs["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	},
	sendreq_v2:function(obj){
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		if(button.hasattr(allattrs,"data-eparams")){
			eval("var eparams="+allattrs["data-eparams"]);
			params=others.mergeifunset(params,eparams);
		}
		params['action']=allattrs["data-action"];
		obj.disabled=true;
		var prvvalue=obj.innerHTML;
		obj.innerHTML=(!button.hasattr(allattrs,"data-waittext"))?' ... ':(allattrs["data-waittext"]==''?prvvalue:allattrs["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			obj.disabled=false;
			var respo=button.parse(d);
			obj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					obj.innerHTML=(typeof(allattrs["data-restext"])=='undefined')?prvvalue:allattrs["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	},
	sendreq_v2_t2:function(obj){
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		if(button.hasattr(allattrs,"data-eparams")){
			eval("var eparams="+allattrs["data-eparams"]);
			params=others.mergeifunset(params,eparams);
		}
		params['action']=allattrs["data-action"];
		obj.disabled=true;
		var prvvalue=obj.innerHTML;
		obj.innerHTML=(!button.hasattr(allattrs,"data-waittext"))?' ... ':(allattrs["data-waittext"]==''?prvvalue:allattrs["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			obj.disabled=false;
			var respo=button.parse(d.split("\n")[0]);
			obj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					obj.innerHTML=(typeof(allattrs["data-restext"])=='undefined')?prvvalue:allattrs["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
					if(button.hasattr(allattrs,"data-reshtml")){
						var data=d.substring(d.indexOf('\n')+1);
						eval(allattrs["data-reshtml"]);
					}
				}
			}
			
		}});
	},
	sendreq_v2_t3:function(params,call_back_data,call_back_html,adata){
		$.post(HOST+"actiondisp.php",params,function(d,s){if(s=='success'){
			var respo=button.parse(d.split("\n")[0]);
			if(respo){
				if(respo.ec<0){
					if(typeof(adata)!='undefined'){
						if(button.hasattr(adata,"data-error")){
							var ec=respo.ec;
							eval(allattrs["data-error"]);
						}
						else
							mohit.alert(ecn[respo.ec]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					if(call_back_data!=null)
						call_back_data(respo.data);
					if(call_back_html!=null){
						var data=d.substring(d.indexOf('\n')+1);
						call_back_html(data);
					}
				}
			}
		}});
	},
	sendreq_v2_t4:function(obj,call_back_data,call_back_html,adata){
		var allattrs=this.attrs(obj);
		if(!button.hasattr(allattrs,"data-params"))
			var params=this.tosendattrs(obj,allattrs);
		else{
			eval("var params="+allattrs["data-params"]);
		}
		if(button.hasattr(allattrs,"data-eparams")){
			eval("var eparams="+allattrs["data-eparams"]);
			params=others.mergeifunset(params,eparams);
		}
		params['action']=allattrs["data-action"];
		button.sendreq_v2_t3(params,call_back_data,call_back_html);
	},
	sendreq1:function (params,call_back,adata){
		$.post("actionv2.php",params,function(d,s){if(s=='success'){
			var respo=button.parse(d);
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(adata,"data-error")) {
						var ec=respo.ec;
						eval(adata["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else if(call_back!=null)
					call_back(respo.data);
			}
			else
				mohit.alert("Unexpected Error");
		}});
	},
	selectme:function (obj){
		$(obj).repClass("btn-default","btn-primary");
		$(obj).siblings().repClass("btn-primary","btn-default");
		$(obj).parent().children("input[type=hidden]").val($(obj).attr("data-val"));
	},
};


var form={
	sendreq:function(obj,bobj){
		if(bobj.disabled)
			return;
		var allattrs=button.attrs(obj);
		var allattrsb=button.attrs(bobj);

		var params=getFormInputs(obj,'action');
		params['action']=allattrs["data-action"];
		bobj.disabled=true;
		var prvvalue=bobj.innerHTML;
		bobj.innerHTML=(!button.hasattr(allattrsb,"data-waittext"))?' ... ':(allattrsb["data-waittext"]==''?prvvalue:allattrsb["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			bobj.disabled=false;
			var respo=button.parse(d);
			bobj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					bobj.innerHTML=(typeof(allattrsb["data-restext"])=='undefined')?prvvalue:allattrsb["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	},
	sendreq1:function(obj,bobj){
		if(bobj.disabled)
			return;
		var allattrs=button.attrs(obj);
		var allattrsb=button.attrs(bobj);

		var params=getFormInputs(obj,'action');
		if(button.hasattr(allattrs,'data-param')){
			eval("var addparam="+allattrs['data-param']);
			others.mergeifunset(params,addparam);
		}

		params['action']=allattrs["data-action"];
		bobj.disabled=true;
		var prvvalue=bobj.innerHTML;
		bobj.innerHTML=(!button.hasattr(allattrsb,"data-waittext"))?' ... ':(allattrsb["data-waittext"]==''?prvvalue:allattrsb["data-waittext"]);
		$.post(HOST+"actionv2.php",params,function(d,s){if(s=='success'){
			bobj.disabled=false;
			var respo=button.parse(d);
			bobj.innerHTML=prvvalue;
			if(respo){
				if(respo.ec<0){
					if(button.hasattr(allattrs,"data-error")){
						var ec=respo.ec;
						eval(allattrs["data-error"]);
					}
					else
						mohit.alert(ecn[respo.ec]);
				}
				else{
					bobj.innerHTML=(typeof(allattrsb["data-restext"])=='undefined')?prvvalue:allattrsb["data-restext"];
					if(button.hasattr(allattrs,"data-res")){
						var data=respo.data;
						eval(allattrs["data-res"]);
					}
				}
			}
			
		}});
	},
	req:function(obj){
		form.sendreq1(obj, $(obj).find("button[type=submit]")[0]);
		return false;
	},
	valid:{
		is:function (obj){
			var errorlist=[];
			var inputs=['INPUT','TEXTAREA','SELECT'];
			var problem=false;
			for(i=0;i<inputs.length;i++){
				var ilist=$(obj).find(inputs[i]);
				for(j=0;j<ilist.length;j++){
					if(checkValidInput.isChecked( ilist[j]  ) ){
						$(ilist[j]).parent().removeClass("has-error");
					}
					else{
						$(ilist[j]).parent().addClass("has-error");
						var errormsg=$(ilist[j]).attr("data-unfilled") || $(ilist[j]).attr("name") || null;
						errorlist.push(errormsg);
						if(!problem)
							$(ilist[j]).focus();
						problem=true;
					}
				}
			}
			return errorlist;
		},
		action:function(obj){
			var errors=form.valid.is(obj);
			if(errors.length>0){
				for(var i=0;i<errors.length;i++){
					errors[i]=(i+1)+". "+errors[i];
				}
				var dispmsg="You have to fill:<br>"+errors.join("<br>");
				success.push(dispmsg,true);
			}
			return !(errors.length>0);
		}
	}
};



var selects={
	arraytooptionlist:function(arr,text){
		var outp="";
		outp+="<option value='' >"+text+"</option>";
		for(var i=0;i<arr.length;i++)
			outp+="<option>"+arr[i]+"</option>";
		return outp;
	}
};


var textarea={
	resize:function(obj){
		var battrs=button.attrs(obj);
		// if(!button.hasattr(battrs,"data-minrows"))
		// 	battrs["data-minrows"]=3;
		// if(!button.hasattr(battrs,"data-maxrows"))
		// 	battrs["data-maxrows"]=10;
		// if(27+20*(obj.rows)<obj.scrollHeight && battrs["data-maxrows"] > obj.rows  ){
		// 	obj.rows++;
		// }
	},
	resizeorg:function(obj){
		var battrs=button.attrs(obj);
		if(!button.hasattr(battrs,"data-minrows"))
			battrs["data-minrows"]=3;
		if(!button.hasattr(battrs,"data-maxrows"))
			battrs["data-maxrows"]=10;
		if(27+20*(obj.rows)<obj.scrollHeight && battrs["data-maxrows"] > obj.rows  ){
			obj.rows++;
		}
	}
};



var validation={
	"isnull":function (st){
		for(var i=0;i<st.length;i++){
			if(!(st[i]==' ' || st[i]=='\n' || st[i]=='\t'))
				return false;
		}
		return true;
	}
};





var others={
	keys:function(arr){
		outp=[];
		for(i in arr){
			outp.push(i);
		}
		return outp;
	},
	timeleft:function(t){
		var seconds=Math.floor(t)%60;
		var minutes=Math.floor(t/60)%60;
		var hours=Math.floor(t/3600)%24;
		var days=Math.floor(t/(3600*24));
		return {days:days,hours:hours,minutes:minutes,seconds:seconds};
	},
	timelefttext:function(tl){
		var outp="";
		var keys=others.keys(tl);
		for(var i=0;i<4;i++){
			if(tl[keys[i]]!=0)
				outp+=tl[keys[i]]+" "+keys[i]+(i==3?"":",");
		}
		outp+="";
		return outp;
	},
	setifunset:function(data,key,val){
		if(typeof(data[key])=='undefined')
			data[key]=val;
	},
	mergeifunset:function(dict1,dict2){
		for(i in dict2){
			if(typeof(dict1[i]=='undefined'))
				dict1[i]=dict2[i];
		}
		return dict1;
	},
	mergeforce:function (dict1,dict2){
		for(i in dict2){
			dict1[i]=dict2[i];
		}
		return dict1;
	}

};


var a={
	openmytab:function(obj){
		temp=obj;
		var divobjs=$(obj).parent().parent().parent().children(".mymenutabs");
		divobjs.children().fadeOut(function(){
			divobjs.children("#"+$(obj).attr("data-mytab")).fadeIn();
		});
		$(obj).parent().parent().children().removeClass("active");
		$(obj).parent().addClass("active");
	},
	openmytab_t2:function(obj){
		temp=obj;
		var divobjs=$(obj).parent().parent().parent().children(".mymenutabs");
		divobjs.children().hide();
		divobjs.children("#"+$(obj).attr("data-mytab")).show();
		$(obj).parent().parent().children().removeClass("active");
		$(obj).parent().addClass("active");
	},
	readmore:function (obj){
		$(obj).next().show();
		$(obj).hide();
	}
};


var div={
	setblock:function(obj){
		$(obj).attr("data-blocked","true");
	},
	isblock:function(obj){
		return ($(obj).attr("data-blocked")=="true");
	},
	setunblock:function(obj){
		$(obj).attr("data-blocked","false");
	},
	reload:function(obj,call_back_data,adata){
		button.sendreq_v2_t4(obj,call_back_data,function(d){
			$(obj).html(d);
		},adata);
	},
	load:function(obj, isloadold, isappendold, call_back_data, call_back_html) {
		if(div.isblock(obj))
			return -1;
		if( (isloadold==1 && $(obj).attr("data-minl")==0) || (isloadold==0 && $(obj).attr("data-maxl")==0) )
			return -2;
		div.setblock(obj);
		if(isappendold==null)
			isappendold=isloadold;
		$(obj).attr("data-isloadold",isloadold);
		button.sendreq_v2_t4(obj,function(d){
			var replacearr=["min", "max", "minl", "maxl"];
			for(var i=0; i<replacearr.length; i++){
				$(obj).attr("data-"+replacearr[i], d[replacearr[i]]);
			}
			if(call_back_data!=null)
				call_back_data(d);
		},function(d){
			if(isappendold==1)
				$(obj).prepend(d);
			else if(isappendold==0)
				$(obj).append(d);
			else if(isappendold==-1)
				$(obj).html(d);
			div.setunblock(obj);
			if(call_back_html!=null){
				call_back_html(d);
			}
		});
	},
	reload_autoscroll:function(obj, min_maxa, call_back_data, call_back_html){
		$(obj).attr(min_maxa);
		div.load(obj, 1, -1, call_back_data, call_back_html);
	}
};


String.prototype.bound = function (n) {
	if(this.length<=n)
		return this;
	else
		return this.substr(0,n-2)+".."
};

var page={
	addiframe:function (url){
		var elm=document.createElement("iframe");
		elm.style.display="none";
		elm.setAttribute("src",url);
		document.body.appendChild(elm);
	}
};

function time(ms){
	var tms=new Date().getTime();
	if(ms==null)
		return Math.floor(tms/1000.0);
	else
		return tms;
}

var rating={
	inat:0,
	outat:0,
	selectn:function(obj,n){
		temp=obj;
		var allc=$(obj).children();
		for(var i=0;i<allc.length;i++){
			if(i<n)
				allc[i].style.color='#FFD700';
			else
				allc[i].style.color='#555';
		}
		$(obj).find("input[type=hidden]").val(n);
	},
	goout:function(obj){
		rating.outat=time(1);
		setTimeout(function(){
			if(time(1)-rating.inat>=1000){
//				rating.selectn(obj,$(obj).attr("data-selected"));
			}
		},1000);
	},
	comein:function(obj){
		rating.inat=time(1);
	}
};



function extend(jobj,cfunc){
	var clist=jobj.children();
	if(clist.length>0){
		jobj.append(clist[0].outerHTML);
		clist=jobj.children();
		for(var i=0;i<clist.length;i++){
			if(cfunc!=null){
				cfunc(clist[i],i);
			}
		}
	}
}


setifunset=function(data,key,val){
	if(typeof(data[key])=='undefined')
		data[key]=val;
}

mergeifunset=function(dict1,dict2){
	for(i in dict2){
		setifunset(dict1,i,dict2[i]);
	}
	return dict1;
}


function remove(list1,e,fsatis){
	var outp=[];
	for(var i=0;i<list1.length;i++){
		if( (fsatis==null && list1[i]!=e) || (fsatis!=null && fsatis(list1[i],e))  ){
			outp.push(list1[i]);
		}
	}
	return outp;
}


function doforall(list1,f){
	for(var i=0;i<list1.length;i++){
		f(list1[i]);
	}
}

function haskey(arr, key){
	return (typeof(arr[key])!='undefined');
}



function mylib(){
	function textareainc(obj){
		var allattrs=button.attrs(obj);
		mergeifunset(allattrs,{'data-maxrows':5});
		if($(obj).outerHeight() < obj.scrollHeight + parseFloat($(obj).css("borderTopWidth")) + parseFloat($(obj).css("borderBottomWidth"))) {
			if($(obj).attr("rows")<allattrs["data-maxrows"])
				$(obj).attr("rows",1+parseInt($(obj).attr("rows")));
		};
	}
	$("textarea.autoinc").on("keyup keydown",function(){
		textareainc(this);
	});
	var valid={
		setautotick:function(selector, correct, incorrect){
			var keyaction=function(obj, e){
				var inpobj=$(obj);
				if(e.keyCode!=9 ){
					var signobj=inpobj.parent().find(".glyphicon");
					var isvalid=-1;
					if(inpobj.attr("data-condition")!=null && haskey(checkValidInput, inpobj.attr("data-condition")) ){
						isvalid=checkValidInput[inpobj.attr("data-condition")](inpobj[0]);
					}
					if(signobj.length>0){
						doforall([correct, incorrect], function(cname){
							signobj.removeClass(cname);
						});
						if(isvalid>=0)
							signobj.addClass(isvalid ? correct:incorrect );
					}
					signobj.parent().removeClass("has-error");
				}
			};
			var inpobj=$(selector);
			doforall(["keyup", "change", "keypress", "keydown"], function(i){
				inpobj.on(i, function(e){keyaction(this,e);}  ) ;
			});
		},
		resetinp:function (){
			$("input").on("kepup keydown", function(e){
				if(e.keyCode!=9 && e.keyCode!=13 ){
					this.setCustomValidity("");
				}
			});
		}
	};
	var awesome={
		awesomelabel:function(){
			var icons=["glyphicon-untick", "glyphicon-correct"];
			var tickone=function(obj){
				var groupid=$(obj).attr("data-gid");
				if(groupid!=null){
					var otherelms=$('.tickone[data-gid="'+groupid+'"]');
					for(var i=0; i<otherelms.length; i++){
						if(otherelms[i] != obj){
							otherelms[i].checked=false;
						}
						labelchangehandle(otherelms[i]);
					}
				}
			};
			var createhiddeninp=function(obj){
				var groupid=$(obj).attr("data-gid");
				if(groupid!=null && $("input[name="+groupid+"]").length == 0){
					$(obj).parent().append('<input type="hidden" value="" name="'+groupid+'" />');
				}
			};
			var findlabel=function(obj){
				if( $(obj).attr("id")!=null){
					var label=$('label[for="'+$(obj).attr("id")+'"]');
					if(label.length>0){
						return label;//Jquery selector for it.
					}
				}
				return null;
			};
			var labelchangehandle=function(obj, e){
				var label=findlabel(obj);
				var gid=$(obj).attr("data-gid");
				if(gid!=null){
					var otherelms=$('input.mycheckbox[data-gid="'+gid+'"]');
					var values=[];
					doforall(otherelms, function(elm){
						if(elm.checked)
							values.push(elm.value);
					});
					$("input[name="+gid+"]").val(values.join("-"));
				}
				if(label!=null){
					var iconobj=label.find("span.myicon");
					doforall(icons, function(d){
						iconobj.removeClass(d);
					});
					iconobj.addClass(icons[0+obj.checked]);
				}
			};
			$(".mycheckbox").on("change", function(e){
				labelchangehandle(this,e);
			});
			$(".tickone").on("change", function(e){
				tickone(this);
			});
			doforall($(".mycheckbox"), function(elm){
				var label=findlabel(elm);
				if(label!=null && label.find("span.myicon").length==0){
					label.prepend("<span class='myicon' ></span> &nbsp;");
				}
				labelchangehandle(elm);
				createhiddeninp(elm);
			});
		},
		imagehoverbig:function(){
			var hw = ["height", "width"];
			var mlist = ["padding-left", "padding-right", "padding-top", "padding-bottom"];
			var calledonce=function(obj){
				var backup = listjoin(hw, mlist);
				doforall(backup, function(x){
					$(obj).attr("data-"+x, parseInt($(obj).css(x)));
				});
			};
			var animate=function(obj, shift){
				doforall(hw, function(x){
					//$(obj).css(x, ($(obj).attr("data-"+x)-shift)+"px");
				});
				doforall(mlist, function(x){
					$(obj).css(x, ($(obj).attr("data-"+x)+1*shift)+"px");
				});
			}
			var shift=2;
			$(".imganimate").on("mouseenter", function(){
				animate(this, shift);
			});
			$(".imganimate").on("mouseout", function(){
				animate(this, 0);
			});
			doforall($(".imganimate"), function(x){
				calledonce(x);
			});
		},
		submitform:function(){
			var submitaction = function(obj){
				form.sendreq1(obj, $(obj).find("button[type=submit]")[0]);
				return false;
			}
		}
	};
	valid.resetinp();
	valid.setautotick("input.myinput", "glyphicon-correct", "glyphicon-incorrect");
	awesome.awesomelabel();
	awesome.imagehoverbig();
}


var likedislike = {
	likedislike:function(obj){
		button.sendreq(obj);
	}
};


