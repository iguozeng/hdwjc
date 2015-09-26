<?php

/*是否匹配对象*/
function has_val($str,$val)
{
	$hasData=false;
	$arr=explode(',',$str);
	foreach($arr as $key)
	{
		if($key==$val)
		{
			$hasData=true;break;
		}
	}
	return $hasData;
}

/*返回商品自动编号*/
function get_product_code($mid=1,$hd='TS',$code='00000001')
{
	$strCode=$hd.$code;
	$hdlen=strlen($hd);
	$HasCode=false;
	$rl=query("select Code from product_tbl where Code='$strCode'");
	if(num_rows($rl))$HasCode=true;
	if($HasCode)
	{
		$rl=query("select `Code` from `product_tbl` where left(`Code`,".$hdlen.")='$hd' order by Code desc limit 1");
		if(num_rows($rl)){
			$r=fetch_array($rl);
			$v=str_replace($hd,'',$r[0]);
			if(!is_numeric($v)||$v==""){
				$v=str_right($v,strlen($v)-$hdlen);
			}
			$v=str2int($v)+1;
			$n=strlen($v);
			if($n<8)
			{
				$rcode=str_pad('',(8-$n),'0').$v;
			}else{
				$rcode=$v;
			}
		}else{
			$rcode='00000001';	
		}
		$strCode=get_product_code($mid,$hd,$rcode);
	}
	return $strCode;
}

/*清理购物车重复记录*/
function drop_cart_unique(){
	$UserId=str2int($_SESSION["MemberId"]);
	if($UserId>0){
		$IsRegisterUser=1;
		$UserName=$_SESSION['MemberName'];
	}else{
		$IsRegisterUser=0;
		$UserName=$_COOKIE['UserName'];
	}
	$strSQL="";
	$result=query("select TempOrderId from temp_order_tbl where (UserName='$UserName' and IsRegisterUser='$IsRegisterUser' and ShoppingId>0) and ProductId in (select ProductId from temp_order_tbl group by ProductId having count(ProductId)>1)");
	if(num_rows($result))
	{
		$strSQL.="create table tmp as select min(TempOrderId) as col1 from temp_order_tbl where (UserName='$UserName' and IsRegisterUser='$IsRegisterUser' and ShoppingId>0) group by ProductId;";
		$strSQL.="delete from temp_order_tbl where (UserName='$UserName' and IsRegisterUser='$IsRegisterUser' and ShoppingId>0) and TempOrderId not in (select col1 from tmp);"; 
		$strSQL.="drop table tmp;";
	}
	$result=query("select TempOrderId from temp_order_tbl where (UserName='$UserName' and IsRegisterUser='$IsRegisterUser' and ShoppingId=0) and ProductId in (select ProductId from temp_order_tbl group by ProductId having count(ProductId)>1)");
	if(num_rows($result))
	{
		$strSQL.="create table tmp as select min(TempOrderId) as col1 from temp_order_tbl where (UserName='$UserName' and IsRegisterUser='$IsRegisterUser' and ShoppingId=0) group by ProductId;";
		$strSQL.="delete from temp_order_tbl where (UserName='$UserName' and IsRegisterUser='$IsRegisterUser' and ShoppingId=0) and TempOrderId not in (select col1 from tmp);"; 
		$strSQL.="drop table tmp;";
	}
	if(!isnull($strSQL))array_query($strSQL);
}

/*返回商品类别数组集合*/
$array_product_class=array();
function get_array_product_class($ClassId,$Id=0,$Mode=0/*0=以单一小类ID获取类别数组,1=以商品ID获取类别数组*/){
	if($Mode==0)
	{
		$results=query("select ProductClassId,ProductClassName,MianProductClassId from product_class_tbl where ProductClassId='$ClassId'");
		if(num_rows($results))
		{
			$rows=fetch_array($results);
			$GLOBALS['array_product_class'][]=array($rows[0]=>$rows[1]);
			if($rows[2]>0)
			{
				$result=query("select MianProductClassId from product_class_tbl where ProductClassId='$rows[0]'");
				if(num_rows($result)){$row=fetch_array($result);get_array_product_class($row[0]);}
			}
		}
	}else{
		$results=query("select ProductClassId from product_array_tbl where ProductId='$Id' and ProductClassId='$ClassId'");
		if(num_rows($results))
		{
			$rows=fetch_array($results);
			$result=query("select a.ProductClassId,b.ProductClassName from product_array_tbl a,product_class_tbl b where (a.ProductClassId=b.ProductClassId and a.ProductId='$Id') and b.MianProductClassId='$rows[0]'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$GLOBALS['array_product_class'][]=array($row[0]=>$row[1]);
				get_array_product_class($row[0],$Id,$Mode);
			}
		}
	}
	return $GLOBALS['array_product_class'];
}

