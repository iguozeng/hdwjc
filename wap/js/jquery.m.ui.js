$(function(){
	$(".person").click(function()
	{
		if($(".warmp").hasClass("opened")){
			$(".warmp").removeClass("opened");
			$(".warmp").addClass("closed");
			$(".slides").removeClass("opened");
			$(".slides").addClass("closed");
			$(".ui_header").removeClass("opened");
			$(".ui_header").addClass("closed");
			$(".footer").removeClass("opened");
			$(".footer").addClass("closed");
			//$(".action_buy_cart").removeClass("opened");
			//$(".action_buy_cart").addClass("closed");
			//$(".action_buy_cart span").removeClass("opened");
			//$(".action_buy_cart span").addClass("closed");
		}else{
			$(".warmp").removeClass("closed");
			$(".warmp").addClass("opened");
			$(".slides").removeClass("closed");
			$(".slides").addClass("opened");
			$(".ui_header").removeClass("closed");
			$(".ui_header").addClass("opened");
			$(".footer").removeClass("closed");
			$(".footer").addClass("opened");
			//$(".action_buy_cart").removeClass("closed");
			//$(".action_buy_cart").addClass("opened");
			//$(".action_buy_cart span").removeClass("closed");
			//$(".action_buy_cart span").addClass("opened");
			//$(".slides,.slides dd").height($(window).height());	
			$(window).resize(function(){
				$(".slides,.slides dd").height($(window).height());
			})
		}
		try{$.indexResize();}catch (e){}
	});

})