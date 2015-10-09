<?php
//if(!is_mobile())header("Location:/");
class global_event{
	
	private $selectProductClassId;
	private $keywords;
	
	public function __construct()
	{
		$this->selectProductClassId=str2int($_GET['sortid']);
		$this->ProductKeywords=$_GET['keywords'];
		$this->NewsKeywords=$_GET['keywords'];
	}
	
	function get_menu(){
		$str='<div class="app_menu"><a href="m_product_list.php"';
		if($GLOBALS['page_index']=='list'){$str.=' class="selected"';}
		$str.='>商品列表</a><a href="m_certified.php"';
		if($GLOBALS['page_index']=='cert'){$str.=' class="selected"';}
		$str.='>实体资质</a><a href="m_news_list.php?sortid=3"';
		if($GLOBALS['page_index']=='news_3'){$str.=' class="selected"';}
		$str.='>新闻中心</a><a href="m_news_list.php?sortid=4"';
		if($GLOBALS['page_index']=='news_4'){$str.=' class="selected"';}
		$str.='>行业资讯</a></div>';
		return $str;
	}
	


	function get_hot_sort(){
		$str='<div class="search"><form action="m_product_query.php" method="get" name="searchform" autocomplete="off"><input type="text" class="keys" name="keywords" placeholder="请输入商品关键词..."  value="'.$this->ProductKeywords.'"><span class="search_send"></span></form></div><div class="app_hot_sort">';
		$result=query("select ProductClassId,ProductClassName from product_class_tbl where MianProductClassId=ProductClassId order by OrderNumber,ProductClassId");
		if(num_rows($result))
		{
			$str.='<ul>';
			while($row=fetch_array($result))
			{
				if($this->selectProductClassId==$row[0]){$strSelected=' class="selected"';}else{$strSelected='';}
				$str.='<li'.$strSelected.'><a href="product.list.php?sortid='.$row[0].'">'.$row[1].'</a></li>';
			}
			$str.='</ul><div class="cf"></div>';
		}
		$str.='</div>';
		return $str;
	}
	
	function get_news_list($sortid,$sartnum=0,$num=5){
		$str='';
		$result=query("select distinct a.ArcitleId,b.Title,b.DateTime from arcitle_array_tbl a,arcitle_tbl b where a.ArcitleId=b.ArcitleId and a.ArcitleSortId=b.ArcitleSortId and b.IsBest=1 and a.ArcitleSortId=$sortid order by b.OrderNumber,a.ArcitleId desc limit $sartnum,$num");
		if(num_rows($result))
		{
			while($rows=fetch_array($result))
			{
				if(str2int(datediff("d",date("Y-m-d H:i:s"),format_dt($rows['DateTime'],'%Y-%m-%d %H:%M:%S')))<=45){$strStyle=' class="chk"';}else{$strStyle='';}
				$str.='<li><a href="/news_detail.php?id='.$rows[0].'" title="'.$rows["Title"].'" class="fl">'.$rows["Title"].'</a><span class="fr">'.format_dt($rows['DateTime'],'%y-%m-%d').'</span><div class="clear"></div></li>';
			}
		}else{
			$str.='<li><a>暂无相关信息</a></li>';	
		}
		return $str;
	}
	
	/*
	** author by jiaown
	** param 获取信息类别名称
	*/
	function get_news_title($sortid){
		$str='';
		$result=query("select ArcitleSortId,ArcitleSortName from arcitle_sort_tbl where BeSortId=1 and ArcitleSortId=$sortid order by OrderNumber,ArcitleSortId limit 3");	
		if(num_rows($result))
		{
			while($rows=fetch_array($result))
			{
				$str.='<b class="txtS fl">'.$rows[1].'</b><a class="fr txtS" href="/news_list.php?sortid='.$rows[0].'">+更多&gt;&gt;</a><div class="clear"></div>';
			}
		}
		return $str;
	}
	