/*返回商品类别第一个大类ID*/
function get_fisrt_product_classid($Id)
{
	$results=query("select MianProductClassId from product_class_tbl where ProductClassId='$Id'");
	if(num_rows($results))
	{
		$rows=fetch_array($results);
		if($rows[0]>0)
		{
			$strId=$rows[0];	
			$result=query("select ProductClassId from product_class_tbl where ProductClassId='$rows[0]' and MianProductClassId>0");
			if(num_rows($result)){$row=fetch_array($result);$strId=get_fisrt_product_classid($strId);}
		}
		else
		{
			$strId=$Id;	
		}
	}
	return str2int($strId);
}


/*返回单据编号*/
function get_doc_code($mod="MemberOrderHead",$name="v"/*k=单据类型，v=单据号*/,$code="0000000001",$tbl="sale_order_head_tbl",$field="OrderId")
{
	$hdlen=0;
	$result=query("select DocHeadVal from dochead_tbl where DocHeadClass='$mod'");
	if(num_rows($result)){$row=fetch_array($result);$hd=$row[0];$hdlen=strlen($hd);}
	if($name=="k")
	{
		$strCode=$hd;
	}else{
		$num=$hd.$code;
		$result=query("select `$field` from `$tbl` where `$field`='$num'");
		if(num_rows($result))
		{
			$rl=query("select `$field` from `$tbl` where left(`$field`,".$hdlen.")='$hd' order by right(`$field`,10) desc,AddTime desc,`$field` desc limit 1");
			if(num_rows($rl)){
				$r=fetch_array($rl);
				$v=str_replace($hd,'',$r[0]);
				if(!is_numeric($v)||$v==""){
					$v=str_right($v,strlen($v)-$hdlen);
				}
				$v=str2int($v)+1;
				$n=strlen($v);
				if($n<10)
				{
					$rcode=str_pad('',(10-$n),'0').$v;
				}else{
					$rcode=$v;
				}
			}else{
				$rcode='0000000001';	
			}
			//echo $hd.$rcode;exit;
			$strCode=get_doc_code($mod,$name,$rcode,$tbl,$field);
		}else{
			$strCode=$num;
		}
	}
	return $strCode;
}

/*返回IP所在的区域*/
$arr_area=array();
function get_area_array(){
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$ip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$ip = preg_replace("/^([\d\.]+).*/", "\\1", $ip);
	$eipnum=ip2float($ip);
	$rel=query("select ProvinceId,CityId,DistrictId from ipaddress_tbl where IpStartFloat<='$eipnum' and IpEndFloat>='$eipnum' order by IpEndFloat limit 1");
	if(num_rows($rel)){
		$rs=fetch_array($rel);
		if(str2int($rs[0])>0){
			$r=query("select ProvinceName from province_tbl where ProvinceId='$rs[0]'");
			if(num_rows($r)){
				$s=fetch_array($r);
				$GLOBALS['arr_area'][]=array($rs[0]=>$s[0]);
			}
		}
		if(str2int($rs[1])>0){
			$r=query("select CityName from city_tbl where CityId='$rs[1]'");
			if(num_rows($r)){
				$s=fetch_array($r);
				$GLOBALS['arr_area'][]=array($rs[1]=>$s[0]);
			}
		}
		if(str2int($rs[2])>0){
			$r=query("select DistrictName from district_tbl where DistrictId='$rs[2]'");
			if(num_rows($r)){
				$s=fetch_array($r);
				$GLOBALS['arr_area'][]=array($rs[2]=>$s[0]);
			}
		}
	}
	return $GLOBALS['arr_area'];
}

