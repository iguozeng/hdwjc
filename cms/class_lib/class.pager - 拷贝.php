<?php 
//!function_exists('cdstr') && exit('Forbidden');
class uobarpage
{
	private $page_name="p";//page��ǩ����������urlҳ������˵xxx.php?PB_page=2�е�PB_page
	private $pagesize=10;//ÿҳ��ʾ��¼����
	private $total=0;//�ܵļ�¼��
	private $pagebarnum=10;//���Ƽ�¼���ĸ�����
	
	private $totalpage=0;//��ҳ��
	private $linkhead="";//url��ַͷ
	private $current_pageno=1;//��ǰҳ
	/**
	 * ��ʾ��������
	 */
	private $next_page='>';//��һҳ
	private $pre_page='<';//��һҳ
	private $first_page='First';//��ҳ
	private $last_page='Last';//βҳ
	private $pre_bar='<<';//��һ��ҳ��
	private $next_bar='>>';//��һ��ҳ��
	private $format_left=' ';
	private $format_right=' ';
	
	public function __construct($total,$pagesize=10) {		
		if((!is_int($total))||($total<0))die("��¼��������");
		if((!is_int($pagesize))||($pagesize<0))die("Pagesize����");
		$this->set("total",$total);
		$this->set("pagesize",$pagesize);
		$this->set('totalpage',ceil($total/$pagesize));
	}
        
	/**
	 * �趨����ָ����������ֵ������ı�������������࣬��throwһ��exception
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
	 * get the default url��ȡָ����url��ַ
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
	 * Ϊָ����ҳ�淵�ص�ֵַ
	 */
	public function get_url($pageno=1)
	{
			if(empty($this->linkhead))$this->get_linkhead();
			return str_replace($this->page_name.'=',$this->page_name.'='.$pageno,$this->linkhead);
	}
	
	/**
	 * ���õ�ǰҳ��
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
	 * ��ȡ��ʾ"��һҳ"�Ĵ���
	 *
	 * @return string
	 */
	public function next_page() {
			if($this->current_pageno<$this->totalpage){
					return '&nbsp;<a href="'.$this->get_url($this->current_pageno+1).'" target="_self">'.$this->next_page.'</a>��';
			}
			return '';
	}
	
	/**
	 * ��ȡ��ʾ����һҳ���Ĵ���
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
	 * ��ȡ��ʾ����ҳ���Ĵ���
	 *
	 * @return string
	 */
	public function first_page() {
			return '<a href="'.$this->get_url(1).'">'.$this->first_page."</a>";
	}
	
	/**
	 * ��ȡ��ʾ��βҳ���Ĵ���
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
	 * ��ȡ��ʾ����һ��ҳ�����Ĵ���
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
	 * ��ȡ��ʾ����һ��ҳ�����Ĵ���
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
	 * ��ȡ��ʾ��ת��ť�Ĵ���
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
	 * ��ȡmysql �����limit��Ҫ��ֵ
	 *
	 * @return string
	 */
	public function limit2()
	{
			//return ("����<font color=red><b>".$this->total."</b></font>����¼��");
			return ('��<font color=red>'.$this->total.'</font>��,ÿҳ'.$this->pagesize.'��,<font color=red>'.$this->current_pageno)."</font>ҳ/<font color=red>".$this->totalpage.'</font>ҳ';

	}
	/**
	 * ���Ʒ�ҳ��ʾ��������������Ӧ�ķ��
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
							$this->next_page='��ҳ';
							$this->pre_page='��ҳ';
							$this->first_page='��ҳ';
							$this->last_page='βҳ';
							return $this->first_page().'&nbsp;'.$this->pre_page().$this->nowbar().$this->next_page().$this->last_page();
							break;
					case '2':
							$this->next_page='��ҳ';
							$this->pre_page='��ҳ';
							$this->first_page='��ҳ';
							$this->last_page='βҳ';
							return $this->first_page().$this->pre_page().'[��'.$this->current_pageno.'ҳ]'.$this->next_page().$this->last_page().'��'.$this->select().'ҳ';
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