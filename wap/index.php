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
<title>���������</title>
<link href="css/global.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<script language="javascript">var idPage="index";</script>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/TouchSlide.1.1.js"></script>

</head>
<body>
<!--ͷ��������ͼ������-->
		<div class="header">
			
		</div>
		<div class="wrapper">
			<img class="bg" src="images/index_01.jpg" />
			<div class="txt_wrapper slogan">
				<span class="txtS">�����罨�Ĺ�Ӧ����&nbsp;38630����ҵ10��רע�ɹ�</span>
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
				<li><a href="list.php?sortid=5"><img src="images/cate_icon_01.png" /><span>�����</span></a></li>
				<li><a href="list.php?sortid=6"><img src="images/cate_icon_02.png" /><span>��ѹ��</span></a></li>
				<li><a href="list.php?sortid=42"><img src="images/cate_icon_03.png" /><span>�綯��</span></a></li>
				<li><a href="list.php?sortid=8"><img src="images/cate_icon_04.png" /><span>�纸��</span></a></li>
				<li><a href="list.php?sortid=33"><img src="images/cate_icon_05.png" /><span>���ܵ�</span></a></li>
				<li><a href="list.php?sortid=38"><img src="images/cate_icon_06.png" /><span>����</span></a></li>
				<li><a href="list.php?sortid=36"><img src="images/cate_icon_07.png" /><span>���ߵ���</span></a></li>
				<li><a href="list.php?sortid=4"><img src="images/cate_icon_08.png" /><span>����</span></a></li>
				<li><a href="list.php?sortid=11"><img src="images/cate_icon_09.png" /><span>��˿��</span></a></li>
				<li><a href="list.php?sortid=44"><img src="images/cate_icon_10.png" /><span>����</span></a></li>
				<div class="clear"></div>
			</ul>
		</div>
<!--ͷ��������ͼ������end-->
<!--�ػ���Ʒ-->
		<div class="wrapper">
			<img class="bg" src="images/index_title_bg.jpg" />
			<div class="txt_wrapper index_title">
				<b class="txtS colorFFF">�ػ���Ʒ</b><span class="txtXXS txt_inline colorB9B4B5">&nbsp;HOT</span><a class="txtXS colorFFF fr" href="">+�����ػ�&gt;&gt;</a>
			</div>
		</div>
		<div class="tehui">
			<ul>
            <?php echo $global->event_get_product(2,0,0,6,2); ?>
            <!--
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150622104444_40075.jpg" />
						<span class="tehui_name">A�ͻ����/����ֿ��ڰ���</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">��13.50</span>
						<a class="tehui_btn txtXS" href="">��������</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150625164316_29905.gif" />
						<span class="tehui_name">A�ͻ����/����ֿ��ڰ���</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">��13.50</span>
						<a class="tehui_btn txtXS" href="">��������</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150918114348_64494.png" />
						<span class="tehui_name">A�ͻ����/����ֿ��ڰ���</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">��13.50</span>
						<a class="tehui_btn txtXS" href="">��������</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150622104444_40075.jpg" />
						<span class="tehui_name">A�ͻ����/����ֿ��ڰ���</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">��13.50</span>
						<a class="tehui_btn txtXS" href="">��������</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150625164316_29905.gif" />
						<span class="tehui_name">A�ͻ����/����ֿ��ڰ���</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">��13.50</span>
						<a class="tehui_btn txtXS" href="">��������</a>
					</div>
				</li>
				<li class="fl">
					<a href="" class="tehui_goods">
						<img class="tehui_pic" src="images/[Temp]20150918114348_64494.png" />
						<span class="tehui_name">A�ͻ����/����ֿ��ڰ���</span>
					</a>
					<div class="tehui_purchase wrapper txt_wrapper">
						<img class="bg" src="images/index_price_bg.png" />
						<span class="tehui_price txtXS">��13.50</span>
						<a class="tehui_btn txtXS" href="">��������</a>
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
				<li><a href="list.php?sortid=40"><span>����</span><img src="images/cate_icon_11.png" /></a></li>
				<li><a href="list.php?sortid=30"><span>�չ��</span><img src="images/cate_icon_12.png" /></a></li>
				<li><a href="list.php?sortid=18"><span>��˿</span><img src="images/cate_icon_13.png" /></a></li>
				<li><a href="list.php?sortid=39"><span>����</span><img src="images/cate_icon_14.png" /></a></li>
				<li class="last"><a href="list.php?sortid=20"><span>�����</span><img src="images/cate_icon_15.png" /></a></li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="wrapper ads_01_wrapper">
			<a href="tel:4001808860"><img class="bg" src="images/ads_01.jpg" /></a>
			<div class="txt_wrapper ads_01">
				<b class="txtXS">�����罨�Ĺ�Ӧ����</b>
				<b class="txtXS">38630����ҵ10��רע�ɹ�</b>
			</div>
		</div>