/*生成商品URL的二维码图片 */
function save_2code($id)
{
	require_once CMSPath.'include/class_lib/class.qrcode.php';
	$photo_path=date("Y-m-d").'/doc/';
	mk_dir(PicPath.$photo_path);
	$ProductId=str2int($id);
	$dtime=date("Y-m-d H:i:s");
	$PostTime=smarty_make_timestamp($dtime);
	$hasfile=false;
	$result=query("select Code,(select PicUrl from product_pic_tbl where ProductId='$ProductId' and IsQrcode=1 limit 1) as PicUrl 
	from `product_tbl` where ProductId='$ProductId'");
	if(num_rows($result))
	{
		$hasfile=true;
		$row=fetch_array($result);
		$Code=$row[0];
		$codefile=$row[1];
	}
	if(ex_file($codefile))$codefile="";
	if($hasfile)
	{
		$url='http://'.SiteUrl.'/item.php?num='.$Code;
		$codeContent=$url.'&mb=1&code='.md5($url);
		if(!isnull($codefile))
		{
			QRcode::png($codeContent,PicPath.$codefile);
			query("update `product_pic_tbl` set PicUrl='$codefile' where ProductId='$ProductId' and IsQrcode=1");
		}else{
			$codefile=$photo_path.'q_'.$ProductId.'_'.str_rm(5).'.png';
			QRcode::png($codeContent,PicPath.$codefile);
			query("insert into `product_pic_tbl`(ProductId,PicUrl,IsQrcode,AddTime) values('$ProductId','$codefile',1,'$PostTime')");
		}
	}
	return false;
}

function get_val($tbl,$name,$id,$val,$mod=0)
{
	$hasData=false;
	$str="";
	$result=query("select `$id` from `$tbl` where `$name`='$val'");
	if(num_rows($result)){$row=fetch_array($result);$str=$row[0];$hasData=true;}
	if(!$hasData&&$mod==1)
	{
		if(!isnull($val))
		{
			$val=iconv("gbk","utf-8",$val);
			query("insert into `$tbl`(`$name`) values('$val')","utf8",1);
			$str=insert_id();
		}
		$str=str2int($str);
	}
	return $str;
}

/*永久删除商品*/
function del_product(){
	$listid=$_POST['id'];
	$url=$_POST['reurl'];
	for($i=0;$i<count($listid);$i++){
		if(is_numeric($listid[$i]))
		{
			$ProductId=str2int($listid[$i]);
			if($ProductId>0)
			{
				$strSQL="";
				$result=query("select TblName from product_tbl where ProductId='$ProductId'");
				if(num_rows($result)){$row=fetch_array($result);$TblName=$row[0];}
				$strSQL.="delete from `$TblName` where `ProductId`='$ProductId';";
				$strSQL="delete from product_pic_tbl where `ProductId`='$ProductId';";
				$strSQL.="delete from product_body_tbl where `ProductId`='$ProductId';";
				$strSQL.="delete from product_array_tbl where `ProductId`='$ProductId';";
				$strSQL.="delete from product_inventory_tbl where `ProductId`='$ProductId';";
				$strSQL.="delete from product_tbl where `ProductId`='$ProductId';";
				//added by huafang at 2015/8/3
				$strSQL.="delete from product_type_tbl where `ProductId`='$ProductId';";
				//end added
				if(!isnull($strSQL))array_query($strSQL);
			}
		}
	}
	header("Location:$url");
	return false;
}

/*设置商品属性类别集合*/
function set_array_product_classid($Id,$Lst)
{
	query("delete from product_array_tbl where `ProductId`='$Id'");
	$Arr=explode(',',$Lst);
	for($i=0;$i<=count($Arr);$i++)
	{
		$ProductClassId=str2int($Arr[$i]);
		if($ProductClassId>0)
		{
			$HasData=true;
			$result=query("select ProductClassId,(select ProductId from product_array_tbl where ProductId='$Id' and ProductClassId=product_class_tbl.ProductClassId) as ProductId from product_class_tbl where ProductClassId='$ProductClassId'");
			if(num_rows($result)){
				$row =fetch_array($result);
				if(str2int($row['ProductId'])>0)$HasData=false;
			}else{
				$HasData=false;
			}
			if($HasData)query("insert into `product_array_tbl`(ProductId,ProductClassId) values('$Id','$ProductClassId')");
		}
	}
	return false;
}

/*设置商品用途类别集合*/
function set_array_product_usesortid($Id,$Lst)
{
	query("delete from product_usesort_tbl where `ProductId`='$Id'");
	$Arr=explode(',',$Lst);
	for($i=0;$i<=count($Arr);$i++)
	{
		$UseSortId=str2int($Arr[$i]);
		if($UseSortId>0)
		{
			$HasData=true;
			$result=query("select UseSortId from use_sort_tbl where UseSortId='$UseSortId'");
			if(!num_rows($result))$HasData=false;
			$result=query("select ProductId from product_usesort_tbl where ProductId='$Id' and UseSortId='$UseSortId'");
			if(num_rows($result))$HasData=false;
			if($HasData)
			{
				query("insert into `product_usesort_tbl`(ProductId,UseSortId) values('$Id','$UseSortId')");
			}
		}
	}
	return false;
}

/*返回资讯类别第一个大类ID*/
function get_main_arcitle_classid($Id)
{
	$results=query("select BeSortId from arcitle_sort_tbl where ArcitleSortId='$Id'");
	if(num_rows($results))
	{
		$rows=fetch_array($results);
		if($rows[0]>0)
		{
			$strId=$rows[0];	
			$result=query("select ArcitleSortId from arcitle_sort_tbl where ArcitleSortId='$strId' and BeSortId>0");
			if(num_rows($result)){$row=fetch_array($result);$strId=get_main_arcitle_classid($strId);}
		}
		else
		{
			$strId=$Id;	
		}
	}
	return $strId;
}

/*返回所有商品类别的下拉列表select中的option*/
function obj_select_product_class($SortId,$level=1,$SelectId=0){
	if($SortId==0)
	{
		$strSQL="select ProductClassId,ProductClassName,MianProductClassId from product_class_tbl where MianProductClassId=0 order by ProductClassId";	
	}
	else
	{
		$strSQL="select ProductClassId,ProductClassName,MianProductClassId from product_class_tbl where MianProductClassId='$SortId' order by ProductClassId";	
	}
	$results=query($strSQL);
	if(num_rows($results))
	{
		$lstr=str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level);
     	$lstr.='└';
		while($rows=fetch_array($results))
		{
			if($level==10) break;
			if($rows[0]==$SelectId){$strSel=' selected';}else{$strSel='';}
			$Title=str_ireplace(array("\r\n", "\r", "\n"),"",$rows[1]);
			$str.='<option value="'.$rows[0].'"'.$strSel.'>'.$lstr.$Title.'</option>';
			$result=query("select MianProductClassId from product_class_tbl where MianProductClassId='$rows[0]'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$str.=obj_select_product_class($row[0],$level+1,$SelectId);
			}
		}
	}
	return $str;
}

