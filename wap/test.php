<?php
require_once 'include/init.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>购物车</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
<script language="javascript">var idPage="cart";</script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
		$('.search').click(function(){
			if($('.head_show').css('display')=='none'){
				$('.head_show').show();
			}else{
				$('.head_show').hide();
			}	
		});
		
		$(".sort_select").click(function(){
			//$(".sort_select font").css('display','block');
			
			if($('.sort_select font').css('display')=='none'){
				$('.sort_select font').show();
			}else{
				$('.sort_select font').hide();
			}	
		});
		
		
		$(".sort_select font span").click(function(){
			//$('.sort_select font').hide();
			$(".sort_select label").html($(this).html());
			
		});
		});
</script>
<script src="js/jquery.m.ui.js" type="text/javascript"></script>

</head>
<body>
<div class="warmp">
<?php require_once 'p.header.php';?>

<div class="head_show">
	<div class="search_box">
    	<span class="sort_select">
        	<label>选择分类 ∨</label>
            <font style="display:none;">
            	<span class="search_sort top">产品</span>
                <span class="search_sort">新闻</span>
            </font>
        </span>
        <input type="text" value="" />
        <input type="submit" value="">
    </div>
</div>
<form action="member.orders.php" method="post" name="cartform">
<input type="hidden" name="action" value="null" />
<input type="hidden" name="dataid" value="0" />
<input type="hidden" name="datanum" value="0" />
<div class="cart_array">
	<ul>
	<!--added by huafang at 2015-10-4-->
	
    </ul>
</div>
<?php require_once 'slides.php';?>
<div class="action_buy">
	<input type="button" class="buy_button" value="结 算" name="pay_send">
    <span>合计金额：&yen; <?php echo $SumPrice;?></span>
</div>
</form>
<?php require_once 'p.footer.php';?>
<div class="head_show" style="display:none;">
	
</div>
</div>
</body>
</html>