<!--�ػ���Ʒend-->
<!--�Ƽ���Ʒ-->
		<div class="wrapper">
			<img class="bg" src="images/index_title_bg.jpg" />
			<div class="txt_wrapper index_title">
				<b class="txtS colorFFF">�Ƽ���Ʒ</b><span class="txtXXS txt_inline colorB9B4B5">&nbsp;HOT</span><a class="txtXS colorFFF fr" href="">+�����Ƽ�&gt;&gt;</a>
			</div>
		</div>
		<div class="tuijian">
			<ul>
            	<?php echo $global->event_get_product(1,0,0,6,1); ?>
            	<!--
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A�ͻ����/����ֿ��ڰ���A�ͻ����/����ֿ��ڰ���</a></div>
					<div class="tuijian_price"><label>��13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A�ͻ����/����ֿ��ڰ���A�ͻ����/����ֿ��ڰ���</a></div>
					<div class="tuijian_price"><label>��13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150625164316_29905.gif" /></div>
					<div class="tuijian_name"><a href="">A�ͻ����/����ֿ��ڰ���A�ͻ����/����ֿ��ڰ���</a></div>
					<div class="tuijian_price"><label>��13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150918114348_64494.png" /></div>
					<div class="tuijian_name"><a href="">A�ͻ����/����ֿ��ڰ���A�ͻ����/����ֿ��ڰ���</a></div>
					<div class="tuijian_price"><label>��13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A�ͻ����/����ֿ��ڰ���A�ͻ����/����ֿ��ڰ���</a></div>
					<div class="tuijian_price"><label>��13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
				<li class="fl wrapper">
					<img class="bg" src="images/tuijian_bg.jpg" />
					<div class="tuijian_pic"><img src="images/[Temp]20150622104444_40075.jpg" /></div>
					<div class="tuijian_name"><a href="">A�ͻ����/����ֿ��ڰ���A�ͻ����/����ֿ��ڰ���</a></div>
					<div class="tuijian_price"><label>��13.50</label></div>
					<div class="tuijian_btn"><a href=""><img src="images/tuijian_btn.png" /></a></div>
				</li>
                -->
				<div class="clear"></div>
			</ul>
		</div>
		<div class="cate_nav_02">
			<ul>
				<li><a href="list.php?sortid=38"><span>����</span><img src="images/cate_icon_16.png" /></a></li>
				<li><a href="list.php?sortid=19"><span>��</span><img src="images/cate_icon_17.png" /></a></li>
				<li><a href="list.php?sortid=37"><span>����</span><img src="images/cate_icon_18.png" /></a></li>
				<li><a href="list.php?sortid=21"><span>�����</span><img src="images/cate_icon_19.png" /></a></li>
				<li class="last"><a href="list.php?sortid=22"><span>����ǹ</span><img src="images/cate_icon_20.png" /></a></li>
				<div class="clear"></div>
			</ul>
		</div>
		<div class="wrapper ads_02_wrapper">
			<a href="tel:4001808860"><img class="bg" src="images/ads_02.jpg" /></a>
			<div class="txt_wrapper ads_02">
				<span class="txtXS colorFFF">��ѯ���ߣ�<b>400-180-8860</b></span>
			</div>
		</div>