function obj_li_array_product_class($SortId,$ListId="",$level=1){
	
	if($SortId==0)
	{
		$strSQL="select ProductClassId,ProductClassName,MianProductClassId from product_class_tbl where MianProductClassId=0 order by ProductClassId";	
	}
	else
	{
		$strSQL="select ProductClassId,ProductClassName,MianProductClassId from product_class_tbl where MianProductClassId='$SortId' order by ProductClassId";	
	}
	$results=query($strSQL);
	if(num_rows($results))
	{
		if($level!=1){$lstr=str_repeat("----", $level);}
		while($rows=fetch_array($results))
		{
			if($level==10) break;
			if(has_val($ListId,$rows[0])){$strSelected=' checked';$strStyle=' class="Selected"';}else{$strSelected='';$strStyle='';}
			$Title=str_ireplace(array("\r\n", "\r", "\n"),"",$rows[1]);
			$str.='<li'.$strStyle.'><input type="checkbox" name="PCD[]" id="i'.$rows[0].'" value="'.$rows[0].'"'.$strSelected.' /><label for="i'.$rows[0].'">'.$lstr.$Title.'</label></li>';
			$result=query("select MianProductClassId from product_class_tbl where MianProductClassId='$rows[0]'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$str.=obj_li_array_product_class($row[0],$ListId,$level+1);
			}
		}
	}
	return $str;
}

function obj_li_array_arcitle_class($SortId,$ListId="",$level=1){
	
	if($SortId==0)
	{
		$strSQL="select ArcitleSortId,ArcitleSortName,BeSortId from arcitle_sort_tbl where BeSortId=0 order by ArcitleSortId";	
	}
	else
	{
		$strSQL="select ArcitleSortId,ArcitleSortName,BeSortId from arcitle_sort_tbl where BeSortId='$SortId' order by ArcitleSortId";	
	}
	$results=query($strSQL);
	if(num_rows($results))
	{
		if($level!=1){$lstr=str_repeat("----", $level);}
		while($rows=fetch_array($results))
		{
			if($level==10) break;
			if(has_val($ListId,$rows[0])){$strSelected=' checked';$strStyle=' class="Selected"';}else{$strSelected='';$strStyle='';}
			$str.='<li'.$strStyle.'><input type="checkbox" name="ACD[]" id="i'.$rows[0].'" value="'.$rows[0].'"'.$strSelected.' /><label for="i'.$rows[0].'">'.$lstr.$rows[1].'</label></li>';
			$result=query("select BeSortId from arcitle_sort_tbl where BeSortId='$rows[0]'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$str.=obj_li_array_arcitle_class($row[0],$ListId,$level+1);
			}
		}
	}
	return $str;
}

function obj_li_array_ads_class($SortId,$ListId="",$level=1){
	
	if($SortId==0)
	{
		$strSQL="select AdsSortId,AdsSortName,MainSortId from ads_sort_tbl where MainSortId=0 order by AdsSortId";	
	}
	else
	{
		$strSQL="select AdsSortId,AdsSortName,MainSortId from ads_sort_tbl where MainSortId='$SortId' order by AdsSortId";	
	}
	$results=query($strSQL);
	if(num_rows($results))
	{
		if($level!=1){$lstr=str_repeat("----", $level);}
		while($rows=fetch_array($results))
		{
			if($level==10) break;
			if(has_val($ListId,$rows[0])){$strSelected=' checked';$strStyle=' class="Selected"';}else{$strSelected='';$strStyle='';}
			$str.='<li'.$strStyle.'><input type="checkbox" name="ACD[]" id="i'.$rows[0].'" value="'.$rows[0].'" '.$strSelected.' /><label for="i'.$rows[0].'">'.$lstr.$rows[1].'</label></li>';
			$result=query("select MainSortId from ads_sort_tbl where MainSortId='$rows[0]'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$str.=obj_li_array_ads_class($row[0],$ListId,$level+1);
			}
		}
	}
	return $str;
}

/*返回广告第一个大类别ID*/
function get_main_ads_classid($Id)
{
	$strSQL="select MainSortId from ads_sort_tbl where AdsSortId='$Id'";	
	$rl=query($strSQL);
	if(num_rows($rl))
	{
		$rs=fetch_array($rl);
		if($rs[0]>0)
		{
			$strId=$rs[0];	
			$r=query("select AdsSortId from ads_sort_tbl where AdsSortId='$strId' and MainSortId>0");
			if(num_rows($r)){$s=fetch_array($r);$strId=get_main_ads_classid($strId);}
		}
		else
		{
			$strId=$Id;	
		}
	}
	return $strId;
}

