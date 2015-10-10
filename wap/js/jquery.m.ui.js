$(function($){
	$.setJSPath='/js/';
	switch(idPage){
		case "index":$.include(["index.js"],1);break;
		case "product.list":$.include(["product.list.js"],1);break;
		case "news":$.include(["news.js"],1);break;
		case "product.item":$.include(["product.item.js"],1);break;
		case "cart":$.include(["cart.js"],1);break;
		case "pay":$.include(["pay.js"],1);break;
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
$.extend({siteCount:function(){
	var url_val=encodeURIComponent(window.location.pathname+window.location.search);
	var fromurl_val=encodeURIComponent(document.referrer);
	var screen_val=window.screen.width+"."+window.screen.height;
	var browser_val=$.getBrowser();
	var OS_val=$.getOS();
	var language_val=$.getLanguage();
	var post_url='/include/ajax/statistic.php';
	var post_data="u="+url_val+"&f="+fromurl_val+"&s="+screen_val+"&b="+browser_val+"&o="+OS_val+"&l="+language_val;
	$.post(post_url,post_data);
}});
$.extend({setJSPath:'',include:function(file,rh){var obj,ats,ext;var files=typeof file=="string"?[file]:file;for(var i=0;i<files.length;i++){ats=files[i].replace(/^\s|\s$/g,"").split('.');ext=ats[ats.length - 1].toLowerCase();if(ext=="css"){obj=document.createElement("link");obj.setAttribute("type","text/css");obj.setAttribute("rel","stylesheet");obj.setAttribute("href",files[i]);}else{obj=document.createElement("script");obj.setAttribute("type","text/javascript");obj.setAttribute("src",$.setJSPath+files[i]);}document.getElementsByTagName("head")[0].appendChild(obj);if(rh==1)$.getVehicle();}}});
$.extend({getVehicle:function(){if ("undefined"==typeof(GetVehicleIsOk)){setTimeout("$.getVehicle()",1000);}else{$.init();}}});
$.extend({post:function(str_url,str_data){var strResult;var $this_url=str_url;var $this_data=str_data;$.ajax({cache:true,type:'POST',url:$this_url,data:$this_data,async:false,error:function(request){/*window.alert("error");*/},success:function(data){strResult=data;}});return strResult;}});
$.extend({getBrowser:function(){var version,userAgent = window.navigator.userAgent.toLowerCase();if(/11\.0/i.test(userAgent)&&/mozilla/i.test(userAgent)&&/trident/i.test(userAgent)){version="ie11";}else if(/msie 10\.0/i.test(userAgent)){version="ie10";}else if(/msie 9\.0/i.test(userAgent)){version="ie9";}else if(/msie 8\.0/i.test(userAgent)){version="ie8";}else if(/msie 7\.0/i.test(userAgent)){version="ie7";}else if(/msie 6\.0/i.test(userAgent)){version="ie6";}else if(/chrome/i.test(userAgent)){version="chrome";}else if(/firefox/i.test(userAgent)){version="firefox";}else if(/safari/i.test(userAgent)&&/mobile/i.test(userAgent)){version="mobile";}else{version="*";}return version;}});
$.extend({getOS:function(){var userAgent=window.navigator.userAgent.toLowerCase();var platform=window.navigator.platform.toLowerCase();var isWin = (platform == "win32") || (platform == "windows");var isMac = (platform == "mac68k") || (platform == "macppc") || (platform == "macintosh") || (platform == "macIntel");if (isMac) return "mac";var isUnix = (platform == "x11") && !isWin && !isMac;if (isUnix) return "unix";var isLinux = (String(platform).indexOf("linux") > -1);if (isLinux) return "linux/android";var isIOS = (String(platform).indexOf("iphone") > -1);if (isIOS) return "ios";if (isWin){var isWin2K = userAgent.indexOf("windows nt 5.0") > -1 || userAgent.indexOf("windows 2000") > -1;if (isWin2K) return "win2000";var isWinXP = userAgent.indexOf("windows nt 5.1") > -1 || userAgent.indexOf("windows xp") > -1;if (isWinXP) return "winxp";var isWin2003 = userAgent.indexOf("windows nt 5.2") > -1 || userAgent.indexOf("windows 2003") > -1;if (isWin2003) return "win2003";var isWinVista= userAgent.indexOf("windows nt 6.0") > -1 || userAgent.indexOf("windows vista") > -1;if (isWinVista) return "winvista";var isWin7 = userAgent.indexOf("windows nt 6.1") > -1 || userAgent.indexOf("windows 7") > -1;if (isWin7) return "win7/win2008";var isWin8 = userAgent.indexOf("windows nt 6.3") > -1 || userAgent.indexOf("windows 8") > -1;if (isWin8) return "win8";}return "other";}});
$.extend({getLanguage:function(){var type=window.navigator.appName.toLowerCase();var lang;if (type=="netscape"){lang = window.navigator.language;}else{lang = window.navigator.userLanguage;}var lang = lang.substr(0,2);return lang;}});
//added by huafang at 2015.9.10
$.extend({dialog:function(s,t,w,h){$(document.body).find("#pop_bg").remove();$(document.body).find("#pop_box").remove();$(document.body).find("#pop_title").remove();$(document.body).find("#pop_body").remove();var obj_div='<div id="pop_bg" ></div><div id="pop_box" style=><div id="pop_title"><strong>......</strong><span>×</span></div><div id="pop_body">......</div></div>';$(document.body).append(obj_div);$("#pop_bg").hide();$("#pop_box").hide();var bg_height=$(document).height();var bg_width=$(document).width();$("#pop_bg").show();$("#pop_bg").height(bg_height);$("#pop_body").html(s);$("#pop_box").width(w);$("#pop_box").height(h);var D_height=$(document).height();var W_height=$(window).height();var D_width=$(document).width();$("#pop_box").show();$("#pop_title strong").html(t);var pop_top=(W_height-$("#pop_box").height())/2+$(document).scrollTop();var pop_left=(D_width/2)-($("#pop_box").width()/2);$("#pop_box").offset({left:pop_left,top:pop_top});$("#pop_box").css("top",pop_top).css("left",pop_left);$(window).scroll(function(){var Scrolltop = $(document).scrollTop();var pop_scroll_top=(W_height-$("#pop_box").height())/2+Scrolltop;var left=(D_width/2)-($("#pop_box").width()/2);$("#pop_box").offset({left:left,top:pop_scroll_top});});$("#pop_title span").click(function(){$("#pop_bg").hide();$("#pop_body").html("");$("#pop_box").fadeOut(100);});$("#pop_title").mouseover(function(){$(this).css('cursor','move');});$('#pop_title').mousedown(function(event){var isMove = true;var abs_x = event.pageX - $('#pop_box').offset().left;var abs_y = event.pageY - $('#pop_box').offset().top;$(document).mousemove(function (event){if (isMove){var obj = $('#pop_box');obj.css({'left':event.pageX - abs_x,'top':event.pageY - abs_y});}}).mouseup(function (){isMove = false;});});}});
$.extend({dialog_close:function(){$("#pop_bg").hide();$("#pop_body").html("");$("#pop_box").fadeOut(100);}});
$.extend({get_cart_statu:function(){
	var strMsg="",dlWidth=260,dlHeight=150;
	var strFoot='<span id="msg_button"><a href="javascript:$.dialog_close();">继续购物</a><a href="m_cart.php" class="msg_yellow">去结算</a></span>';
	var numResult=eval($.post("/include/ajax/order_cart.php","action=cart_statu"));
	strMsg="<span>商品汇总:"+numResult[1]+"件，"+numResult[0]+"个品种<br>金额合计:"+numResult[2]+"元<br>是否进入购物车？</span>";
	strMsg+=strFoot;$.dialog("<div id='msg_box'>"+strMsg+"</div>","商品成功加入购物车",dlWidth,dlHeight);}
	
});