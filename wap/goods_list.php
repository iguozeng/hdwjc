<?php
$page_name='��Ʒ�б�';
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
		<title>���������</title>
		<link href="css/global.css" rel="stylesheet">
		<link href="css/goods.css" rel="stylesheet">
		<script language="javascript">var idPage="product.list",sortid=<?php echo $ProductClassId;?>,words='<?php echo $strKeys;?>';</script>
		<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
		<script src="js/jquery.m.ui.js" type="text/javascript"></script>
	</head>
	<body>
<!--������-->
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
				
				
					<!-- <li><a class="current" href="">�����豸</a></li>
					<li><a href="">�����豸</a></li>
					<li><a href="">�綯����</a></li>
					<li><a href="">�ֶ�����</a></li>
					<li><a href="">Һѹ��е</a></li>
					<li><a href="">��׼��</a></li>
					<li><a href="">ˮ��</a></li>
					<li class="lastCategary"><a href="">����Ĳ�</a></li>
				</ul>
			</div>
			<div class="categary_box">
				<h4><img src="images/jzwj.png" /><a class="txt" href="">�������</a></h4>
				<ul>
					<li><a href="">�繤����</a></li>
					<li><a href="">�����ƾ�</a></li>
					<li><a href="">װ�ν��</a></li>
				</ul> -->
			
		</div>
<!--������end-->
<!--�Ҳ���Ʒ�б�-->
		<div class="goods_list fl">
			<ul class="subCategary">
			<?php echo $global_event->get_list_sort($ProductClassId);?>
				<!-- <li><a class="current" href="">����</a></li>
				<li><a href="">���߰�</a></li>
				<li><a href="">��˿ǯ</a></li>
				<li><a href="">����ǯ</a></li>
				<li><a href="">����ǯ</a></li>
				<li><a href="">����ǯ</a></li>
				<li><a href="">����ǹ</a></li>
				<li><a href="">�����</a></li>
				<li><a href="">�����</a></li>-->
				<div class="clear"></div>
			</ul>
			<ul class="goods">
				<!-- <li>
					<a class="goods_name" href="">�繤����������/�๦�ܹ��߰�����</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150625164316_29905.gif" /></a>
					<label>��115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">����,��֯��е,�Ǳ����������31������</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150622113850_24944.png" /></a>
					<label>��115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">����־�������մ�ܱ����͹���ǯ</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150923154221_65296.png" /></a>
					<label>��115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">�繤����������/�๦�ܹ��߰�����</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150625164316_29905.gif" /></a>
					<label>��115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">����,��֯��е,�Ǳ����������31������</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150622113850_24944.png" /></a>
					<label>��115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li>
				<li>
					<a class="goods_name" href="">����־�������մ�ܱ����͹���ǯ</a>
					<a class="good_pic" href=""><img src="images/[Temp]20150923154221_65296.png" /></a>
					<label>��115.00</label>
					<a class="addToCart" href=""><img src="images/addToCart.png" /></a>
				</li> -->
			</ul>
			<script type="text/javascript">
				var height = $(".good_pic img").width();
				$(".good_pic img").css("height",height);
			</script>
		</div>
<!--�Ҳ���Ʒ�б�end-->
	</body>
</html>