/*返回序列会员号*/
function str_member($s)
{
	$HasMember=false;
	$result=query("select MemberId from member_tbl where MemberName='$s'");
	if(num_rows($result))$HasMember=true;
	if($HasMember)
	{
		$result=query("select MemberId from member_tbl order by MemberId desc");
		if(num_rows($result)){
			$row=fetch_array($result);
			$RegMemberName='Member'.($row["MemberId"]+1);
		}
		else
		{
			$RegMemberName='Member10001';	
		}
		$str=str_member($RegMemberName);
	}
	else
	{
		$str=$s;
	}
	return $str;
}			

/*返回省份、市、县级名称数组集合*/
function get_area_name($district,$city=0)
{
	$district=str2int($district);
	$city=str2int($city);
	$str=array();
	if($district>0)
	{
		$result=query("select a.DistrictName,b.CityName,c.ProvinceName from district_tbl a,city_tbl b,province_tbl c where (a.CityId=b.CityId and b.ProvinceId=c.ProvinceId) and a.DistrictId='$district'");
		if(num_rows($result))
		{
			$row=fetch_array($result);
			$str[0]=$row[0];
			$str[1]=$row[1];
			$str[2]=$row[2];
		}
	}else if($city>0){
		$result=query("select b.CityName,c.ProvinceName from city_tbl b,province_tbl c where b.ProvinceId=c.ProvinceId and a.CityId='$city'");
		if(num_rows($result))
		{
			$row=fetch_array($result);
			$str[0]='-';
			$str[1]=$row[1];
			$str[2]=$row[2];
		}
	}else{
		$str[0]='-';$str[1]='-';$str[2]='-';	
	}
	return $str;
}

function insert_manage_log($msg,$id,$islogin=0){
	$ip=get_client_ip();
	$dTime=smarty_make_timestamp(date("Y-m-d H:i:s"));
	$strSQL="insert into manage_log_tbl(ManageId,Content,OperationIp,IsLogin,DateTime) values('$id','$msg','$ip','$islogin','$dTime')";
	query($strSQL);
	return false;
}

function insert_member_log($msg,$id,$iserr=0,$islogin=0){
	$ip=get_client_ip();
	$dTime=smarty_make_timestamp(date("Y-m-d H:i:s"));
	$strSQL="insert into member_log_tbl(MemberId,Content,OperationIp,DateTime) values('$id','$msg','$ip','$dTime')";
	query($strSQL);
	return false;
}

function insert_points_log($id,$val,$msg,$o_id=''){
	$dTime=date("Y-m-d H:i:s");
	$AddTime=smarty_make_timestamp($dTime);
	$ExpireTime=dateadd('d',90,$dTime);
	$ExpireTime=smarty_make_timestamp($ExpireTime);
	$strSQL="insert into points_log_tbl(MemberId,LinkOrderId,Points,Remark,AddTime,ExpireTime)values('$id','$o_id','$val','$msg','$AddTime','$ExpireTime')";
	query($strSQL);
	return false;
}

/*插入流水总账*/
function set_running_account($uid,$name='业务订单',$doc='关联单据',$in='0',$out='0',$body='')
{
	$dtime=date("Y-m-d H:i:s");
	$PostTime=smarty_make_timestamp($dtime);
	$MemberId=str2int($uid);$AgentId=0;$OverDeposit=0;
	if($MemberId>0)
	{
		$result=query("select AgentId,(select OverDeposit from running_account_tbl where MemberId='$MemberId' order by RunningId desc limit 1) as OverDeposit from member_tbl where MemberId='$MemberId'");
		if(num_rows($result)){
			$row=fetch_array($result);
			$AgentId=$row[0];
			$OverDeposit=str2int($row[1],2);
		}
		$LinkOrderId=$doc;
		$Title=$name;
		$InAmount=abs(str2int($in,2));
		$OutAmount=abs(str2int($out,2));
		$Remark=$body;
		if($InAmount>0)
		{
			$strSQL="update member_tbl set `Deposit`=Deposit+$InAmount where MemberId='$MemberId';";
			$OverDeposit=$OverDeposit+$InAmount;
		}
		if($OutAmount>0)
		{
			$strSQL="update member_tbl set `Deposit`=Deposit-$OutAmount where MemberId='$MemberId';";
			$OverDeposit=$OverDeposit-$OutAmount;
		}
		$strSQL.="insert into running_account_tbl(`MemberId`,`AgentId`,LinkOrderId,Title,`InAmount`,`OutAmount`,`OverDeposit`,Remark,AddTime) values
		('$MemberId','$AgentId','$LinkOrderId','$Title','$InAmount','$OutAmount','$OverDeposit','$Remark','$PostTime');";
		array_query($strSQL);
	}
	return false;
}

