<?php
require_once '../init.php';
header("Content-type:text/html;charset=utf-8");
header("Content-Type:text/plain;charset=gb2312");
$strAction=$_POST['action'];
$strProductSortid=str2int($_POST['sortid']);
$strProductMainSortid=str2int($_POST['mainsortid']);
$strNewsSortid=str2int($_POST['sortid']);
$strNewsMainSortid=str2int($_POST['mainsortid']);
$strSartNum=str2int($_POST['sartnum']);
$strNum=str2int($_POST['num']);
$strPage=str2int($_POST['page']);
if($strAction=='get_product')echo event_get_product($strProductSortid,$strProductMainSortid,$strSartNum,$strNum);
if($strAction=='get_list_product')echo event_get_list_product($strProductSortid,$strProductMainSortid,$strNum,$strPage);
if($strAction=='get_list_news')echo event_get_list_news($strNewsSortid,$strNewsMainSortid,$strNum,$strPage);

function event_get_product($sortid,$mainsortid=0,$sartnum=0,$num=20){
	$strResult='';
	if($sortid>0)
	{
		if($sortid==$mainsortid)
		{
			$strSQL="select p.ProductId,p.Code,p.Name,p.Type,p.RootPic,p.SalePrice,(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName from product_tbl p where p.MianProductClassId='$sortid' order by p.ProductId desc limit $sartnum,$num";
		}else{
			$strSQL="select p.ProductId,p.Code,p.Name,p.Type,p.RootPic,p.SalePrice,(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName from product_array_tbl z,product_tbl p where z.ProductId=p.ProductId and z.ProductClassId='$sortid' order by p.ProductId desc limit $sartnum,$num";
		}
	}else{
		$strSQL="select p.ProductId,p.Code,p.Name,p.Type,p.RootPic,p.SalePrice,(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName from product_tbl p order by p.ProductId desc limit $sartnum,$num";
	}
	$result=query($strSQL);
	$i=1;
	while($row=fetch_array($result))
	{
		$ProductId=$row["ProductId"];
		$ProductCode=$row["Code"];
		if(!isnull($row["LocalityName"]))$ProductLocalityName=$row["LocalityName"].',';
		$ProductBrandName=$row["BrandName"];
		$ProductType=$row["Type"];
		$ProductName=$row["Name"];
		$ProductSalePrice=str2int($row["SalePrice"],2);
		$ProductDiscountSalePrice=str2int($row["DiscountSalePrice"],2);
		$ShoppingId=$row["ShoppingId"];
		$ShoppingName=str_mod($row["ShoppingName"],40,38);
		if($ProductDiscountSalePrice>0){
			$strSalePrice='<span>供货价:<font>￥'.$ProductSalePrice.'</font></span><span>特惠价:<label>￥'.$ProductDiscountSalePrice.'</label></span>';
		}else{
			$strSalePrice='<span>供货价:<label>￥'.$ProductSalePrice.'</label></span>';
		}
		$hasPrice=false;
		if($ProductSalePrice>0)$hasPrice=true;
		if($ProductDiscountSalePrice>0)$hasPrice=true;
		if(!$hasPrice)$strSalePrice='<span>供货价:<label class="call_price">在线询价</label></span>';
		if($i%2==0)
		{
			$str_style=' f_right_';
		}else{
			$str_style=' f_left_';
		}
		$strSalePrice=iconv("utf-8","gbk",$strSalePrice);
		$strResult.='<li><a href="product.item.php?num='.$ProductCode.'">
        <p class="item_intro'.$str_style.'intro_area"><em>'.$ProductName.'</em><strong>'.$strSalePrice.'</strong><font>'.$ProductLocalityName.$ProductBrandName.$ProductType.'</font></p>
        <p class="item_img'.$str_style.'img_area"><img src="'.get_img($row["RootPic"]).'" /></p>
        <p class="item_shopping'.$str_style.'shopping_area">'.$ShoppingName.'</p></a>
        </li>';
		$i++;
	}
	return $strResult;
}

