<?php
$page_name='商品列表';
require_once 'include/init.php';
require_once YXS.'global.class.php';
$global_event=new global_event();
$ProductClassId=str2int($sortid);
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="gb2312">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<title>华东五金网</title>
		<link href="css/global.css" rel="stylesheet">
		<link href="css/goods.css" rel="stylesheet">
		<script language="javascript">var idPage="product.list",sortid=<?php echo $ProductClassId;?>,words='<?php echo $strKeys;?>';</script>
		<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="js/jquery.m.ui.js" type="text/javascript"></script>
	</head>
	<body>
<!--左侧分类-->
		<div class="goods_categary txt_wrapper fl">
		<div class="categary_box">
		<?php
			$results=query("select ProductClassId,NavigationName,Id from site_navigation_left1_tbl where Level=1 order by OrderNumber;");
			if(num_rows($results))
			{
				$i=1;
				while($rows=fetch_array($results))
				{
					$sql="select ProductClassId,NavigationName,Id from site_navigation_left1_tbl where FromMenuPanelId='".$rows[0]."' order by OrderNumber;";
					//echo $sql;exit;
					$result=query("select ProductClassId,NavigationName,Id from site_navigation_left1_tbl where FromMenuPanelId='".$rows[0]."' order by OrderNumber;");
					if(num_rows($result))
					{
						echo '<h4><img src="images/gywj.png" /><a class="txt" href="">'.$rows[1].'</a></h4>
								<ul>';
						while($row=fetch_array($result))
						{
							if($ProductClassId==$row[0]){$strselected=' class="current"';}else {$strselected='';}
							echo '<li><a '.$strselected.' href="goods_list.php?sortid='.$row[0].'">'.$row[1].'</a></li>';
						}
						echo '</ul>';
					}
				}
			}
		?>
		</div>	
				
				
					<!-- <li><a class="current" href="">机电设备</a></li>
					<li><a href="">起重设备</a></li>
					<li><a href="">电动工具</a></li>
					<li><a href="">手动工具</a></li>
					<li><a href="">液压机械</a></li>
					<li><a href="">标准件</a></li>
					<li><a href="">水泵</a></li>
					<li class="lastCategary"><a href="">配件耗材</a></li>
				</ul>
			</div>
			<div class="categary_box">
				<h4><img src="images/jzwj.png" /><a class="txt" href="">建筑五金</a></h4>
				<ul>
					<li><a href="">电工电料</a></li>
					<li><a href="">照明灯具</a></li>
					<li><a href="">装饰洁具</a></li>
				</ul> -->
			
		</div>
<!--左侧分类end-->
<!--右侧商品列表-->
		<div class="goods_list fl">
			<ul class="subCategary">
			<?php echo $global_event->get_list_sort($ProductClassId);?>
				<!-- <li><a class="current" href="">锤子</a></li>
				<li><a href="">工具包</a></li>
				<li><a href="">钢丝钳</a></li>
				<li><a href="">尖嘴钳</a></li>
				<li><a href="">大力钳</a></li>
				<li><a href="">管子钳</a></li>
				<li><a href="">黄油枪</a></li>
				<li><a href="">打包机</a></li>
				<li><a href="">活动扳手</a></li>-->
				<div class="clear"></div>
			</ul>
			<ul class="goods">
				<!-- <li>
					<a class="goods_name" href="">电工腰包配腰带/多功能工具包帆布</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150625164316_29905.gif" /></a>
					<label>￥115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">化工,纺织机械,仪表仪器不锈钢31齿链轮</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150622113850_24944.png" /></a>
					<label>￥115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">铬钼钢精工锻造沾塑柄重型管子钳</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150923154221_65296.png" /></a>
					<label>￥115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">电工腰包配腰带/多功能工具包帆布</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150625164316_29905.gif" /></a>
					<label>￥115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">化工,纺织机械,仪表仪器不锈钢31齿链轮</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150622113850_24944.png" /></a>
					<label>￥115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">铬钼钢精工锻造沾塑柄重型管子钳</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150923154221_65296.png" /></a>
					<label>￥115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li> -->
			</ul>
			<script type="text/javascript">
				var height = $(".good_pic img").width();
				$(".good_pic img").css("height",height);
			</script>
		</div>
<!--右侧商品列表end-->
	</body>
</html>