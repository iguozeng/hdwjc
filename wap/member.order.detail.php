<?php
$page_name='�ɹ���������';
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
	if(str2int($ShoppingId)){$strShoppingLink='��<span>��(<a href="/shopping/?id='.$ShoppingId.'" target="_blank" class="sname">'.$ShoppingName.'</a>)�ṩ����<span>';}else{$strShoppingLink='����ط�����'.SiteName.'�ṩ';}
	$isDel=true;
	if($Actived==0)$isDel=false;
	if($Payed==1)$isDel=false;
	if($Execed==1)$isDel=false;
	if($Sended==1)$isDel=false;
	if($Completed==1)$isDel=false;
	if($Payed==1){
		$strPayed='&nbsp;��&nbsp;��֧��';
	}else{
		$strPayed='&nbsp;��&nbsp;δ֧��';
		if(($IsOnlinePay==1)&&$isDel)$strOnlLink='&nbsp;-&nbsp;<a href="/pay_lib/pay.php?action=exec_pay&order='.base64_encode($OrderId).'" target="_blank">ȷ��֧��</a>';
	}
	if($Sended==1)
	{
		$strSend='&nbsp;-&nbsp;����ʱ�䣺'.format_dt($SendTime,'%Y-%m-%d %H:%M:%S');
		if(!isnull($SendCode))$strSend.='������ƾ�ݣ�'.$SendCode;
	}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>�ɹ���������</title>
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
        <li><font>�������</font><span><?php echo $OrderId;?></span></li>
        <li><font>�ϼƽ��</font><span>��<?php echo $TotalAmount;?></span></li>
        <li><font>����ʱ��</font><span><?php if($AddTime>0)echo format_dt($AddTime,'%Y-%m-%d %H:%M:%S');?></span></li>
    </ul>
</div>
<div class="clear"></div>
<div class="order_workflow"><?php
        if($Actived==1)
		{
			echo'<label class="selected">��&nbsp;�������</label>';
			if($Payed==1){$strSelected=' class="selected"';$strCode='��';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;���֧��</label>';
			if($Execed==1){$strSelected=' class="selected"';$strCode='��';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;���Ҹ���</label>';
			if($Sended==1){$strSelected=' class="selected"';$strCode='��';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;���ͷ���</label>';
			if($Completed==1){$strSelected=' class="selected"';$strCode='��';}else{$strSelected='';$strCode='';}
			echo'<label'.$strSelected.'>'.$strCode.'&nbsp;�������</label>';
		}else{
			echo'<label class="nodata">��&nbsp;�����ѹر�</label>';
		}
		?></div>
<div class="clear"></div>
<div style="background:#fff;min-height:300px;">
<div class="pay_array">
    <dl>
        <dt>����֧����ʽ</dt>
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
        <dt>�ջ�����Ϣ</dt>
        <dd>
            <ul>
                <li><font>�ջ���ʽ</font><span><?php echo $PayClassName;?></span></li>
                <li><font>�ջ���</font><span><?php echo $Name;?></span></li>
                <li><font>�ֻ�����</font><span><?php echo $Mobile;?></span></li>
                <li><font>�绰����</font><span><?php echo $Tel;?></span></li>
                <li><font>�ֵ���ַ</font><span><?php echo $AddRess;?></span></li>
            </ul>
        </dd>
    </dl>
</div>
<div class="send_array">
    <dl>
        <dt>������Ϣ</dt>
        <dd><?php echo $SendClassName.$strShoppingLink.$strSend;?></dd>
    </dl>
</div>
<div class="orders_list">
    <dl>
        <dt>������ϸ</dt>
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
		if(!isnull($row['ShoppingName'])){$ShoppingName='<br><span>��(<a>'.$row['ShoppingName'].'</a>)�ṩ���ͷ���<span>';}else{$ShoppingName='';}
		echo '<li><input type="hidden" name="tid[]" value="'.$row[0].'" /><input type="hidden" name="pid[]" value="'.$row['ProductId'].'" /><input type="hidden" name="icid[]" value="'.$InventoryClassId.'" />
		<label><img src="'.get_img($row["RootPic"]).'" /></label>
		<div>
		<strong>'.$row['Name'].'('.$row['ProductBrandName'].')</strong>
		<span>����:<font>��'.str2int($row['Price'],2).'</font>,����:<font>'.str2int($row['Total']).'</font>,С��:<font>'.$sum_price.'</font></span>
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