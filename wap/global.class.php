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
		$str.='>��Ʒ�б�</a><a href="m_certified.php"';
		if($GLOBALS['page_index']=='cert'){$str.=' class="selected"';}
		$str.='>ʵ������</a><a href="m_news_list.php?sortid=3"';
		if($GLOBALS['page_index']=='news_3'){$str.=' class="selected"';}
		$str.='>��������</a><a href="m_news_list.php?sortid=4"';
		if($GLOBALS['page_index']=='news_4'){$str.=' class="selected"';}
		$str.='>��ҵ��Ѷ</a></div>';
		return $str;
	}
	


	function get_hot_sort(){
		$str='<div class="search"><form action="m_product_query.php" method="get" name="searchform" autocomplete="off"><input type="text" class="keys" name="keywords" placeholder="��������Ʒ�ؼ���..."  value="'.$this->ProductKeywords.'"><span class="search_send"></span></form></div><div class="app_hot_sort">';
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
				$str.='<li><a href="/m_news_detail.php?id='.$rows[0].'" title="'.$rows["Title"].'"'.$strStyle.'>'.$rows["Title"].'</a><label>'.format_dt($rows['DateTime'],'%y-%m-%d').'</label></li>';
			}
		}else{
			$str.='<li><a>���������Ϣ</a></li>';	
		}
		return $str;
	}
	
	function get_header_menu(){
		$str='<div id="ui-header"><div class="fixed"><a class="ui-title" id="popmenu"><font>'.SiteName.'</font>'.Tel400.'</a><a class="ui-btn-left_pre" href="javascript:history.go(-1);"></a><a class="ui-btn-right" href="javascript:location.reload();"></a><a href="" class="ui-btn-right_menu"></a></div></div>
<div id="overlay"></div>
<div id="win"><ul class="dropdown"><li><a href="/m.php"><span>������ҳ</span></a></li><li><a href="/m_process.php"><span>��������</span></a></li><li><a href="/m_about_us.php"><span>��������</span></a></li><li><a href="tel:'.Tel400.'"><span>�绰��ѯ</span></a></li><div class="cf"></div></ul></div>';
		return $str;
	}

	function get_copyright(){
		$str='<div class="about"><ul><li><a href="m_about_us.php">��������</a></li><li><a href="m_about_us.php?id=873">ƽ̨����</a></li><li><a href="m_about_us.php?id=875">ý�屨��</a></li><li><a href="m_about_us.php?id=874">��ϵ����</a></li></ul></div><div class="copyright">&copy; 2015 ���ջ����������޹�˾<br />����ʡ�������������̻�ָ��������Ʒ����ƽ̨<br />��ICP��11042666��-2</div>';
		return $str;
	}
	
	//added by huafang at 2015.9.13
	public function get_slides()
	{
		$str='<div class="slides">
				<dl>
				<dt><a href="member.control.php">��Ա��������</a></dt>
				<dd><ul>
				<li><a href="m_cart.php">���ﳵ</a></li><li><a href="m_member.order.list.php">������ѯ</a></li><li><a href="m_member.bought.php">�ѹ���Ʒ</a></li><li><a href="m_member.pay.php?type=free&num=100">���߳�ֵ</a></li><li><a  href="m_member.deposit.php">Ԥ�����</a></li><li><a href="m_member.account.php">��ʷ�˵�</a></li><li><a href="m_member.points.php">�����ۼ�</a></li><li><a href="m_member.profile.php">�����޸�</a></li><!--li><a href="m_member.password.php">�����޸�</a></li--><li><a href="m_member.login.history.php">��¼��ʷ</a></li><li><a href="m_member.login.out.php">ˢ�µ�¼</a></li><!--li><a href="pay_lib/api/wxpay/">֧������</a></li-->
				</ul></dd>
				</dl>
			</div>';
		return $str;
	}
	
	public function get_header()
	{
		$str='<div class="navbar"><font><a>������ҳ</a></font><h1>'.$this->HeaderTitle.'</h1><span><strong><a>������ҳ</a></strong><label><a>���ܵ���</a></label></span></div>';
		return $str;
	}
	//end added
}
?>