/*导出表单提交的数据Excel*/
function export_data(){
	$listid=$_POST['id'];
	$list_Export_Body=$_POST['Export_Body'];
	$list_Export_Head=explode(',',$_POST['Export_Head']);
	$url=$_POST['reurl'];
	if(count($listid)==0)msg($GLOBALS['MsgTitle'][0].'没有选择操作的对象');
	$dtime=date("Y-m-d H:i:s");
	$PostTime=smarty_make_timestamp($dtime);
	$str="<tr>";
	foreach($list_Export_Head as $val)
	{
		$str.="<th>$val</th>";
	}
	$str.="</tr>";
	for($i=0;$i<count($listid);$i++)
	{
		$OrderId=$listid[$i];
		if(!isnull($OrderId))
		{
			$ExportBody=$list_Export_Body[$i];
			$array_Body=explode(',',$ExportBody);
			$str.="<tr>";
			foreach($array_Body as $key)
			{
				$str.="<td>$key</td>";
			}
			$str.="</tr>";
		}
	}
	ob_end_clean();
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:attachment;filename=Export_Data_$PostTime.xls");
	echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
	<title>Export_Data</title>
	<style id="Classeur1_16681_Styles"></style>
	<style type="text/css">td{height:24px;overflow:hidden;white-space:nowrap;}</style>
	</head>
	<div id="Classeur1_16681" align=center x:publishsource="Excel">
	<table x:st width="100%" border="1">';
	echo $str;
	echo '</table></div>';
	echo "</body>";
	echo "</html>";
	exit;
	return false;
}

/*======================================以下前端菜单数据应用=========================================*/
/*左边热门菜单*/
function get_hot_menu($id,$num,$listurl='/list.php?sortid='){
	$str='';
	$results=query("select ItemHeadId,Title,ClassVal,HasChd,ProductClassId from site_index_menu_item_head_tbl where MianProductClassId='$id' and Actived=1 order by OrderNumber,ItemHeadId desc");
	if(num_rows($results))
	{
		while($rows=fetch_array($results)){
			$Title=str_dehtml($rows[1]);
			$Title=str_ireplace(array("\r\n", "\r", "\n"),"",$Title);
			$str.='<li class="'.$rows[2].'"><div class="hot_menu_item" id="item'.$num.'"><h2>'.$Title.'</h2></div><div class="hot_menu_panel" id="panel'.$num.'">';
			$result=query("select b.ProductClassId from site_index_menu_item_detail_tbl a,product_class_tbl b where a.ProductClassId=b.ProductClassId and a.ItemHeadId='$rows[0]' order by a.ProductClassId desc");
			if(num_rows($result))
			{
				$str.='<ul class="hot_menu_panel_chd">';
				while($row=fetch_array($result)){
					$rt=query("select a.ProductClassId,a.ProductClassName,(select count(ProductClassId) from product_class_tbl where MianProductClassId=a.ProductClassId) as chd from product_class_tbl a where a.MianProductClassId='$row[0]' order by a.OrderNumber,a.ProductClassId desc");
					if(num_rows($rt))
					{
						while($rs=fetch_array($rt)){
							$Title=str_dehtml($rs[1]);
							$Title=str_ireplace(array("\r\n", "\r", "\n"),"",$Title);
							if($rs[2]==0){$str.='<li class="nochd"><a href="'.$listurl.$rs[0].'">'.$Title.'</a></li>';}else{
								$str.=' <li><div class="hot_menu_sort_0"><h3><a href="'.$listurl.$rs[0].'">'.str_mod($Title,14,0,"").'</a></h3>';
								$resul=query("select a.ProductClassId,a.ProductClassName,(select count(ProductClassId) from product_class_tbl where MianProductClassId=a.ProductClassId) as chd from product_class_tbl a where a.MianProductClassId='$rs[0]' order by a.OrderNumber,a.ProductClassId desc");
								if(num_rows($resul))
								{
									$str.='<ul class="hot_menu_sort_chd">';
									while($rw=fetch_array($resul)){
										$Title=str_dehtml($rw[1]);
										$Title=str_ireplace(array("\r\n", "\r", "\n"),"",$Title);
										if($rw[2]==0){$str.='<li class="nochd"><a href="'.$listurl.$rw[0].'">'.$Title.'</a></li>';}else{
											$str.='<li><div class="hot_menu_sort_1"><h4><a href="'.$listurl.$rw[0].'">'.str_mod($Title,10,0,"").'</a></h4>';
											$rel=query("select ProductClassId,ProductClassName from product_class_tbl where MianProductClassId='$rw[0]' order by OrderNumber,ProductClassId desc");
											if(num_rows($rel))
											{
												$str.='<ul>';
												while($r=fetch_array($rel)){
													$Title=str_dehtml($r[1]);
													$Title=str_ireplace(array("\r\n", "\r", "\n"),"",$Title);
													$str.='<li><a href="'.$listurl.$r[0].'">'.$Title.'</a></li>';
												}
												$str.='</ul>';
											}
											$str.='<div></li>';
										}
									}
									$str.='</ul>';
								}
								$str.='</div></li>';
							}
						}
					}
				}
				$str.='</ul><div class="hot_menu_ads"><h6>优秀相关企业推介</h6><p></p><p></p><p></p><p></p><div class="cf"></div></div>';
			}
			$str.='</div></li>';
			$num++;
		}
	}
	return $str;
}