function event_get_list_product($sortid,$mainsortid=0,$num=10,$page=0){
	$strResult='';
	$sartnum=$num*$page;
	$sartnum=str2int($sartnum);
	if($sortid>0)
	{
		if($sortid==$mainsortid)
		{
			$strSQL="select p.ProductId,p.Code,p.Name,p.Type,p.RootPic,p.SalePrice,(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName from product_tbl p where p.MianProductClassId='$sortid' order by p.ProductId desc limit $sartnum,$num";
		}else{
			$strSQL="select p.ProductId,p.Code,p.Name,p.Type,p.RootPic,p.SalePrice,(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName from product_array_tbl z,product_tbl p where z.ProductId=p.ProductId and z.ProductClassId='$sortid' order by p.ProductId desc limit $sartnum,$num";
		}
	}else{
		$strSQL="select p.ProductId,p.Code,p.Name,p.Type,p.RootPic,p.SalePrice,(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName from product_tbl p order by p.ProductId desc limit $sartnum,$num";
	}
	$result=query($strSQL);
	$i=1;
	while($row=fetch_array($result))
	{
		$ProductId=$row["ProductId"];
		$ProductCode=$row["Code"];
		if(!isnull($row["LocalityName"]))$ProductLocalityName=$row["LocalityName"].',';
		$ProductBrandName=$row["BrandName"];
		$ProductType=$row["Type"];
		$ProductName=$row["Name"];
		$ProductSalePrice=str2int($row["SalePrice"],2);
		$ProductDiscountSalePrice=str2int($row["DiscountSalePrice"],2);
		$ShoppingId=$row["ShoppingId"];
		$ShoppingName=str_mod($row["ShoppingName"],40,38);
		if($ProductDiscountSalePrice>0){
			$strSalePrice='<span>供货价:<font>￥'.$ProductSalePrice.'</font></span><span>特惠价:<label>￥'.$ProductDiscountSalePrice.'</label></span>';
		}else{
			$strSalePrice='<span>供货价:<label>￥'.$ProductSalePrice.'</label></span>';
		}
		$hasPrice=false;
		if($ProductSalePrice>0)$hasPrice=true;
		if($ProductDiscountSalePrice>0)$hasPrice=true;
		if(!$hasPrice)$strSalePrice='<span>供货价:<label class="call_price">在线询价</label></span>';
		if($i%2==0)
		{
			$str_style=' f_right_';
		}else{
			$str_style=' f_left_';
		}
		$strSalePrice=iconv("utf-8","gbk",$strSalePrice);
		$strResult.='<li><a href="product.item.php?num='.$ProductCode.'">
        <p class="item_intro"><em>'.$ProductName.'</em><strong>'.$strSalePrice.'</strong><font>'.$ProductLocalityName.$ProductBrandName.$ProductType.'</font></p>
        <p class="item_img"><img src="'.get_img($row["RootPic"]).'" /></p>
        <p class="item_shopping">'.$ShoppingName.'</p></a>
        </li>';
		$i++;
	}
	return $strResult;
}

function event_get_list_news($sortid,$mainsortid=0,$num=10,$page=0){
	$strResult='';
	$sartnum=$num*$page;
	$sartnum=str2int($sartnum);
	if($sortid>0)
	{
		if($sortid==$mainsortid)
		{
			$strSQL="select ArcitleId,Title,RootPic,Content,DateTime from arcitle_tbl where MainSortId='$FisrtId' order by ArcitleId desc limit $sartnum,$num";
		}else{
			$strSQL="select ArcitleId,Title,RootPic,Content,DateTime from arcitle_tbl where ArcitleSortId='$sortid' order by ArcitleId desc limit $sartnum,$num";
		}
	}else{
		$strSQL="select ArcitleId,Title,RootPic,Content,DateTime from arcitle_tbl order by ArcitleId desc limit $sartnum,$num";
	}
	$result=query($strSQL);
	$i=1;
	while($row=fetch_array($result))
	{
		$ArcitleId=$row["ArcitleId"];
		$strTitle=$row["Title"];
		$strSpc=iconv("utf-8","gbk",'　');
		$strContent=str_dehtml($row["Content"]);
		$strContent=str_ireplace(array("\r\n", "\r", "\n", $strSpc),"",$strContent);
		$strContent=str_left(strip_tags($strContent),280);
		if($row["DateTime"]>0)$strDateTime=format_dt($row["DateTime"],'%Y-%m-%d');
		if(ex_file($row["RootPic"])){
			$strPic='<p class="news_list_img"><img src="'.get_img($row["RootPic"]).'" /></p>';
			$strStyle='';
		}else{
			$strPic='';
			$strStyle=' class="noImg"';
		}
		$strResult.='<li'.$strStyle.'><a href="news.detail.php?id='.str_url_encode($ArcitleId).'">
        <p class="news_list_intro"><font>'.$strDateTime.'</font><span>'.$strContent.'</span></p>
        '.$strPic.'
        <p class="news_list_title">'.$strTitle.'</p></a>
        </li>';
		$i++;
	}
	return $strResult;
}
?>