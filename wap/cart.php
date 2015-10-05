<?php
require_once 'include/init.php';
require_once YXS.'check.member.php';
//require_once YXS.'cart.class.php';
require_once YXS.'global.class.php';
if(str2int(CacheEnable)==1){
	if($cacheact!='rewrite')$cache->load();
}
$global=new global_event();
$UserId=str2int($_SESSION["MemberId"]);
if($UserId>0){
	$IsRegisterUser=1;
	$UserName=$_SESSION['MemberName'];
}else{
	$IsRegisterUser=0;
	$UserName=$_COOKIE['UserName'];
}
drop_cart_unique();
$OrderClass=get_doc_code('MemberOrderHead',"k");
$global->HeaderTitle="���ﳵ";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>���ﳵ</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
</head>
<body>
<?php require_once 'p.header.php';?>
<form action="" method="post">
<div class="cart_array">
	<ul>
	<!--added by huafang at 2015-10-4-->
	<?php
$SumPrice=0;
$result=query("select t.TempOrderId,t.ProductId,t.Total,t.Price,p.Name,t.ShoppingId,t.InventoryClassId,p.Code,p.RootPic,
(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,
(select ModTotal from product_inventory_tbl where ProductId=t.ProductId and ProductTypeId=t.ProductTypeId and InventoryClassId=t.InventoryClassId limit 1) as ModTotal,
(select Type from product_type_tbl where ProductId=p.ProductId and ProductTypeId=t.ProductTypeId limit 1) as ProductType,
(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,
(select Name from shopping_tbl where ShoppingId=t.ShoppingId) as ShoppingName 
from temp_order_tbl t,product_tbl p where (t.ProductId=p.ProductId and t.OrderClass='$OrderClass') and (t.UserName='$UserName' and t.IsRegisterUser='$IsRegisterUser') order by t.ProductSpecialId,t.ShoppingId,t.TempOrderId");
if(num_rows($result)){
	while($row=fetch_array($result))
	{
		$TempOrderId=str2int($row['TempOrderId']);
		$ProductId=str2int($row['ProductId']);
		$Total=str2int($row['Total']);
		$ProductPrice=str2int($row['Price'],2);
		$InventoryClassId=str2int($row['InventoryClassId']);
		$ProductName=$row['Name'];
		$ProductCode=$row['Code'];
		$ProductRootPic=$row['RootPic'];
		$LocalityName=$row['LocalityName'];
		$ProductBrandName=$row['BrandName'];
		$ProductType=$row['ProductType'];
		$ProductModTotal=str2int($row['ModTotal']);
		$ShoppingId=str2int($row['ShoppingId']);
		$ShoppingName=$row['ShoppingName'];
		$TotalPrice=str2int($Total*$ProductPrice,2);
		$SumPrice+=str2int($Total*$ProductPrice,2);
		if(!isnull($ShoppingName)){$strShoppingName='<br><span>��(<a href="/shopping/?id='.$ShoppingId.'" target="_blank">'.$ShoppingName.'</a>)�ṩ����<span>';}else{$strShoppingName='';}
		if($ProductSpecialId>0){$strReadonly=" readonly='readonly'";$strSpecial='[����]';}else{$strReadonly='';$strSpecial='';}
    	echo '<li>
        	<label>
            	<img src="'.get_img($row["RootPic"]).'" />
            </label>
            <div class="cart_list">
            	<strong>'.$ProductName.'</strong>
                <span>����ͺţ�'.$ProductType.'</span>
                <h4>'.$ProductBrandName.','.$LocalityName.'</h4>
                <div class="modified">
                	<input type="button" class="input_btn" value="-" />
                    <input type="text" class="input_text" readonly value="'.$Total.'" />
                    <input type="button" class="input_btn" value="+" />
                </div>
            </div>
            <em class="off">��</em>
            <em class="price">&yen; '.$TotalPrice.'</em>
        </li>';
	}
}?>
    </ul>
</div>
<div class="action_buy">
	<input type="button" class="buy_button" value="�� ��">
    <span>�ϼƽ�&yen; <?php echo $SumPrice;?></span>
</div>
</form>
<?php require_once 'p.footer.php';?>
</body>
</html>