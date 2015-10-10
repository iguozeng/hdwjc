<?php
require_once 'include/init.php';
require_once 'global.class.php';
if(str2int(CacheEnable)==1){
	if($cacheact!='rewrite')$cache->load();
}
$global=new global_event();
$sortid=htmlspecialchars($sortid);
$ArcitleSortId=str2int($sortid);
$FisrtId=get_main_arcitle_classid($ArcitleSortId);
$PicArcitleCount=0;
if($ArcitleSortId==$FisrtId)
{
	$strSQL="select ArcitleSortId,ArcitleSortName,'' as BeSortId,'' as ArcitleMainSortName,(select count(ArcitleId) from arcitle_tbl where MainSortId='$FisrtId' and IsBest=1 and (RootPic<>'' and RootPic is not null)) as PicArcitleCount from arcitle_sort_tbl where ArcitleSortId='$FisrtId'";
}else{
	$strSQL="select ArcitleSortId,ArcitleSortName,BeSortId,(select ArcitleSortName from arcitle_sort_tbl where ArcitleSortId='$FisrtId' limit 1) as ArcitleMainSortName,(select count(ArcitleId) from arcitle_tbl where ArcitleSortId='$ArcitleSortId' and IsBest=1 and (RootPic<>'' and RootPic is not null)) as PicArcitleCount from arcitle_sort_tbl where ArcitleSortId='$ArcitleSortId'";
}
$result=query($strSQL);
if(num_rows($result))
{
	$row=fetch_array($result);
	$PicArcitleCount=str2int($row["PicArcitleCount"]);
	$ArcitleMainSortId=str2int($row["BeSortId"]);
	$ArcitleMainSortName=$row["ArcitleMainSortName"];
	if($ArcitleMainSortId>0)$array_local[$ArcitleMainSortName]="/news_list.php?sortid=$ArcitleMainSortId";
	$ArcitleSortId=$row["ArcitleSortId"];
	$ArcitleSortName=$row["ArcitleSortName"];
	$array_local[$ArcitleSortName]="/news_list.php?sortid=$ArcitleSortId";
}else{
	header("Location:news_list.php?sortid=1");
}
if(!isnull($ArcitleSortName))
{
	$page_title=$ArcitleSortName.' - ';	
}else{
	$page_title=$ArcitleMainSortName.' - ';	
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title><?php echo $page_title.SiteName;?></title>
<link href="css/global.css" rel="stylesheet">
<link href="css/info.css" rel="stylesheet">
<script language="javascript">var idPage="news";var sortid=<?php echo $sortid;?>;</script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery.m.ui.js"></script>
</head>
<body>
<div class="info_nav">
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji">
				<div>
					<h3>新闻资讯</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">新闻动态</a></li>
			<li><a href="">行业资讯</a></li>
			<li><a href="">活动公告</a></li>
		</ul>
	</div>
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji">
				<div>
					<h3>系统架构</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">新闻动态</a></li>
			<li><a href="">行业资讯</a></li>
			<li><a href="">活动公告</a></li>
		</ul>
	</div>
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji">
				<div>
					<h3>五金常识</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">新闻动态</a></li>
			<li><a href="">行业资讯</a></li>
			<li><a href="">活动公告</a></li>
		</ul>
	</div>
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji" style="border-right:none;">
				<div>
					<h3>公信案例</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">新闻动态</a></li>
			<li><a href="">行业资讯</a></li>
			<li><a href="">活动公告</a></li>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<div class="info_list">
	<ul>
    	<!--
		<li>
			<div class="info_pic fl"><a href=""><img src="images/[Temp]20150804154656_32462.jpg" /></a></div>
			<div class="info_txt fl info_txt1">
				<a href="">董事长周才炳 参加"一带一路"建设董事长周才炳 参加"一带一路"建设</a>
				<span class="info_detail">
					<span class="pubdate">2015-07-21</span><span class="info_intro">7月15日至16日，江苏民营企业参与"一带一路"建设推进会在连云港市召开，来自全省各地的近二百名企业家齐聚连云港市，聚焦"一带一路"交汇点建设，共话交流合作，探寻发7月15日至16日，江苏民营企业参与"一带一路"建设推进会在连云港市召开，来自全省各地的近二百名企业家齐聚连云港市，聚焦"一带一路"交汇点建设，共话交流合作，探寻发</span>
				</span>
			</div>
			<div class="info_right fl"><a href=""><img src="images/info_list_03.png" /></a></div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="info_txt fl info_txt2">
				<a href="">董事长周才炳 参加"一带一路"建设董事长周才炳 参加"一带一路"建设</a>
				<span class="info_detail">
					<span class="pubdate">2015-07-21</span><span class="info_intro">7月15日至16日，江苏民营企业参与"一带一路"建设推进会在连云港市召开，来自全省各地的近二百名企业家齐聚连云港市，聚焦"一带一路"交汇点建设，共话交流合作，探寻发7月15日至16日，江苏民营企业参与"一带一路"建设推进会在连云港市召开，来自全省各地的近二百名企业家齐聚连云港市，聚焦"一带一路"交汇点建设，共话交流合作，探寻发</span>
				</span>
			</div>
			<div class="info_right fl"><a href=""><img src="images/info_list_03.png" /></a></div>
			<div class="clear"></div>
		</li>
        -->
	</ul>
    <div class="more">正在加载更多内容...</div>
</div>

</body>
</html>
<?php if(str2int(CacheEnable)==1)$cache->write();?>