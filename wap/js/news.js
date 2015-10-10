var GetVehicleIsOk="enable";
$.extend({init:function(){}});
$(function($){
	$(".info_list ul").html('......');
	var win_height =$(window).height();
	var strResult,page=0,nextNum=1,modHeight=180,doc_height,n_height;
	setTimeout(function(){
		strResult=$.post("/include/ajax/m.php",'action=get_list_news&num=10&sortid='+sortid+'&mainsortid=0&page='+page);
		if(strResult!=null){
			$(".info_list ul").html(strResult);$(".more").hide();
			doc_height =$(document).height();
			n_height =doc_height-win_height;
		}
	},800);
	$(document).scroll(function(){
		var scrollTop =$(document).scrollTop();
		if((scrollTop/(n_height*nextNum))>=0.95){
			page++;nextNum++;$(".more").show();
			setTimeout(function(){
				strResult=$.post("/include/ajax/m.php",'action=get_list_news&num=10&sortid='+sortid+'&mainsortid=0&page='+page);
				if(strResult!=null){$(".info_list ul").append(strResult);$(".more").hide();}
			},1000);
		}
	});
});
window._bd_share_config = {
	common : {},
	share : [{
		"bdSize" : 16
	}],
	slide : [{	   
		bdImg : 6,
		bdPos : "left",
		bdTop : 170
	}],
	selectShare : [{
		"bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
	}]
}
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];