	function get_header_menu(){
		$str='<div id="ui-header"><div class="fixed"><a class="ui-title" id="popmenu"><font>'.SiteName.'</font>'.Tel400.'</a><a class="ui-btn-left_pre" href="javascript:history.go(-1);"></a><a class="ui-btn-right" href="javascript:location.reload();"></a><a href="" class="ui-btn-right_menu"></a></div></div>
<div id="overlay"></div>
<div id="win"><ul class="dropdown"><li><a href="/m.php"><span>返回首页</span></a></li><li><a href="/m_process.php"><span>交易流程</span></a></li><li><a href="/m_about_us.php"><span>关于我们</span></a></li><li><a href="tel:'.Tel400.'"><span>电话咨询</span></a></li><div class="cf"></div></ul></div>';
		return $str;
	}

	function get_copyright(){
		$str='<div class="about"><ul><li><a href="m_about_us.php">关于我们</a></li><li><a href="m_about_us.php?id=873">平台优势</a></li><li><a href="m_about_us.php?id=875">媒体报道</a></li><li><a href="m_about_us.php?id=874">联系我们</a></li></ul></div><div class="copyright">&copy; 2015 江苏华东五金城有限公司<br />江苏省工商联五金机电商会指定线上商品交易平台<br />苏ICP备11042666号-2</div>';
		return $str;
	}
	
	//added by huafang at 2015.9.13
	public function get_slides()
	{
		$str='<div class="slides">
			<dl>
			<dt><a href="member.control.php">会员操作中心</a></dt>
			<dd><ul>
			<li><a href="cart.php">购物车</a></li><li><a href="member.order.list.php">订单查询</a></li><li><a href="member.bought.php">已购商品</a></li><li><a href="member.pay.php?type=free&num=100">在线充值</a></li><li><a  href="member.deposit.php">预存余额</a></li><li><a href="member.account.php">历史账单</a></li><li><a href="member.points.php">积分累计</a></li><li><a href="member.profile.php">档案修改</a></li><li><a href="member.login.history.php">登录历史</a></li><li><a href="member.login.out.php">刷新登录</a></li>
			</ul></dd>
			</dl>
		</div>';
		return $str;
	}
	
	public function get_header()
	{
		$str='<div class="navbar"><font><a>返回上页</a></font><h1>'.$this->HeaderTitle.'</h1><span><strong><a>返回首页</a></strong><label><a>功能导航</a></label></span></div>';
		return $str;
	}
	//end added
	
		function get_list_sort($sortid,$selectid){
		$result=query("select ProductClassId,NavigationName,Id from site_navigation_left1_tbl where FromMenuPanelId='".$sortid."' order by OrderNumber;");
		if(num_rows($result))
		{
			while($row=fetch_array($result))
			{
				$str.='<li><a href="goods_list.php?sortid='.$row[0].'">'.$row[1].'</a></li>';
			}
		}else{
			$str.='<a>无下级分类</a>';	
		}
		return $str;
	}
	
	function event_get_product($sortid,$mainsortid=0,$sartnum=0,$num=20,$flag=1){
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
		if($flag==1){
		$strResult.='
		<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="'.get_img($row["RootPic"]).'" /></div>
					<div class="tuijian_name"><a href="product.item.php?num='.$ProductCode.'">'.$ProductName.'</a></div>
					<div class="tuijian_price"><label>￥'.$ProductSalePrice.'</label></div>
					<div class="tuijian_btn"><a href="product.item.php?num='.$ProductCode.'"><img src="images/tuijian_btn.png" /></a></div>
		</li>';}else{
		$strResult.='<li class="fl">
				<a href="product.item.php?num='.$ProductCode.'" class="tehui_goods">
					<img class="tehui_pic" src="'.get_img($row["RootPic"]).'" />
					<span class="tehui_name">'.$ProductName.'</span>
				</a>
				<div class="tehui_purchase wrapper txt_wrapper">
					<img class="bg" src="images/index_price_bg.png" />
					<span class="tehui_price txtXS">￥'.$ProductSalePrice.'</span>
					<a class="tehui_btn txtXS" href="product.item.php?num='.$ProductCode.'">立即购买</a>
				</div>
			</li>';
		}
		$i++;
	}
	return $strResult;
}
	
}
?>