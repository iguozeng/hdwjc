<?php
$page_name='新闻资讯详情';
require_once 'include/init.php';
require_once 'global.class.php';
if(str2int(CacheEnable)==1){
	if($cacheact!='rewrite')$cache->load();
}
$global=new global_event();
$ArcitleId=str2int($id);
$result =query("select * from arcitle_tbl where ArcitleId='$ArcitleId'");
if(num_rows($result)){
	$row =fetch_array($result);
	$ArcitleSortId=$row["ArcitleSortId"];
	$MainSortId=$row["MainSortId"];
	$ManageId=$row["ManageId"];
	$Title=$row["Title"];
	$OtherUrl=$row["OtherUrl"];
	$IsBest=$row["IsBest"];
	$RootPic=$row["RootPic"];
	$FromStr=$row["FromStr"];
	$LikeStr=$row["LikeStr"];
	$OrderNumber=$row["OrderNumber"];
	$Content=str_dehtml($row["Content"]);
	$DateTime=$row["DateTime"];
	if(!isnull($FromStr))$strFromStr='资讯来源：'.$FromStr.' ';
	if($DateTime>0)$strDateTime=format_dt($DateTime,'%Y-%m-%d %H:%M:%S');
	query("update arcitle_tbl set Click=Click+1 where ArcitleId='$ArcitleId'");
}else{
	header("Location:/m.php");
}
if(strlen($Title)>88)
{
	$TitleFontSize='18px';	
}else{
	$TitleFontSize='20px';	
}
$ArcitleSortId=str2int($ArcitleSortId);
$FisrtId=get_main_arcitle_classid($ArcitleSortId);
$result=query("select ArcitleSortId,ArcitleSortName,BeSortId,(select ArcitleSortName from arcitle_sort_tbl where ArcitleSortId='$FisrtId') as ArcitleMainSortName from arcitle_sort_tbl where ArcitleSortId='$ArcitleSortId'");
if(num_rows($result))
{
	$row=fetch_array($result);
	$ArcitleMainSortId=str2int($row[2]);
	$ArcitleMainSortName=$row[3];
	if($ArcitleMainSortId>0)$array_local[$ArcitleMainSortName]="/news_list.php?sortid=$ArcitleMainSortId";
	$ArcitleSortId=$row[0];
	$ArcitleSortName=$row[1];
	$array_local[$ArcitleSortName]="/news_list.php?sortid=$ArcitleSortId";
}else{
	msg($GLOBALS['MsgTitle'][0]."参数错误！");
}
if(!isnull($ArcitleMainSortName))
{
	$page_title=$ArcitleSortName.' - '.$ArcitleMainSortName.' - ';	
}else{
	$page_title=$ArcitleSortName.' - ';	
}
$page_title=$Title.' - '.$page_title;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title><?php echo $Title;?></title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery.m.ui.js" type="text/javascript"></script>
</head>
<body>
<div class="warmp">
<?php require_once 'p.header.php';?>
<div class="news_detail">
	<div class="news_title">
    	<img class="bg" src="images/news_title_01.jpg">
        <h1><?php echo $Title;?></h1>
    </div>
    <div class="news_time">
    	<img class="bg" src="images/news_title_02.jpg">
        <span><?php echo $strDateTime;?> <a href="http://wap.hdwjc.com/">华东五金网</a></span>
    </div>
    <div class="news_column">    	
		<?php echo $Content;?>
    </div>
</div>
<div class="weixin_qrcode">
	<img src="images/weixin_qrcode.png">
    <span>更多精彩扫描华东五金网微信公共号查看！</span>
</div>
<div class="news_links">
	<div class="news_links_title">
    	<img src="images/news_links_title.jpg" class="bg">
        <span>相关的资讯</span>
    </div>
    <div class="news_links_column">
    	<ul>
        <?php
		$strWhenSQL='';
		if(!isnull($LikeStr))
		{
			$arrayStr=explode(',',$LikeStr);
			foreach($arrayStr as $strLike)
			{
				$strWhenSQL.="Title like '%$strLike%' or Content like '%$strLike%' or ";	
			}
			if(!isnull($strWhenSQL))
			{
				$strWhenSQL=str_left($strWhenSQL,strlen($strWhenSQL)-3);
				$result=query("select count(*) from arcitle_tbl where $strWhenSQL");
				if(!num_rows($result))$strWhenSQL='';
			}
		}
		if(!isnull($strWhenSQL))
		{
			$strWhenSQL="ArcitleId<>'$ArcitleId' and ($strWhenSQL)";
		}else{
			$strWhenSQL="ArcitleSortId='$ArcitleSortId' and ArcitleId<'$ArcitleId'";
		}
		echo get_news_like_list($strWhenSQL,"ArcitleId desc",0,5);
		?>
        </ul>
    </div>
</div>
<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>
<?php if(str2int(CacheEnable)==1)$cache->write();
function get_news_like_list($when,$orderby='ArcitleId desc',$sartnum=0,$num=10){
	$str='';
	if(!isnull($when))$strwhen=' where '.$when;
	$result=query("select ArcitleId,Title from arcitle_tbl $strwhen order by $orderby limit $sartnum,$num");
	$total=num_rows($result);
	if($total<1)$result=query("select ArcitleId,Title from arcitle_tbl order by ArcitleId desc limit $sartnum,$num");
	while($rows=fetch_array($result))
	{
		$str.='<li><a href="/news_detail.php?id='.$rows[0].'" title="'.$rows["Title"].'">'.$rows["Title"].'</a></li>';
	}
	return $str;
}
?>