<!--�Ƽ���Ʒend-->
<!--��������-->
		<div class="six_advantages">
			<strong><em>��</em>������</strong>
			<span>����������������������罨�ĵ����ѡ��</span>
		</div>
		<div class="advantages">
			<ul>
				<li>
					<img class="fl" src="images/index_advantage_01.png" />
					<span class="advantages_right fr">
						<span class="advantages_title">��Ʒ�����б���</span>
						<span class="advantages_content">����10��ƽ���Գ־�Ӫ�����2��ƽ�����ֻ���棬ӵ��20��������Ʒ�ֺ�1000���֪��Ʒ�ƣ�����������Ʒ�����������ϣ���׼����Ʒ����ֱ�ӹ�Ӧ����Ӫ10���Ѿ���38630�����ҵ�̶��ڴ˲ɹ����������ǡ�</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fr" src="images/index_advantage_02.png" />
					<span class="advantages_right fl">
						<span class="advantages_title txt_r">��Ʒ�۸��б���</span>
						<span class="advantages_content">��Ʒ�����Լ��вɹ�������������ǩ���˳���ս�Ժ���Э�飬�����ż�������������Ϊ��ԶĿ�꣬�������ɹ��̡�</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fl" src="images/index_advantage_03.png" />
					<span class="advantages_right fr">
						<span class="advantages_title">��Դ�����б���</span>
						<span class="advantages_content">������������ȶ��Ĺ�����������1ǧ��ҹ�Ӧ�̺�������ҵ�����ṩ25�������Ʒ��ȷ������ȱ�����ϻ���</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fr" src="images/index_advantage_04.png" />
					<span class="advantages_right fl">
						<span class="advantages_title txt_r">������ʱ�б���</span>
						<span class="advantages_content">ӵ���ִ����Ĳִ��Ϳ�ݵ�����������ϵ������ֱ��ȫ��70%���ϵĵء��ؼ��У�רҵ������һ��һ��������ȷ����ʱ��</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fl" src="images/index_advantage_05.png" />
					<span class="advantages_right fr">
						<span class="advantages_title">�ۺ�����б���</span>
						<span class="advantages_content">������Ʒ�������Ƶ��ۺ������ϵ��ȷ���˻���ʱ��������ʱ��ά�޼�ʱ���òɹ����޺��֮�ǡ�</span>
					</span>
					<div class="clear"></div>
				</li>
				<li>
					<img class="fr" src="images/index_advantage_06.png" />
					<span class="advantages_right fl">
						<span class="advantages_title txt_r">��վ�����б���</span>
						<span class="advantages_content">����������ǽ���רҵ�����罨�Ĺ�Ӧ���أ����㽭�ա��Ϻ����㽭��ɽ�������գ�����ȫ�����������걻��Ϊʡ���������������ƺţ�ÿһ�ʽ��׶��г��ű��ϡ�</span>
					</span>
					<div class="clear"></div>
				</li>
			</ul>
		</div>
<!--��������end-->
<!--����������������Ѷ-->
		<div class="wrapper">
			<img class="bg" src="images/index_title_bg.jpg" />
			<div class="txt_wrapper index_title">
				<b class="txtS colorFFF">��������</b><a class="txtXS colorFFF fr" href="">+����&gt;&gt;</a>
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
				<li><img src="images/[Temp]honor.jpg" /><a href="">ʮ�������Ͻ����г���һ��</a></li>
				<li><img src="images/[Temp]honor.jpg" /><a href="">ʮ�������Ͻ����г���һ��</a></li>
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
					<li><span class="txtS">���Ŷ�̬</span></li>
					<li><span class="txtS">��ҵ��Ѷ</span></li>
					<li><span class="txtS">�����</span></li>
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
						<b class="txtS fl">���Ŷ�̬</b><a class="fr txtS" href="">+����&gt;&gt;</a><div class="clear"></div>
					</div>
					<ul>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
					</ul>
				</div>
				<div class="news_box">
					<div class="news_category txt_wrapper">
						<b class="txtS fl">��ҵ��Ѷ</b><a class="fr txtS" href="">+����&gt;&gt;</a><div class="clear"></div>
					</div>
					<ul>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
					</ul>
				</div>
				<div class="news_box">
					<div class="news_category txt_wrapper">
						<b class="txtS fl">�����</b><a class="fr txtS" href="">+����&gt;&gt;</a><div class="clear"></div>
					</div>
					<ul>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
						<li><a class="fl" href="">��Ŀͻ������ϣ�Ϊ���㲻ȥ������Ŀͻ������ϣ�Ϊ���㲻ȥ����</a><span class="fr">2015-7-15</span><div class="clear"></div></li>
					</ul>
				</div>
                -->
			</div>
		</div>
<div class="product_list" style="height:200px;"><dl><dt>��Ʒչʾ</dt><dd><ul></ul></dd></dl></div>
		<script type="text/javascript">
			TouchSlide({ 
				slideCell:"#news",
				mainCell:".bd", 
				effect:"leftLoop", 
				autoPlay:false,
			});
		</script>
<!--����������������Ѷend-->
<!--ѯ�۵�-->
		<div class="xunjia"></div>
<!--ѯ�۵�end-->
	</body>
</html>