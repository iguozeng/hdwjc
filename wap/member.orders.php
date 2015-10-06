<?php
$page_name='订单结算';

require_once 'include/init.php';
$strAction=$_POST['action'];
if($strAction=='del')event_del_cart();
if($strAction=='edit')event_edit_cart();
if($strAction=='send')event_send_cart();
function event_del_cart(){
	$errnum=false;
	$UserId=str2int($_SESSION["MemberId"]);
	if($UserId>0){
		$IsRegisterUser=1;
		$UserName=$_SESSION['MemberName'];
	}else{
		$IsRegisterUser=0;
		$UserName=$_COOKIE['UserName'];
	}
	$TempOrderId=str2int($_POST['dataid']);
	$result=query("select ProductId from temp_order_tbl where TempOrderId='$TempOrderId' and IsRegisterUser='$IsRegisterUser' and UserName='$UserName'");
	if(!num_rows($result)){$errnum=true;}else{$row=fetch_array($result);$ProductId=$row[0];}
	if(!$errnum)
	{
		query("delete from `temp_order_tbl` where IsRegisterUser='$IsRegisterUser' and UserName='$UserName'  and TempOrderId='$TempOrderId'");
	}
	header("Location:cart.php");
	return false;	
};
function event_edit_cart(){
	$errnum=false;
	$UserId=str2int($_SESSION["MemberId"]);
	if($UserId>0){
		$IsRegisterUser=1;
		$UserName=$_SESSION['MemberName'];
	}else{
		$IsRegisterUser=0;
		$UserName=$_COOKIE['UserName'];
	}
	$TempOrderId=str2int($_POST['dataid']);
	$Total=str2int($_POST['datanum']);
	$result=query("select Total,ProductId from temp_order_tbl where TempOrderId='$TempOrderId' and IsRegisterUser='$IsRegisterUser' and UserName='$UserName'");
	if(num_rows($result)){$row=fetch_array($result);$ProductId=$row[1];}else{$errnum=true;}
	//$NeedTotal=$Total-$OldTotal;
	//$ModTotal=$OldModTotal+$Total;
	//if($Total>$ModTotal){$errnum=true;$strResult=0;}
	if(!$errnum){
		query("update temp_order_tbl set Total=$Total where TempOrderId='$TempOrderId' and IsRegisterUser='$IsRegisterUser' and UserName='$UserName'");
	}
	header("Location:cart.php");
	return false;	
};
function event_send_cart(){
	$MemberId=str2int($_SESSION["MemberId"]);
	if($MemberId>0)
	{
		event_add_order();
	}else{
		$backUrl="member.orders.php?action=send";
		header("Location:m_member_create.php?action=login");	
	}
	return false;
};
function event_add_order(){
	$UserName=$_SESSION['MemberName'];
	$MemberId=str2int($_SESSION["MemberId"]);
	$dtime=date("Y-m-d H:i:s");
	$PostTime=smarty_make_timestamp($dtime);
	$OrderClass=get_doc_code('MemberOrderHead',"k");
	$results=query("select t.ShoppingId from temp_order_tbl t,product_tbl p 
	where (t.ProductId=p.ProductId and t.OrderClass='$OrderClass' and t.UserName='$UserName' and t.IsRegisterUser=1) group by t.ShoppingId");
    if(num_rows($results))
	{
		$ProvinceId=0;$CityId=0;$DistrictId=0;
		$result=query("select Linkman,Address,PostCode,Tel,Mobile,ProvinceId,CityId,DistrictId from member_address_tbl where IsRoot=1 and MemberId='$MemberId'");
		if(num_rows($result)){
			$row=fetch_array($result);
			$Linkman=$row[0];
			$Address=$row[1];
			$PostCode=$row[2];
			$Tel=$row[3];
			$Mobile=$row[4];
			$ProvinceId=str2int($row[5]);
			$CityId=str2int($row[6]);
			$DistrictId=str2int($row[7]);
		}
		$Status=get_val('order_status_tbl','StatusKey','StatusName','init');
		$OrderIds='';
        while($rows=fetch_array($results))
        {
			$OrderId=get_doc_code('MemberOrderHead');
			$TotalAmount=0;
			$result=query("select sum(Price*Total) from `temp_order_tbl` where (UserName='$UserName' and OrderClass='$OrderClass' and IsRegisterUser=1 and ShoppingId='$rows[0]')");
			if(num_rows($result)){$row=fetch_array($result);$TotalAmount=str2int($row[0],2);}
			$strSQL="insert into sale_order_detail_tbl(`OrderId`,`ProductId`,`Price`,`Total`,Discount,NeedAmount,`Amount`,`ShoppingId`,`InventoryClassId`,ProductSpecialId)(select '$OrderId',ProductId,Price,Total,Discount,Price*Total,Price*Total,ShoppingId,InventoryClassId,ProductSpecialId from temp_order_tbl where (UserName='$UserName' and OrderClass='$OrderClass' and IsRegisterUser=1 and ShoppingId='$rows[0]') order by TempOrderId);";
			$strSQL.="insert into sale_order_head_tbl(`OrderId`,OrderClass,`MemberId`,ShoppingId,Amount,TotalAmount,ProvinceId,CityId,DistrictId,AddRess,PostCode,Name,Tel,Mobile,Status,AddTime,Actived)
				values('$OrderId','$OrderClass','$MemberId','$rows[0]','$TotalAmount','$TotalAmount','$ProvinceId','$CityId','$DistrictId','$Address','$PostCode','$Linkman','$Tel','$Mobile','$Status','$PostTime',1);";
			$strSQL.="delete from `temp_order_tbl` where (UserName='$UserName' and OrderClass='$OrderClass' and IsRegisterUser=1 and ShoppingId='$rows[0]');";
			array_query($strSQL);
			insert_member_log('初始化订单信息[移动端]('.$OrderId.')',$MemberId);
			$OrderIds.=$OrderId.',';
		}
		$OrderIds=str_left($OrderIds,strlen($OrderIds)-1);
		$OrderIds=base64_encode($OrderIds);
		header("Location:member.orders.php?id=$OrderIds");
	}else{
		header("Location:cart.php");
	}
	return false;	
};
$OrderClass=get_doc_code('MemberOrderHead',"k");
$OrderIds=str_putdata(base64_decode($id));
$Array_OrderId=explode(',',$OrderIds);
$hasId=false;$TotalAmount=0;
foreach($Array_OrderId as $OrderId)
{
	if(!isnull($OrderId)){
		$DetailTotal=0;
		$result=query("select count(DetailId) from sale_order_detail_tbl where OrderId='$OrderId'");
		if(num_rows($result)){$row=fetch_array($result);$DetailTotal=str2int($row[0]);}
		if($DetailTotal>0)$hasId=true;
		$result=query("select (a.Total*a.Price) as Amount 
		from sale_order_detail_tbl a,product_tbl b,sale_order_head_tbl c 
		where (a.ProductId=b.ProductId and a.OrderId=c.OrderId) and (c.MemberId='$MemberId' and a.OrderId='$OrderId')");
		if(num_rows($result)){
            while($row=fetch_array($result))
            {
				$TotalAmount+=$row[0];
			}
		}
	}
}
$result=query("select Linkman,Address,PostCode,Tel,Mobile,ProvinceId,CityId,DistrictId from member_address_tbl where IsRoot=1 and MemberId='$MemberId'");
if(num_rows($result)){
	$row=fetch_array($result);
	$Linkman=$row[0];
	$Address=$row[1];
	$PostCode=$row[2];
	$Tel=$row[3];
	$Mobile=$row[4];
	$ProvinceId=str2int($row[5]);
	$CityId=str2int($row[6]);
	$DistrictId=str2int($row[7]);
}
//if(!$hasId)header("Location:cart.php");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>订单结算</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
<script language="javascript">var idPage="member.orders";</script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery.ui.js" type="text/javascript"></script>
<script src="js/jquery.m.ui.js" type="text/javascript"></script>
<script language="javascript">
$(function($){
	$.getSelectarea("#province_select:<?php echo str2int($ProvinceId);?>","#city_select:<?php echo str2int($CityId);?>","#district_select:<?php echo str2int($DistrictId);?>");
});
</script>
</head>
<body>
<div class="warmp">
<?php require_once 'p.header.php';?>
<form action="" method="post">
<div class="address_array">
	<dl>
    	<dt>收货人信息</dt>
        <dd>
        	<ul>
            	<li>
                	<p>收货方式</p>
                    <span>
						<select>
							<?php
							$result=query("select SendClassId,SendClassName from send_class_tbl order by OrderNumber,SendClassId");
							if(num_rows($result)){
								while($row=fetch_array($result))
								{
									echo '<option value="'.$row[0].'">'.$row[1].'</option>';
								}
							}?>
						</select></span>
                </li>
                <li><p>收货人</p><span><input type="text" name="Linkman" value='<?php echo $Linkman;?>' placeholder="收货人真实姓名，不能为空"></span></li>
                <li><p>手机号码</p><span><input type="text" name="Mobile" value='<?php echo $Mobile;?>' placeholder="收货人手机号码，不能为空"></span></li>
                <li><p>电话号码</p><span><input type="text" name="Tel" value='<?php echo $Tel;?>' placeholder="收货人座机电话号码"></span></li>
                <li><p>所在地区</p>
					<span>
						<select id="province_select" name="ProvinceId">
							<?php
							$result=query("select ProvinceId,ProvinceName from province_tbl order by ProvinceId");
							if(num_rows($result)){
								$strResult="[";
								while($row=fetch_array($result))
								{
									$strResult.="{'id':'$row[0]','name':'$row[1]'},";
								}
								$strResult.="]";
							}?>
						</select>
						<select id="city_select" name="CityId"></select>
						<select id="district_select" name="DistrictId"></select>
					</span></li>
                <li style="border:0;"><p>街道地址</p><span><input type="text" name="Address" value='<?php echo $Address;?>' placeholder="收货人详细地址，不能为空"></span></li>
            </ul>
        </dd>
        <dt>结算支付方式</dt>
        <dd>
            <ul>
                <li><p>结算类型</p><span>
					<select name="PayClassId">
						<?php
						$result=query("select PayClassId,PayClassName,IsOnline from pay_class_tbl where IsMember=1 and IsOnline=1 order by OrderNumber,PayClassId");
						if(num_rows($result)){
							while($row=fetch_array($result))
							{
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
						}?>
					</select></span></li>
            </ul>
        </dd>
        <dt>订单编号：<?php echo $OrderId;?></dt>
    </dl>
</div>
<?php
foreach($Array_OrderId as $OrderId){
?>
<div class="cart_array">
	<ul>
	<?php
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
    	echo '<li>
        	<label>
            	<img src="'.get_img($row["RootPic"]).'" />
            </label>
            <div class="cart_list">
            	<strong>'.$row['Name'].'</strong>
                <span>库存:100,得力 De＆LiDL4197</span>
                <h4>规格型号：xxxx</h4>
                <div class="modified">
                	<input type="button" class="input_btn" value="-" />
                    <input type="text" class="input_text" readonly value="12" />
                    <input type="button" class="input_btn" value="+" />
                </div>
            </div>
            <em class="off">×</em>
            <em class="price">&yen; 200.00</em>
        </li>';
			}
		}
		$all_amount=str2int($all_amount,2);
			$mod_amount=$all_amount-$Deposit;
			$mod_amount=str2int($mod_amount,2);
?>

    </ul>
</div>
<?php
}
?>

<?php require_once 'slides.php';?>
<div class="action_buy">
	<input type="button" class="buy_button" value="结 算">
    <span>合计金额：&yen; 213.00</span>
</div>
</form>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>