/*导航下拉菜单*/
function get_navigation_menu(){
	$listurl="/list.php?sortid=";
	$n=0;
	$str='';
	$results=query("select ProductClassId,ProductClassName from product_class_tbl where MianProductClassId=0 order by OrderNumber,ProductClassId desc");
	if(num_rows($results))
	{
		while($rows=fetch_array($results)){
			$Name=$rows[1];
			$Name=str_ireplace(array("\r\n", "\r", "\n"),"",$Name);
			$str.='<li><div class="menu_item" id="i'.$n.'"><a href="'.$listurl.$rows[0].'">'.$rows[1].'<font>>></font></a></div><div class="menu_panel" id="p'.$n.'">';
			$result=query("select ProductClassId,ProductClassName from product_class_tbl where MianProductClassId='$rows[0]' order by OrderNumber,ProductClassId desc");
			if(num_rows($result))
			{
				while($row=fetch_array($result)){
					$Name=$row[1];
					$Name=str_ireplace(array("\r\n", "\r", "\n"),"",$Name);
					$str.='<dl><dt><a href="'.$listurl.$row[0].'">'.$Name.'</a></dt><dd><ul>';
					$resul=query("select ProductClassId,ProductClassName from product_class_tbl where MianProductClassId='$row[0]' order by OrderNumber,ProductClassId desc");
					if(num_rows($resul))
					{
						while($rw=fetch_array($resul)){
							$Name=$rw[1];
							$Name=str_ireplace(array("\r\n", "\r", "\n"),"",$Name);
							$str.='<li><a href="'.$listurl.$rw[0].'">'.$Name.'</a></li>';
						}
					}
					$str.='</ul><div class="cf"></div></dd><div class="cf"></div></dl>';
				}
			}
			$str.='</div></li>';
			$n++;
		}
	}
	return $str;
}

function set_news_sitemap(){
	$arrayNewssortid="2,3,4,16,17,19,23,25";
	$result=query("select ArcitleId,Title,RootPic,Content,DateTime,MainSortId,(select ArcitleSortName from arcitle_sort_tbl where ArcitleSortId=arcitle_tbl.ArcitleSortId) as ArcitleSortName from arcitle_tbl where ArcitleSortId in($arrayNewssortid) order by ArcitleId desc limit 50");
	while($rows=fetch_array($result))
	{
		$strTitle=$rows["Title"];
		$strMainSortId=$rows["MainSortId"];
		$strSortName=$rows["ArcitleSortName"];
		$strDatetime=date(DATE_RSS,$rows["DateTime"]);
		$strContent=str_dehtml($rows["Content"]);
		$strContent=str_ireplace(array("\r\n", "\r", "\n", "　","	"),"",$strContent);
		$strContent=str_left(strip_tags($strContent),400);
		if($strMainSortId==18)
		{
			$strUrl="http://".SiteUrl."/news_detail.php?id=".($rows['ArcitleId']);
		}else{
			$strUrl="http://".SiteUrl."/news_detail.php?id=".($rows['ArcitleId']);
		}
		if(ex_file($rows["RootPic"])){
			$strImage='<image><![CDATA['.get_img($rows["RootPic"]).']]></image>';
			$strDescriptionimage='<img src='.get_img($rows["RootPic"]).'>';
		}else{
			$strImage='';
			$strDescriptionimage='';
		}
		$item.='<item><title><![CDATA['.$strTitle.']]></title><link><![CDATA['.$strUrl.']]></link><author><![CDATA['.SiteName.']]></author><guid>'.$rows["ArcitleId"].'</guid><category><![CDATA['.$strSortName.']]></category><pubDate>'.$strDatetime.'</pubDate><comments />'.$strImage.'<description><![CDATA['.$strContent.$strDescriptionimage.']]></description></item>';
	}
	$XML_Code='<?xml version="1.0" encoding="gb2312"?>
	<?xml-stylesheet type="text/xsl" href="http://'.SiteUrl.'/rss/rssfeed.xsl" version="1.0"?>
	<rss version="2.0">
		<channel>
		<title><![CDATA['.SiteName.']]></title>
		<image><title /><link>http://'.SiteUrl.'/images/logo.gif</link><url>http://'.SiteUrl.'/images/logo.gif</url></image>
		<description><![CDATA['.SiteDescription.']]></description>
		<link>http://'.SiteUrl.'</link>
		<language>gb2312</language>
		<generator />
		<channel>新闻资讯</channel>
		<copyright>Copyright '.date("Y").' All Rights Reserved</copyright>
		<pubDate>'.date("Y-m-d H:i:s").'</pubDate>
		<category />
		'.$item.'
		</channel>
	</rss>';
	require_once CMSPath.'include/function_lib/function.io.php';
	$XML_File=SitePath.'rss/news.xml';
	wirte_file($XML_File,$XML_Code);
	return false;
}

