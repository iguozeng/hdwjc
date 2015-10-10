$(function($){
	$.setJSPath='/js/';
	switch(idPage){
		case "index":$.include(["index.js"],1);break;
		case "product.list":$.include(["product.list.js"],1);break;
		case "news.list":$.include(["news.list.js"],1);break;
		case "news.detail":$.include(["news.detail.js"],1);break;
		case "product.item":$.include(["product.item.js"],1);break;
	}
	
	$(".person").click(function()
	{
		if($(".warmp").hasClass("opened")){
			$(".warmp").removeClass("opened");
			$(".warmp").addClass("closed");
			$(".slides").removeClass("opened");
			$(".slides").addClass("closed");
			$(".ui_header").removeClass("opened");
			$(".ui_header").addClass("closed");
			$(".ui_footer").removeClass("opened");
			$(".ui_footer").addClass("closed");
			$(".action_buy").removeClass("opened");
			$(".action_buy").addClass("closed");
		}else{
			$(".warmp").removeClass("closed");
			$(".warmp").addClass("opened");
			$(".slides").removeClass("closed");
			$(".slides").addClass("opened");
			$(".ui_header").removeClass("closed");
			$(".ui_header").addClass("opened");
			$(".ui_footer").removeClass("closed");
			$(".ui_footer").addClass("opened");
			$(".action_buy").removeClass("closed");
			$(".action_buy").addClass("opened");
			$(window).resize(function(){
				$(".slides,.slides dd").height($(window).height());
			})
		}
		try{$.indexResize();}catch (e){}
	});
});
$.extend({setJSPath:'',include:function(file,rh){var obj,ats,ext;var files=typeof file=="string"?[file]:file;for(var i=0;i<files.length;i++){ats=files[i].replace(/^\s|\s$/g,"").split('.');ext=ats[ats.length - 1].toLowerCase();if(ext=="css"){obj=document.createElement("link");obj.setAttribute("type","text/css");obj.setAttribute("rel","stylesheet");obj.setAttribute("href",files[i]);}else{obj=document.createElement("script");obj.setAttribute("type","text/javascript");obj.setAttribute("src",$.setJSPath+files[i]);}document.getElementsByTagName("head")[0].appendChild(obj);if(rh==1)$.getVehicle();}}});
$.extend({getVehicle:function(){if ("undefined"==typeof(GetVehicleIsOk)){setTimeout("$.getVehicle()",1000);}else{$.init();}}});