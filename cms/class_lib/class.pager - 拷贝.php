<?php 
//!function_exists('cdstr') && exit('Forbidden');
class uobarpage
{
	private $page_name="p";//page标签，用来控制url页。比如说xxx.php?PB_page=2中的PB_page
	private $pagesize=10;//每页显示记录条数
	private $total=0;//总的记录数
	private $pagebarnum=10;//控制记录条的个数。
	
	private $totalpage=0;//总页数
	private $linkhead="";//url地址头
	private $current_pageno=1;//当前页
	/**
	 * 显示符号设置
	 */
	private $next_page='>';//下一页
	private $pre_page='<';//上一页
	private $first_page='First';//首页
	private $last_page='Last';//尾页
	private $pre_bar='<<';//上一分页条
	private $next_bar='>>';//下一分页条
	private $format_left=' ';
	private $format_right=' ';
	
	public function __construct($total,$pagesize=10) {		
		if((!is_int($total))||($total<0))die("记录总数错误！");
		if((!is_int($pagesize))||($pagesize<0))die("Pagesize错误！");
		$this->set("total",$total);
		$this->set("pagesize",$pagesize);
		$this->set('totalpage',ceil($total/$pagesize));
	}
        
	/**
	 * 设定类中指定变量名的值，如果改变量不属于这个类，将throw一个exception
	 *
	 * @param string $var
	 * @param string $value
	 */
	public function set($var,$value)
	{
			if(in_array($var,get_object_vars($this)))
			   $this->$var=$value;
			else {
					throw new PB_Page_Exception("Error in set():".$var." does not belong to PB_Page!");
			}
	}
	
	/**
	 * get the default url获取指定的url地址
	 *
	 */
/*
	public function get_linkhead() {
		$this->set_current_page();
		$this->linkhead=$_SERVER['PHP_SELF']."?".$this->page_name."=";
	}
*/
	public function get_linkhead() {
		$this->set_current_page();
		if(empty($_SERVER['QUERY_STRING'])){
			 $this->linkhead=$_SERVER['REQUEST_URI']."?".$this->page_name."=";
		}else{
			if(isset($_GET[$this->page_name])){                                
					$this->linkhead=str_replace($this->page_name.'='.$this->current_pageno,$this->page_name.'=',$_SERVER['REQUEST_URI']);
			} else {
					$this->linkhead=$_SERVER['REQUEST_URI'].'&'.$this->page_name.'=';
			}
		}
	}

	/**
	 * 为指定的页面返回地址值
	 */
	public function get_url($pageno=1)
	{
			if(empty($this->linkhead))$this->get_linkhead();
			return str_replace($this->page_name.'=',$this->page_name.'='.$pageno,$this->linkhead);
	}
	
	/**
	 * 设置当前页面
	 *
	 */
	public function set_current_page($current_pageno=0) {
		if(empty($current_pageno)){
				if(isset($_GET[$this->page_name])){
							  $this->current_pageno=intval($_GET[$this->page_name]);
				}
		}else{
				$this->current_pageno=intval($current_pageno);
		}
		if ($this->current_pageno>$this->totalpage)	header("Location:./");//////////$this->current_pageno=1////////////
	}
	
	public function set_format($str) {
			return $this->format_left.$str.$this->format_right;
	}

	/**
	 * 获取显示"下一页"的代码
	 *
	 * @return string
	 */
	public function next_page() {
			if($this->current_pageno<$this->totalpage){
					return '&nbsp;<a href="'.$this->get_url($this->current_pageno+1).'" target="_self">'.$this->next_page.'</a>　';
			}
			return '';
	}
	
	/**
	 * 获取显示“上一页”的代码
	 *
	 * @return string
	 */
	public function pre_page() {
			if($this->current_pageno>1){
					return '<a href="'.$this->get_url($this->current_pageno-1).'" target="_self">'.$this->pre_page.'</a>&nbsp;';
			}
			return '';
	}
	
	/**
	 * 获取显示“首页”的代码
	 *
	 * @return string
	 */
	public function first_page() {
			return '<a href="'.$this->get_url(1).'">'.$this->first_page."</a>";
	}
	
	/**
	 * 获取显示“尾页”的代码
	 *
	 * @return string
	 */
	public function last_page() {
			return '<a href="'.$this->get_url($this->totalpage).'">'.$this->last_page.'</a>';
	}
	
