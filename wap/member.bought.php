<?php
$page_name='已购商品';
require_once 'include/init.php';
require_once YXS.'global.class.php';
require_once YXS.'check.member.php';
$OrderClass=get_doc_code('MemberOrderHead',"k");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>已购商品</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.m.ui.js"></script>
</head>
<body>
<div class="warmp">
<?php require_once 'p.header.php';?>
<div class="bought_cart_array">
	<ul>
	<?php
$results=query("select a.DetailId,a.OrderId,a.ProductId,a.Price,a.Total,a.Amount,a.ShoppingId,b.AddTime,c.Name,c.Code,c.RootPic,(select Name from shopping_tbl where ShoppingId=b.ShoppingId limit 1) as ShoppingName from sale_order_detail_tbl a,sale_order_head_tbl b,product_tbl c where (a.OrderId=b.OrderId and a.ProductId=c.ProductId)and(b.MemberId='$MemberId' and b.Payed=1 and OrderClass='$OrderClass') order by a.DetailId desc");
$total=num_rows($results);
if($total>0)
{
	require_once SYS.'include/class_lib/class.pager.php';
	$pagesize=50;
	if ($p<1)$p=1;
	$maxpage=ceil($total/$pagesize);
	$mypage=new uobarpage($total,$pagesize);
	$pagelist = $mypage->pagebar(2);
	$pagelistinfo = $mypage->limit2();
	mysql_data_seek($results,($p-1)*$pagesize);
	for($i=0;$i<$pagesize;$i++)
	{
		$rows=fetch_array($results);
		if(!$rows) break;
		$strShoppingLink='';
		if(str2int($rows['ShoppingId'])){$strShoppingLink='<br><span>由(<a href="/shopping/?id='.$rows['ShoppingId'].'" target="_blank">'.$rows['ShoppingName'].'</a>)提供服务<span>';}
		echo'<li><label><img src="'.get_img($rows["RootPic"]).'" /></label>
			<div class="cart_list" style="width:70%;">
			<strong>'.$rows['Name'].'('.$rows['ProductBrandName'].$rows['ProductType'].')</strong>
			<span>单号：'.$rows['OrderId'].'，时间：'.format_dt($rows['AddTime'],'%Y-%m-%d').'</span>
			<span>单价:<font>￥'.str2int($rows['Price'],2).'</font>,数量:<font>'.str2int($rows['Total']).'</font>,小计:<font>'.str2int($rows['Amount'],2).'</font></span>
			</div></li>';
	}
}else{
	echo'<li class="noResult">暂且没有任何记录~</li>';
}
?>
    </ul>
</div>
<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>