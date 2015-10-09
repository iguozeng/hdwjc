<?php
require_once 'include/init.php';
require_once 'global.class.php';
$global=new global_event();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>华东五金网</title>
<link href="css/global.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<script language="javascript">var idPage="index";</script>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/TouchSlide.1.1.js"></script>

</head>
<body>
<!--头部、焦点图及导航-->
		<div class="header">
			
		</div>
		<div class="wrapper">
			<img class="bg" src="images/index_01.jpg" />
			<div class="txt_wrapper slogan">
				<span class="txtS">五金机电建材供应基地&nbsp;38630家企业10年专注采购</span>
			</div>
		</div>
		<div id="focus" class="focus">
			<div class="bd">
				<ul>
					<li><img src="images/banner_01.jpg" /></li>
					<li><img src="images/banner_01.jpg" /></li>
					<li><img src="images/banner_01.jpg" /></li>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			TouchSlide({ 
				slideCell:"#focus",
				mainCell:".bd ul", 
				effect:"leftLoop", 
				autoPlay:true,
			});
		</script>
		<div class="cate_nav_01">
			<ul>
				<li><a href="list.php?sortid=5"><img src="images/cate_icon_01.png" /><span>发电机</span></a></li>
				<li><a href="list.php?sortid=6"><img src="images/cate_icon_02.png" /><span>空压机</span></a></li>
				<li><a href="list.php?sortid=42"><img src="images/cate_icon_03.png" /><span>电动机</span></a></li>
				<li><a href="list.php?sortid=8"><img src="images/cate_icon_04.png" /><span>电焊机</span></a></li>
				<li><a href="list.php?sortid=33"><img src="images/cate_icon_05.png" /><span>节能灯</span></a></li>
				<li><a href="list.php?sortid=38"><img src="images/cate_icon_06.png" /><span>开关</span></a></li>
				<li><a href="list.php?sortid=36"><img src="images/cate_icon_07.png" /><span>电线电缆</span></a></li>
				<li><a href="list.php?sortid=4"><img src="images/cate_icon_08.png" /><span>法兰</span></a></li>
				<li><a href="list.php?sortid=11"><img src="images/cate_icon_09.png" /><span>钢丝绳</span></a></li>
				<li><a href="list.php?sortid=44"><img src="images/cate_icon_10.png" /><span>吊带</span></a></li>
				<div class="clear"></div>
			</ul>
		</div>
<!--头部、焦点图及导航end-->
<!--特惠商品-->
		<div class="wrapper">
			<img class="bg" src="images/index_title_bg.jpg" />
			<div class="txt_wrapper index_title">
				<b class="txtS colorFFF">特惠商品</b><span class="txtXXS txt_inline colorB9B4B5">&nbsp;HOT</span><a class="txtXS colorFFF fr" href="">+更多特惠&gt;&gt;</a>
			</div>
		</div>
		<div class="tehui">
			<ul>
            <?php echo $global->event_get_product(2,0,0,6,2); ?>
            <!--
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150622104444_40075.jpg" />
						<span class="tehui_name">A型活扳手/活动扳手开口扳手</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">￥13.50</span>
						<a class="tehui_btn txtXS" href="">立即购买</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150625164316_29905.gif" />
						<span class="tehui_name">A型活扳手/活动扳手开口扳手</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">￥13.50</span>
						<a class="tehui_btn txtXS" href="">立即购买</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150918114348_64494.png" />
						<span class="tehui_name">A型活扳手/活动扳手开口扳手</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">￥13.50</span>
						<a class="tehui_btn txtXS" href="">立即购买</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150622104444_40075.jpg" />
						<span class="tehui_name">A型活扳手/活动扳手开口扳手</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">￥13.50</span>
						<a class="tehui_btn txtXS" href="">立即购买</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150625164316_29905.gif" />
						<span class="tehui_name">A型活扳手/活动扳手开口扳手</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">￥13.50</span>
						<a class="tehui_btn txtXS" href="">立即购买</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150918114348_64494.png" />
						<span class="tehui_name">A型活扳手/活动扳手开口扳手</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">￥13.50</span>
						<a class="tehui_btn txtXS" href="">立即购买</a>
					</div>
				</li>
                -->
				<div class="clear"></div>
			</ul>
		</div>
		<script type="text/javascript">
			var height = $(".tehui_pic").width();
			$(".tehui_pic").css("height",height);
		</script>
		<div class="cate_nav_02">
			<ul>
				<li><a href="list.php?sortid=40"><span>插座</span><img src="images/cate_icon_11.png" /></a></li>
				<li><a href="list.php?sortid=30"><span>日光灯</span><img src="images/cate_icon_12.png" /></a></li>
				<li><a href="list.php?sortid=18"><span>螺丝</span><img src="images/cate_icon_13.png" /></a></li>
				<li><a href="list.php?sortid=39"><span>门锁</span><img src="images/cate_icon_14.png" /></a></li>
				<li class="last"><a href="list.php?sortid=20"><span>活动扳手</span><img src="images/cate_icon_15.png" /></a></li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="wrapper ads_01_wrapper">
			<a href="tel:4001808860"><img class="bg" src="images/ads_01.jpg" /></a>
			<div class="txt_wrapper ads_01">
				<b class="txtXS">五金机电建材供应基地</b>
				<b class="txtXS">38630家企业10年专注采购</b>
			</div>
		</div>
