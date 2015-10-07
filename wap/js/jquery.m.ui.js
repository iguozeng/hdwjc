
$(function($){


	
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

		}else{
			$(".warmp").removeClass("closed");
			$(".warmp").addClass("opened");
			$(".slides").removeClass("closed");
			$(".slides").addClass("opened");
			$(".ui_header").removeClass("closed");
			$(".ui_header").addClass("opened");
			$(".ui_footer").removeClass("closed");
			$(".ui_footer").addClass("opened");
			$(window).resize(function(){
				$(".slides,.slides dd").height($(window).height());
			})
		}
		try{$.indexResize();}catch (e){}
	});
});
