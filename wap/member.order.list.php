<?php
$page_name='订单查询';
require_once 'include/init.php';
require_once YXS.'check.member.php';
$strAction=$_POST['action'];
$OrderClass=get_doc_code('MemberOrderHead',"k");
if($action=='nopay'){
	$statu_selected_1=' class="selected"';
	$strWhere=' and Payed=0';
}elseif($action=='send'){
	$statu_selected_2=' class="selected"';
	$strWhere=' and Sended=1 and Completed=0';
}else{
	$statu_selected_3=' class="selected"';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>订单查询</title>
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
<div class="orders_statu">
	<ul>
    	<li><a href="member.order.list.php?action=nopay"<?php echo $statu_selected_1;?>>待结算</a></li>
        <li><a href="member.order.list.php?action=send"<?php echo $statu_selected_2;?>>待收货</a></li>
        <li><a href="member.order.list.php"<?php echo $statu_selected_3;?>>所有订单</a></li>
    </ul>
</div>
<div class="orders_list_search">
	<ul>
	<?php
$all_amount=0;		
$results=query("select OrderId,AddTime,TotalAmount,
(select StatusName from order_status_tbl where StatusName=sale_order_head_tbl.Status limit 1) as StatusName,
(select PayClassName from pay_class_tbl where PayClassId=sale_order_head_tbl.PayClassId limit 1) as PayClassName,
(select IsOnline from pay_class_tbl where PayClassId=sale_order_head_tbl.PayClassId limit 1) as IsOnlinePay,
(select Name from shopping_tbl where ShoppingId=sale_order_head_tbl.ShoppingId limit 1) as ShoppingName,
ShoppingId,Actived,Payed,Execed,Completed 
from sale_order_head_tbl 
where (MemberId='$MemberId' and OrderClass='$OrderClass')".$strWhere." and Actived=1 order by Actived desc,AddTime desc");
$total=num_rows($results);
if($total>0)
{
	require_once SYS.'include/class_lib/class.pager.php';
	$pagesize=20;
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
		$sum_price=str2int($rows['TotalAmount'],2);
		$all_amount+=$sum_price;
		$isDel=true;
		if($rows['Actived']==0)$isDel=false;
		if($rows['Payed']==1)$isDel=false;
		if($rows['Execed']==1)$isDel=false;
		if($rows['Completed']==1)$isDel=false;
		$strShoppingLink='';
		if(str2int($rows['ShoppingId']))$strShoppingLink='<a>'.$rows['ShoppingName'].'提供服务</a>';
		$strDetailLink='';
		$result=query("select a.ProductId,b.Code,b.RootPic from sale_order_detail_tbl a,product_tbl b where a.ProductId=b.ProductId and a.OrderId='$rows[0]' order by a.DetailId limit 4");
		if(num_rows($result))
		{
			while($row=fetch_array($result))
			{
				$strDetailLink.='<a href="m_item.php?num='.$row[1].'"><img src="'.get_img($row["RootPic"]).'" /></a>';
			}
		}
		$strOnlLink='';
		if($rows['Payed']==1){
			$strPayed='√已支付';
		}else{
			$strPayed='×未支付';
			if(($rows['IsOnlinePay']==1)&&$isDel)$strOnlLink='<a href="m_member.pay.php?action=exec_pay&order='.base64_encode($rows[0]).'">支付</a>';
		}
		$strDelLink='';$strChecked='';
		if($isDel)
		{
			$strDelLink='<a href="javascript:void(0)" data-id="'.$rows[0].'" class="del_order">删除</a>';
		}else{
			$strChecked=' disabled="disabled" readonly="readonly"';	
		}
		echo'<li>
        	<div class="array_title">
            	<span>下单时间:'.format_dt($rows['AddTime'],"%Y-%m-%d %H:%M:%S").'</span>
                <a href="javascript:void(0)" data-id="'.$rows[0].'" class="del_order">取消订单</a>
            </div>
            <div class="array_column">
            	<strong>
                	<span>订单编号：<a href="m_member.order.detail.php?OrderId='.$rows[0].'">'.$rows[0].'</a></span>
                	<label>总额：<em>&yen;'.str2int($rows['TotalAmount'],2).'</em></label>
                </strong>
                <span class="status">订单状态：'.$strPayed.'</span>
                <div class="array_pic">
                	'.$strDetailLink.'
                </div>
            </div>
        </li>';
	}
}
?>

    </ul>
</div>
<?php require_once 'slides.php';?>
<div class="action_buy">
	<input type="button" class="buy_button" value="结 算">
    <span>合计金额：&yen; 213.00</span>
</div>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>