<!--特惠商品end-->
<!--推荐商品-->
		<div class="wrapper">
			<img class="bg" src="images/index_title_bg.jpg" />
			<div class="txt_wrapper index_title">
				<b class="txtS colorFFF">推荐商品</b><span class="txtXXS txt_inline colorB9B4B5">&nbsp;HOT</span><a class="txtXS colorFFF fr" href="">+更多推荐&gt;&gt;</a>
			</div>
		</div>
		<div class="tuijian">
			<ul>
            	<?php echo $global->event_get_product(1,0,0,6,1); ?>
            	<!--
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A型活扳手/活动扳手开口扳手A型活扳手/活动扳手开口扳手</a></div>
					<div class="tuijian_price"><label>￥13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A型活扳手/活动扳手开口扳手A型活扳手/活动扳手开口扳手</a></div>
					<div class="tuijian_price"><label>￥13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150625164316_29905.gif" /></div>
					<div class="tuijian_name"><a href="">A型活扳手/活动扳手开口扳手A型活扳手/活动扳手开口扳手</a></div>
					<div class="tuijian_price"><label>￥13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150918114348_64494.png" /></div>
					<div class="tuijian_name"><a href="">A型活扳手/活动扳手开口扳手A型活扳手/活动扳手开口扳手</a></div>
					<div class="tuijian_price"><label>￥13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A型活扳手/活动扳手开口扳手A型活扳手/活动扳手开口扳手</a></div>
					<div class="tuijian_price"><label>￥13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A型活扳手/活动扳手开口扳手A型活扳手/活动扳手开口扳手</a></div>
					<div class="tuijian_price"><label>￥13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
                -->
				<div class="clear"></div>
			</ul>
		</div>
		<div class="cate_nav_02">
			<ul>
				<li><a href="list.php?sortid=38"><span>开关</span><img src="images/cate_icon_16.png" /></a></li>
				<li><a href="list.php?sortid=19"><span>销</span><img src="images/cate_icon_17.png" /></a></li>
				<li><a href="list.php?sortid=37"><span>电器</span><img src="images/cate_icon_18.png" /></a></li>
				<li><a href="list.php?sortid=21"><span>打包机</span><img src="images/cate_icon_19.png" /></a></li>
				<li class="last"><a href="list.php?sortid=22"><span>黄油枪</span><img src="images/cate_icon_20.png" /></a></li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="wrapper ads_02_wrapper">
			<a href="tel:4001808860"><img class="bg" src="images/ads_02.jpg" /></a>
			<div class="txt_wrapper ads_02">
				<span class="txtXS colorFFF">咨询热线：<b>400-180-8860</b></span>
			</div>
		</div>
<!--推荐商品end-->
<!--六大优势-->
		<div class="six_advantages">
			<strong><em>六</em>大优势</strong>
			<span>华东五金网是您购买五金机电建材的最佳选择</span>
		</div>
		<div class="advantages">
			<ul>
				<li>
					<img class="fl" src="images/index_advantage_01.png" />
					<span class="advantages_right fr">
						<span class="advantages_title">产品质量有保障</span>
						<span class="advantages_content">依托10万平米自持经营面积、2万平方米现货库存，拥有20多万个规格品种和1000多个知名品牌，网上所售商品都有质量保障，标准化产品网上直接供应；运营10年已经有38630多家企业固定在此采购，质量无忧。</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fr" src="images/index_advantage_02.png" />
					<span class="advantages_right fl">
						<span class="advantages_title txt_r">产品价格有保障</span>
						<span class="advantages_content">商品大都来自集中采购，与生产厂家签订了长期战略合作协议，以质优价廉、冲量返利为长远目标，让利给采购商。</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fl" src="images/index_advantage_03.png" />
					<span class="advantages_right fr">
						<span class="advantages_title">货源充足有保障</span>
						<span class="advantages_content">华东五金网有稳定的供货渠道，有1千多家供应商和生产企业长期提供25万多个规格品种确保不会缺货、断货。</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fr" src="images/index_advantage_04.png" />
					<span class="advantages_right fl">
						<span class="advantages_title txt_r">发货及时有保障</span>
						<span class="advantages_content">拥有现代化的仓储和快捷的物流配送体系，货运直达全国70%以上的地、县级市，专业跟单，一对一服务，配送确保及时。</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fl" src="images/index_advantage_05.png" />
					<span class="advantages_right fr">
						<span class="advantages_title">售后服务有保障</span>
						<span class="advantages_content">所售商品都有完善的售后服务体系，确保退货及时、换货及时、维修及时，让采购商无后顾之忧。</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fr" src="images/index_advantage_06.png" />
					<span class="advantages_right fl">
						<span class="advantages_title txt_r">网站信誉有保障</span>
						<span class="advantages_content">华东五金网是江苏专业五金机电建材供应基地，立足江苏、上海、浙江、山东、安徽，辐射全国。连续多年被评为省级正版正货荣誉称号，每一笔交易都有诚信保障。</span>
					</span>
					<div class="clear"></div>
				</li>
			</ul>
		</div>