	//123456778910eeeeeeeeeeeeeeeeee
	public function nowbar() {
			$begin=$this->current_pageno-ceil($this->pagebarnum/2);
			$begin=($begin>=1)?$begin:1;
			$return='';
			for($i=$begin;$i<$begin+$this->pagebarnum;$i++)
			{
					if($i<=$this->totalpage){
							if($i!=$this->current_pageno)
								$return.=' <a href="'.$this->get_url($i).'" target="_self">'.'['.$i.']'.'</a> ';
							else 
								$return.='<font color=red>'.$i.'</font> ';
					}else{
							break;
					}
			}
			unset($begin);
			return $return;
	}
	
	/**
	 * 获取显示“上一分页条”的代码
	 *
	 * @return string
	 */
	public function pre_bar()
	{
			if($this->current_pageno>ceil($this->pagebarnum/2)){
					$pageno=$this->current_pageno-$this->pagebarnum;
					if($pageno<=0)$pageno=1;
					return $this->set_format('<a href="'.$this->get_url($pageno).'" target="_self">'.$this->pre_bar."</a>");
			}
			else
			{
				return $this->set_format($this->pre_bar);
			}
			return $this->set_format('<a href="'.$this->get_url(1).'" target="_self">'.$this->pre_bar."</a>");
	}
	
	/**
	 * 获取显示“下一分页条”的代码
	 *
	 * @return string
	 */
	public function next_bar()
	{
			if($this->current_pageno<$this->totalpage-ceil($this->pagebarnum/2)){
					$pageno=$this->current_pageno+$this->pagebarnum;
					return $this->set_format('<a href="'.$this->get_url($pageno).'" target="_self">'.$this->next_bar."</a>");
			}
			else
			{
				return $this->set_format($this->next_bar);
			}
			return $this->set_format('<a href="'.$this->get_url($this->totalpage).'" target="_self">'.$this->next_bar."</a>");
	}
	
	/**
	 * 获取显示跳转按钮的代码
	 *
	 * @return string
	 */
	public function select()
	{
			$return='<select name="PB_Page_Select" onchange="window.location.href=\''.$this->linkhead.'\'+this.options[this.selectedIndex].value">';
			for($i=$this->current_pageno;$i<=$this->current_pageno+10;$i++)
			{
					if($i==$this->current_pageno){
							$return.='<option value="'.$i.'" selected>'.$i.'</option>';
					}else{
							$return.='<option value="'.$i.'">'.$i.'</option>';
					}
			}
			$return.='</select>';
			return $return;
	}
	
	/**
	 * 获取mysql 语句中limit需要的值
	 *
	 * @return string
	 */
	public function limit2()
	{
			//return ("共有<font color=red><b>".$this->total."</b></font>条记录。");
			return ('共<font color=red>'.$this->total.'</font>条,每页'.$this->pagesize.'条,<font color=red>'.$this->current_pageno)."</font>页/<font color=red>".$this->totalpage.'</font>页';

	}
	/**
	 * 控制分页显示风格（你可以增加相应的风格）
	 *
	 * @param int $mode
	 * @return string
	 */
	public function pagebar($mode=1)
	{
			$this->set_current_page();
			$this->get_linkhead();
			switch ($mode)
			{
					case '1':
							$this->next_page='下页';
							$this->pre_page='上页';
							$this->first_page='首页';
							$this->last_page='尾页';
							return $this->first_page().'&nbsp;'.$this->pre_page().$this->nowbar().$this->next_page().$this->last_page();
							break;
					case '2':
							$this->next_page='下页';
							$this->pre_page='上页';
							$this->first_page='首页';
							$this->last_page='尾页';
							return $this->first_page().$this->pre_page().'[第'.$this->current_pageno.'页]'.$this->next_page().$this->last_page().'第'.$this->select().'页';
							break;
					case '3':
							$this->next_page='>';
							$this->pre_page='<';
							$this->first_page='|<';
							$this->last_page='>|';
							return $this->first_page().$this->pre_page().$this->next_page().$this->last_page();
							break;
					case '4':
							return $this->pre_bar().$this->pre_page().$this->nowbar().$this->next_page().$this->next_bar();
							break;
			}
			
	}
}
?>