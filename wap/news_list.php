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
					<h3>������Ѷ</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">���Ŷ�̬</a></li>
			<li><a href="">��ҵ��Ѷ</a></li>
			<li><a href="">�����</a></li>
		</ul>
	</div>
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji">
				<div>
					<h3>ϵͳ�ܹ�</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">���Ŷ�̬</a></li>
			<li><a href="">��ҵ��Ѷ</a></li>
			<li><a href="">�����</a></li>
		</ul>
	</div>
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji">
				<div>
					<h3>���ʶ</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">���Ŷ�̬</a></li>
			<li><a href="">��ҵ��Ѷ</a></li>
			<li><a href="">�����</a></li>
		</ul>
	</div>
	<div class="yiji_wrap">
		<div class="yiji_box">
			<div class="yiji" style="border-right:none;">
				<div>
					<h3>���Ű���</h3><img class="closing" src="images/info_list_01.png"/><img class="opening" src="images/info_list_02.png"/>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="">���Ŷ�̬</a></li>
			<li><a href="">��ҵ��Ѷ</a></li>
			<li><a href="">�����</a></li>
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
				<a href="">���³��ܲű� �μ�"һ��һ·"���趭�³��ܲű� �μ�"һ��һ·"����</a>
				<span class="info_detail">
					<span class="pubdate">2015-07-21</span><span class="info_intro">7��15����16�գ�������Ӫ��ҵ����"һ��һ·"�����ƽ��������Ƹ����ٿ�������ȫʡ���صĽ���������ҵ��������Ƹ��У��۽�"һ��һ·"����㽨�裬��������������̽Ѱ��7��15����16�գ�������Ӫ��ҵ����"һ��һ·"�����ƽ��������Ƹ����ٿ�������ȫʡ���صĽ���������ҵ��������Ƹ��У��۽�"һ��һ·"����㽨�裬��������������̽Ѱ��</span>
				</span>
			</div>
			<div class="info_right fl"><a href=""><img src="images/info_list_03.png" /></a></div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="info_txt fl info_txt2">
				<a href="">���³��ܲű� �μ�"һ��һ·"���趭�³��ܲű� �μ�"һ��һ·"����</a>
				<span class="info_detail">
					<span class="pubdate">2015-07-21</span><span class="info_intro">7��15����16�գ�������Ӫ��ҵ����"һ��һ·"�����ƽ��������Ƹ����ٿ�������ȫʡ���صĽ���������ҵ��������Ƹ��У��۽�"һ��һ·"����㽨�裬��������������̽Ѱ��7��15����16�գ�������Ӫ��ҵ����"һ��һ·"�����ƽ��������Ƹ����ٿ�������ȫʡ���صĽ���������ҵ��������Ƹ��У��۽�"һ��һ·"����㽨�裬��������������̽Ѱ��</span>
				</span>
			</div>
			<div class="info_right fl"><a href=""><img src="images/info_list_03.png" /></a></div>
			<div class="clear"></div>
		</li>
        -->
	</ul>
    <div class="more">���ڼ��ظ�������...</div>
</div>

</body>
</html>
<?php if(str2int(CacheEnable)==1)$cache->write();?>