<!--六大优势end-->
<!--资质荣誉、新闻资讯-->
		<div class="wrapper">
			<img class="bg" src="images/index_title_bg.jpg" />
			<div class="txt_wrapper index_title">
				<b class="txtS colorFFF">资质荣誉</b><a class="txtXS colorFFF fr" href="">+更多&gt;&gt;</a>
			</div>
		</div>
		<div class="honor">
			<ul>
            <?php
			$result=query("select Title,RootPic from arcitle_tbl where ArcitleSortId=23 order by OrderNumber,ArcitleId desc limit 2");
			if(num_rows($result))
			{
			while($honor_row=fetch_array($result)){
				echo '<li><img src="'.get_img($honor_row["RootPic"]).'" /><a href="">'.$honor_row["Title"].'</a></li>';
			}
			}
			?>
            	<!--
				<li><img src="images/[Temp]honor.jpg" /><a href="">十大五金材料交易市场第一名</a></li>
				<li><img src="images/[Temp]honor.jpg" /><a href="">十大五金材料交易市场第一名</a></li>
                -->
			</ul>
		</div>
		<div id="news" class="news">
			<div class="hd txt_wrapper">
				<ul>
                <?php
					$arrayArcitleSorts=array();
					$result=query("select ArcitleSortId,ArcitleSortName from arcitle_sort_tbl where BeSortId=1 order by OrderNumber,ArcitleSortId limit 3");
					if(num_rows($result))
					{
						while($row=fetch_array($result))
						{
							$id=$row[0];
							$str=str_ireplace(array("\r\n", "\r", "\n"),"",$row[1]);
							$arrayArcitleSorts[$id]=$str;
							//echo'<span data-chk="0">'.$str.'</span>';
							echo'<li><span data-chk="0" class="txtS">'.$str.'</span></li>';
						}
					}
				?>
                <!--
					<li><span class="txtS">新闻动态</span></li>
					<li><span class="txtS">行业资讯</span></li>
					<li><span class="txtS">活动公告</span></li>
                -->
					<div class="clear"></div>
				</ul>
			</div>
			<div class="bd">
            	<?php foreach($arrayArcitleSorts as $key=>$val){echo '<div class="news_box">
					<div class="news_category txt_wrapper">
						'.$global->get_news_title($key).'
					</div>
					<ul>'.$global->get_news_list($key).'</ul></div>';}?>
            	<!--
				<div class="news_box">
					<div class="news_category txt_wrapper">
						<b class="txtS fl">新闻动态</b><a class="fr txtS" href="">+更多&gt;&gt;</a><div class="clear"></div>
					</div>
					<ul>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
					</ul>
				</div>
				<div class="news_box">
					<div class="news_category txt_wrapper">
						<b class="txtS fl">行业资讯</b><a class="fr txtS" href="">+更多&gt;&gt;</a><div class="clear"></div>
					</div>
					<ul>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
					</ul>
				</div>
				<div class="news_box">
					<div class="news_category txt_wrapper">
						<b class="txtS fl">活动公告</b><a class="fr txtS" href="">+更多&gt;&gt;</a><div class="clear"></div>
					</div>
					<ul>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">你的客户在网上，为何你不去网上你的客户在网上，为何你不去网上</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
					</ul>
				</div>
                -->
			</div>
		</div>
<div class="product_list" style="height:200px;"><dl><dt>商品展示</dt><dd><ul></ul></dd></dl></div>
		<script type="text/javascript">
			TouchSlide({ 
				slideCell:"#news",
				mainCell:".bd", 
				effect:"leftLoop", 
				autoPlay:false,
			});
		</script>
<!--资质荣誉、新闻资讯end-->
<!--询价单-->
		<div class="xunjia"></div>
<!--询价单end-->
	</body>
</html>