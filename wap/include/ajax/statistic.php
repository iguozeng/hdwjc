<?php
require_once '../init.php';
header("Content-type:text/html;charset=utf-8");
header("Content-Type:text/plain;charset=gb2312");
$domain=$_SERVER['HTTP_HOST'];
$str_url=str_putdata($_POST['u']);
if(str_left($str_url,1)=="/")$str_url=str_right($str_url,strlen($str_url)-1);
$str_url=str_left($str_url,100);
$str_fromurl=str_putdata($_POST['f']);
$is_me=str_instr($str_fromurl,$domain);
if(str2int($is_me)>0)$str_fromurl="";
$str_fromurl=str_left($str_fromurl,500);
$str_screen=str_putdata($_POST['s']);
$str_screen=str_left($str_screen,18);
$str_browser=str_putdata($_POST['b']);
$str_browser=str_left($str_browser,30);
$str_os=str_putdata($_POST['o']);
$str_os=str_left($str_os,30);
$str_language=str_putdata($_POST['l']);
$str_language=str_left($str_language,20);
$str_OnlineId=str_id("0000000001");
if(!isnull($_COOKIE['OnlineUser']))
{
	$str_UserName=$_COOKIE['OnlineUser'];
}else{
	$expire=time()+3600*24*365;
	$str_UserName=$str_OnlineId;
	setcookie("OnlineUser",$str_UserName,$expire,"/");
}
$dtime=date("Y-m-d H:i:s");
$PostTime=smarty_make_timestamp($dtime);
$dday=date("Y-m-d");
$PostDay=smarty_make_timestamp($dday);
$Postip=get_client_ip();
$ExpTime=dateadd("n",-20,$dtime);
$ExpireTime=smarty_make_timestamp($ExpTime);
query("delete from `statistic_online_tbl` where `UpdateTime`<=$ExpireTime");
$eipnum=ip2float($Postip);
$str_ProvinceId=0;$str_CityId=0;$str_DistrictId=0;
$result=query("select `ProvinceId`,`CityId`,`DistrictId` from `ipaddress_tbl` where `IpStartFloat`<='$eipnum' and `IpEndFloat`>='$eipnum' order by `IpEndFloat` limit 1","utf8");
if(num_rows($result))
{
	$row=fetch_array($result);
	$str_ProvinceId=$row[0];
	$str_CityId=$row[1];
	$str_DistrictId=$row[2];
}
$hasUser=false;
$result=query("select `OnlineId` from `statistic_online_tbl` where `UserName`='$str_UserName'","utf8");
if(num_rows($result))$hasUser=true;
if($hasUser)
{
	query("update `statistic_online_tbl` set `UpdateTime`='$PostTime',`Page`='$str_url' where `UserName`='$str_UserName'","utf8");
}else{
	query("insert into `statistic_online_tbl`(`OnlineId`,`UserName`,`AddTime`,`UpdateTime`,`Ip`,`Page`,`From`) values
		('$str_OnlineId','$str_UserName','$PostTime','$PostTime','$Postip','$str_url','$str_fromurl')","utf8");
	$NewId=insert_id();
	query("insert into `statistic_history_tbl`(`AddTime`,`Ip`,`From`,`Browser`,`System`,`Screen`,`Language`,`ProvinceId`,`CityId`,`DistrictId`) values
		('$PostTime','$Postip','$str_fromurl','$str_browser','$str_os','$str_screen','$str_language','$str_ProvinceId','$str_CityId','$str_DistrictId')","utf8");
}
$hasPV=false;
$result=query("select `Id` from `statistic_pageview_tbl` where (UserName='$str_UserName' and `Page`='$str_url' and AddDay='$PostDay')","utf8");
if(num_rows($result))$hasPV=true;
if($hasPV)
{
	query("update `statistic_pageview_tbl` set `Total`=`Total`+1 where (UserName='$str_UserName' and `Page`='$str_url' and AddDay='$PostDay')","utf8");
}else{
	query("insert into `statistic_pageview_tbl`(`UserName`,`Page`,`Total`,`AddDay`) values('$str_UserName','$str_url',1,'$PostDay')","utf8");
}
$hasID=false;
$result=query("select `Id` from `statistic_id_tbl` where (AddDay='$PostDay' and `Ip`='$Postip' and System='$str_os' and Screen='$str_screen' and Language='$str_language' and ProvinceId='$str_ProvinceId' and CityId='$str_CityId' and DistrictId='$str_DistrictId')","utf8");
if(num_rows($result))$hasID=true;
if(!$hasID)
{
	query("insert into `statistic_id_tbl`(`AddDay`,`Ip`,`System`,`Screen`,`Language`,`ProvinceId`,`CityId`,`DistrictId`) values('$PostDay','$Postip','$str_os','$str_screen','$str_language','$str_ProvinceId','$str_CityId','$str_DistrictId')","utf8");
}
if(!isnull($str_fromurl))
{
	$furl=substr($str_fromurl,7);
	$arrurl=explode("/",$furl);	
	$EngineUrl=$arrurl[0];
	$IsEngine=false;
	$result=query("select `EngineId`,`EngineKey` from `statistic_engine_tbl` where `EngineUrl` like '%$EngineUrl%' limit 1","utf8");
	if(num_rows($result))
	{
		$row=fetch_array($result);
		$EngineId=$row[0];
		$EngineKey=$row[1];
		$IsEngine=true;
	}
	if($IsEngine)
	{
		//$arrayEngineKey=explode("|",$EngineKey);	
		$Words='';
		preg_match($EngineKey,$str_fromurl,$tmp); 
		$arrKey=explode('&',$tmp[0]);
		$Words=$arrKey[0];
		$Words=str_replace('wd=','',$Words);
		$Words=str_replace('word=','',$Words);
		$Words=str_replace('query=','',$Words);
		$Words=str_replace('q=','',$Words);
		/*
		foreach($arrayEngineKey as $val)
		{
			preg_match("|baidu.+wo?r?d=([^\\&]*)|is", $referer, $tmp ); 
			$keyword = urldecode( $tmp[1] ); 
			
			$Words=tag_data($str_fromurl,$val,'&');
			if(!isnull($Words))
			{
				break;
			}else{
				
				if(str_left(tag_data($str_fromurl,$val,''),1)!='&')
				{
					$Words=tag_data($str_fromurl,$val,'');
					if(!isnull($Words))break;
				}
			}
		}*/
		if(!isnull($Words))
		{
			$hasWords=false;
			$result=query("select `Id` from `statistic_keywords_tbl` where (EngineId='$EngineId' and `Words`='$Words' and AddDay='$PostDay')","utf8");
			if(num_rows($result))$hasWords=true;
			if($hasWords)
			{
				query("update `statistic_keywords_tbl` set `Total`=`Total`+1 where (EngineId='$EngineId' and `Words`='$Words' and AddDay='$PostDay')","utf8");
			}else{
				query("insert into `statistic_keywords_tbl`(`EngineId`,`Words`,`Total`,`AddDay`) values('$EngineId','$Words',1,'$PostDay')","utf8");
			}
		}
	}
}
function str_id($str)
{
	$result=query("select `OnlineId` from `statistic_online_tbl` where `OnlineId`='$str'","utf8");
	if(num_rows($result))
	{
		$rl=query("select `OnlineId` from `statistic_online_tbl` order by `OnlineId` desc limit 1","utf8");
		if(num_rows($rl)){
			$r=fetch_array($rl);
			$v=$r[0];
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
		$strCode=str_id($rcode);
	}else{
		$strCode=$str;
	}
	return $strCode;
}
?>