function set_product_sitemap(){
	$result=query("select p.ProductId,p.Code,p.Name,p.Type,p.Intro,p.RootPic,p.SalePrice,p.ModTotal,p.AddTime,c.ProductClassName,
	(select LocalityName from locality_class_tbl where LocalityId=p.LocalityId limit 1) as LocalityName,
	(select a.SalePrice from product_inventory_tbl a,inventory_class_tbl b where (a.InventoryClassId=b.InventoryClassId and b.IsDiscount=1 and a.InvTotal>0) and a.ProductId=p.ProductId limit 1) as DiscountSalePrice,
	(select BrandName from brand_class_tbl where BrandId=p.BrandId limit 1) as BrandName,
	(select a.Body from product_body_tbl a,body_class_tbl b where a.ProductId=p.ProductId and a.BodyClassId=b.BodyClassId and b.IsRoot=1 limit 1) Productbody,
	(select ShoppingId from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingId,(select Name from shopping_tbl where AgentId=p.AgentId limit 1) as ShoppingName
	from product_tbl p,product_class_tbl c 
	where p.ProductClassId=c.ProductClassId order by p.ProductId desc limit 50");
	while($rows=fetch_array($result))
	{
		$ProductId=$rows["ProductId"];
		$ProductClassName=$rows["ProductClassName"];
		$ProductCode=$rows["Code"];
		$ProductType=$rows["Type"];
		$ProductBrandName=$rows["BrandName"];
		$ProductLocalityName=$rows["LocalityName"];
		$ProductName=$rows["Name"];
		$ProductBody=str_dehtml($rows["Intro"]);
		$ProductBody=str_ireplace(array("\r\n", "\r", "\n", "　","	"),"",$ProductBody);
		$ProductBody=str_left(strip_tags($ProductBody),200);
		$Datetime=date(DATE_RSS,$rows["AddTime"]);
		$ProductSalePrice=str2int($rows["SalePrice"],2);
		$ProductDiscountSalePrice=str2int($rows["DiscountSalePrice"],2);
		$strSalePrice='';
		$ProductOutTotal=str2int($rows["OutTotal"]);
		$ProductModTotal=str2int($rows["ModTotal"]);
		if(!isnull($rows["ShoppingName"]))
		{
			$ShoppingName=$rows["ShoppingName"];
		}else{
			$ShoppingName=SiteName;
		}
		if($ProductDiscountSalePrice>0){
			$strSalePrice='<span class="price">供货价:<font>￥'.$ProductSalePrice.'</font></span><span class="price">特惠价:<label>￥'.$ProductDiscountSalePrice.'</label></span>';
		}else{
			$strSalePrice='<span class="price">供货价:<label>￥'.$ProductSalePrice.'</label></span>';
		}
		$hasPrice=false;
		if($ProductSalePrice>0)$hasPrice=true;
		if($ProductDiscountSalePrice>0)$hasPrice=true;
		if(!$hasPrice)$strSalePrice='<span class="price">供货价:<label class="call_price">在线询价</label></span>';
		if(ex_file($rows["RootPic"])){
			$strImage='<image><![CDATA['.get_img($rows["RootPic"]).']]></image>';
			$strDescriptionimage='<img src='.get_img($rows["RootPic"]).'>';
		}else{
			$strImage='';
			$strDescriptionimage='';
		}
		$strUrl="http://".SiteUrl."/item.php?num=".$ProductCode;
		$item.='<item><title><![CDATA['.$ProductLocalityName.$ProductBrandName.$ProductName.']]></title><link><![CDATA['.$strUrl.']]></link><author><![CDATA['.$ShoppingName.']]></author><guid>'.$rows["ProductId"].'</guid><category><![CDATA['.$ProductClassName.']]></category><pubDate>'.$Datetime.'</pubDate><comments />'.$strImage.'<description><![CDATA['.$ProductBody.$strDescriptionimage.']]></description></item>';
	}
	$XML_Code='<?xml version="1.0" encoding="gb2312"?>
	<?xml-stylesheet type="text/xsl" href="http://'.SiteUrl.'/rss/rssfeed.xsl" version="1.0"?>
	<rss version="2.0">
		<channel>
		<title><![CDATA['.SiteName.']]></title>
		<image><title /><link>http://'.SiteUrl.'/images/logo.gif</link><url>http://'.SiteUrl.'/images/logo.gif</url></image>
		<description><![CDATA['.SiteDescription.']]></description>
		<link>http://'.SiteUrl.'</link>
		<language>gb2312</language>
		<generator />
		<channel>商品数据</channel>
		<copyright>Copyright '.date("Y").' All Rights Reserved</copyright>
		<pubDate>'.date("Y-m-d H:i:s").'</pubDate>
		<category />
		'.$item.'
		</channel>
	</rss>';
	require_once CMSPath.'include/function_lib/function.io.php';
	$XML_File=SitePath.'rss/product.xml';
	wirte_file($XML_File,$XML_Code);
	return false;
}
?>