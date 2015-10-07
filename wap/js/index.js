var GetVehicleIsOk="enable";
$.extend({init:function(){}});
$(function($){	

	alert (idPage);
	
	$(".product_list ul").html('......')
	setTimeout(function(){
		var strResult=$.post("/include/ajax/m.php",'action=get_product&num=10&sortid=0&mainsortid=0');
		if(strResult!=null){$(".product_list ul").html(strResult);}else{
			$(".product_list ul").html('<li>操作失败！</li>');
		}
	},300);
	
});

