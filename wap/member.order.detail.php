<?php
$page_name='采购订单详情';
require_once 'include/init.php';
$OrderId=str_putdata($OrderId);
$HasData=false;
$result=query("select 
Amount,TotalAmount,DistrictId,AddRess,PostCode,Name,Tel,Mobile,PayClassId,SendClassId,PayLogId,SendName,SendCode,SendTime,ReceiptClassId,Status,Receipted,AddTime,
(select PayClassName from pay_class_tbl where PayClassId=sale_order_head_tbl.PayClassId) as PayClassName,
(select IsOnline from pay_class_tbl where PayClassId=sale_order_head_tbl.PayClassId limit 1) as IsOnlinePay,
(select SendClassName from send_class_tbl where SendClassId=sale_order_head_tbl.SendClassId) as SendClassName,
(select Name from shopping_tbl where ShoppingId=sale_order_head_tbl.ShoppingId limit 1) as ShoppingName,ShoppingId,
Actived,Execed,Sended,Completed,Payed 
from sale_order_head_tbl where MemberId='$MemberId' and OrderId='$OrderId'");
if(num_rows($result)){
	$row=fetch_array($result);
	$HasData=true;
	$Amount=$row["Amount"];
	$TotalAmount=$row["TotalAmount"];
	$arr_area=get_area_name($row["DistrictId"]);
	$AddRess=$row["AddRess"];
	$PostCode=$row["PostCode"];
	$Name=$row["Name"];
	$Tel=$row["Tel"];
	$Mobile=$row["Mobile"];
	$PayClassId=$row["PayClassId"];
	$PayClassName=$row["PayClassName"];
	$SendClassId=$row["SendClassId"];
	$SendClassName=$row["SendClassName"];
	$Sended=$row["Sended"];
	$SendCode=$row["SendCode"];
	$SendTime=$row["SendTime"];
	$ReceiptClassId=$row["ReceiptClassId"];
	$ManageMemberId=$row["ManageMemberId"];
	$Status=$row["Status"];
	$Actived=$row["Actived"];
	$Execed=$row["Execed"];
	$Completed=$row["Completed"];
	$IsOnlinePay=$row["IsOnlinePay"];
	$Payed=$row["Payed"];
	$Receipted=$row["Receipted"];
	$AddTime=$row["AddTime"];
	$ShoppingId=$row["ShoppingId"];
	$ShoppingName=$row["ShoppingName"];
}
if($HasData){
	$IsRehref=false;
	if($SendClassId==0)$IsRehref=true;
	if($PayClassId==0)$IsRehref=true;
	if($IsRehref)header("Location:m_member.orders.php?id=".base64_encode($OrderId));
	$result=query("select InvoiceHead,InvoiceContent,AddTime from invoice_tbl where MemberId='$MemberId' and OrderIds in('$OrderId')");
	if(num_rows($result)){$row=fetch_array($result);$InvoiceHead=$row[0];$InvoiceContent=$row[1];$InvoiceAddTime=$row[2];}
	if(str2int($ShoppingId)){$strShoppingLink='；<span>由(<a href="/shopping/?id='.$ShoppingId.'" target="_blank" class="sname">'.$ShoppingName.'</a>)提供服务<span>';}else{$strShoppingLink='，相关服务由'.SiteName.'提供';}
	$isDel=true;
	if($Actived==0)$isDel=false;
	if($Payed==1)$isDel=false;
	if($Execed==1)$isDel=false;
	if($Sended==1)$isDel=false;
	if($Completed==1)$isDel=false;
	if($Payed==1){
		$strPayed='&nbsp;√&nbsp;已支付';
	}else{
		$strPayed='&nbsp;×&nbsp;未支付';
		if(($IsOnlinePay==1)&&$isDel)$strOnlLink='&nbsp;-&nbsp;<a href="/pay_lib/pay.php?action=exec_pay&order='.base64_encode($OrderId).'" target="_blank">确认支付</a>';
	}
	if($Sended==1)
	{
		$strSend='&nbsp;-&nbsp;配送时间：'.format_dt($SendTime,'%Y-%m-%d %H:%M:%S');
		if(!isnull($SendCode))$strSend.='，配送凭据：'.$SendCode;
	}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>采购订单详情</title>
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
<form name="orderform" method="post" action="m_member.apply.orders.php">
    <input type="hidden" name="action" value="apply" />
    <input type="hidden" name="OrderIds" value="<?php echo $OrderIds;?>" />
<div class="order_head">
    <ul>
        <li><font>订单编号</font><span><?php echo $OrderId;?></span></li>
        <li><font>合计金额</font><span>￥<?php echo $TotalAmount;?></span></li>
        <li><font>订单时间</font><span><?php if($AddTime>0)echo format_dt($AddTime,'%Y-%m-%d %H:%M:%S');?></span></li>
    </ul>
</div>
<div class="clear"></div>
<div class="order_workflow"><?php
        if($Actived==1)
		{
			echo'<label class="selected">√&nbsp;订单审核</label>';
			if($Payed==1){$strSelected=' class="selected"';$strCode='√';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;买家支付</label>';
			if($Execed==1){$strSelected=' class="selected"';$strCode='√';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;卖家复核</label>';
			if($Sended==1){$strSelected=' class="selected"';$strCode='√';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;配送发运</label>';
			if($Completed==1){$strSelected=' class="selected"';$strCode='√';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;验收完结</label>';
		}else{
			echo'<label class="nodata">×&nbsp;订单已关闭</label>';
		}
		?></div>
<div class="clear"></div>
<div style="background:#fff;min-height:300px;">
<div class="pay_array">
    <dl>
        <dt>结算支付方式</dt>
        <dd>
            <ul>
                <li><?php echo $PayClassName.'<span style="color:#F30">'.$strPayed.'</span>'.$strOnlLink;?></li>
            </ul>
        </dd>
    </dl>
</div>
</div>
<div class="clear"></div>
<div class="address_array">
    <dl>
        <dt>收货人信息</dt>
        <dd>
            <ul>
                <li><font>收货方式</font><span><?php echo $PayClassName;?></span></li>
                <li><font>收货人</font><span><?php echo $Name;?></span></li>
                <li><font>手机号码</font><span><?php echo $Mobile;?></span></li>
                <li><font>电话号码</font><span><?php echo $Tel;?></span></li>
                <li><font>街道地址</font><span><?php echo $AddRess;?></span></li>
            </ul>
        </dd>
    </dl>
</div>
<div class="send_array">
    <dl>
        <dt>配送信息</dt>
        <dd><?php echo $SendClassName.$strShoppingLink.$strSend;?></dd>
    </dl>
</div>
<div class="orders_list">
    <dl>
        <dt>订单明细</dt>
        <dd>
            <ul><?php
$all_amount=0;
$result=query("select a.DetailId,a.ProductId,a.Total,a.Price,a.Amount,b.Name,b.RootPic,a.ShoppingId,
(select BrandName from brand_class_tbl where BrandId=b.BrandId limit 1) as ProductBrandName,
(select Name from shopping_tbl where ShoppingId=a.ShoppingId) as ShoppingName 
from sale_order_detail_tbl a,product_tbl b,sale_order_head_tbl c 
where (a.ProductId=b.ProductId and a.OrderId=c.OrderId) and (c.MemberId='$MemberId' and a.OrderId='$OrderId') order by a.DetailId");
if(num_rows($result)){
	while($row=fetch_array($result))
	{
		$sum_price=str2int($row['Total']*$row['Price'],2);
		$all_amount+=$sum_price;
		if(!isnull($row['ShoppingName'])){$ShoppingName='<br><span>由(<a>'.$row['ShoppingName'].'</a>)提供配送服务<span>';}else{$ShoppingName='';}
		echo '<li><input type="hidden" name="tid[]" value="'.$row[0].'" /><input type="hidden" name="pid[]" value="'.$row['ProductId'].'" /><input type="hidden" name="icid[]" value="'.$InventoryClassId.'" />
		<label><img src="'.get_img($row["RootPic"]).'" /></label>
		<div>
		<strong>'.$row['Name'].'('.$row['ProductBrandName'].')</strong>
		<span>单价:<font>￥'.str2int($row['Price'],2).'</font>,数量:<font>'.str2int($row['Total']).'</font>,小计:<font>'.$sum_price.'</font></span>
		</div></li>';
	}
}
$all_amount=str2int($all_amount,2);
$mod_amount=$all_amount-$Deposit;
$mod_amount=str2int($mod_amount,2);
            ?></ul>
        </dd>
    </dl>
</div>
</form>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>