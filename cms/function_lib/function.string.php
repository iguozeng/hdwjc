<?php
/*
str_ucase ���ַ���ʽΪ��д
*/
function str_ucase($str){
	$guest=$str;
	$guest=strtoupper($guest);
	return $guest;
}

/*
str_lcase ���ַ���ʽΪСд
*/
function str_lcase($str){
	$guest=$str;
	$guest=strtolower($guest);
	return $guest;
}


/*
str2int ���ַ���ʽΪ����
*/
function str2int($str,$len=0){
	$rt=0;
	if(!is_numeric($str)||$str==""){
		$rt=0;
	}else{
		if($len==0){
			$rt=(int)$str;
		}else{
			$arr=explode('.',$str);
			if(count($arr)>1)
			{
				$dec=$arr[1];
				if(strlen($dec)<$len)
				{
					$dec.=str_pad('',$len-strlen($dec),'0');	
				}else{
					$dec=str_left($dec,$len);
				}
				$rt=(int)$arr[0].'.'.$dec;	
			}
			else
			{
				$rt=(int)$str.'.'.str_pad('',$len,'0');	
			}
		}
	}
	return $rt;
}
	
/*
str_left ����ָ�����ȵ��ַ�
*/
function str_left($str,$len){
	$arr = str_split($str);
	$i = 0;
	foreach ($arr as $chr) {
	   if (ord($chr) > 128)$add = $add ? 0 : 1;
	   $i++;
	   if($i == $len)break;
	}
	return substr($str,0,$len+$add);
}

/*
str_left ����ָ�����ȵ��ַ�
*/
function str_right($str,$len){
	$len=0-$len;
	$arr = str_split($str);
	$i = 0;
	foreach ($arr as $chr) {
	   if (ord($chr) > 128)$add = $add ? 0 : 1;
	   $i++;
	   if($i == $len)break;
	}
	return substr($str,$len,strlen($str));
}

/*
str_instr�����ַ�������һ���ַ����е�һ�γ��ֵ�λ
*/
function str_instr($str,$f) {
	$len=-1;
	if(!empty($str))
	{
		$val=stripos($str,$f);
		if(str_trim($val)!='')$len=stripos($str,$f);	
	}
	return $len;
}

/*
str����ʡ��
*/
function str_mod($str,$max,$min=0,$d='...') {
	$str=strip_tags(str_dehtml($str));
	$len=(strlen($str) + mb_strlen($str,'UTF8'))/ 2;
	$guest=str_left($str,$max);
	if($min>0)
	{
		if($len>$min)
		{
			$guest=$guest.$d;
		}
	}
	return $guest;
}

/*
str_percent �����������İٷֱ�
*/

function str_percent($row,$sum,$mod=2){
	return round($row/$sum*100,$mod);
}

/*
str_rm ����һ��ָ�����ȵ������
*/
function str_rm($length) {
	$possible = "0123456789";
	$str = "";
	while(strlen($str) < $length) $str .= substr($possible, (rand() % strlen($possible)), 1);
	return($str);
}

/*
str_fnPoint ����һ��������
*/
function str_fnPoint($val,$len=5)
{
	if($val>$len)$val=$len;
	$str_Poss="��";
	$str_Need="��";
	$str=str_pad('',$val,'|');
	$str.=str_pad('',$len-$val,'.');
	$str=str_replace('|',$str_Poss,$str);
	$str=str_replace('.',$str_Need,$str);
	return $str;
}

/*
file_format ��ʽ���ļ���
*/
function file_format($name)
{
    $name=str_replace("'","_",$name);
	$name=str_replace(",","_",$name);
	$name=str_replace(":","",$name);
	$name=str_replace("|","_",$name);
	$name=str_replace("{","_",$name);
	$name=str_replace("}","_",$name);
	$name=str_replace("-","_",$name);
	$name=str_replace("+","_",$name);
	$name=str_replace("  ","_",$name);
	$name=trim(str_replace(" ","_",$name));
    return $name;
}

/*
str_enhtml ����htm���ֱ�������Դ���ʽ
*/
function str_enhtml($str){
	$guest=$str;
	$guest=str_replace("  ","��",$guest);
	$guest=str_replace(" ","&nbsp;",$guest);
	//$guest=htmlspecialchars($Guest);
	$guest=str_replace(">","&gt;",$guest);
	$guest=str_replace("<","&lt;",$guest);
	//$guest=str_replace("\r\n","<br>",$guest);
	$guest=str_replace("'","&#039;",$guest);
	$guest=str_replace("\"","&quot;",$guest);
	return($guest);
}

/*
str_dehtml ����Դ���ʽ���ֽ�������htm���ָ�ʽ
*/
function str_dehtml($str){
	$guest=$str;
	$guest=str_replace("&nbsp;"," ",$guest);
	$guest=html_entity_decode($guest,ENT_COMPAT,"UTF-8");
	$guest=str_replace("'","",$guest);
	return($guest);
}

/*
str_input �����������ݿ��ַ��еĵ�����
*/
function str_input2data($str){
	$guest=$str;
	$guest=str_replace("\'","&#039;",$guest);
	$guest=str_replace("'","&#039;",$guest);
	$guest=str_replace('\"',"&quot;",$guest);
	$guest=str_replace('"',"&quot;",$guest);
	$guest=str_replace("<","&lt;",$guest);
	$guest=str_replace(">","&gt;",$guest);
	return($guest);
}

function str_data2out($str){
	$guest=$str;
	$guest=str_replace("&#039;","'",$guest);
	$guest=str_replace("&quot;",'"',$guest);
	$guest=str_replace("&lt;","<",$guest);
	$guest=str_replace("&gt;",">",$guest);
	return($guest);
}

/*
str_html �����������ݿ��ַ��е�HTML��ʽ
*/
function str_putdata($str){
	$guest=$str;
	$guest=str_replace("'","",$guest);
	$guest=str_replace(" ","&nbsp;",$guest);
	$guest=str_replace(">","&gt;",$guest);
	$guest=str_replace("<","&lt;",$guest);
	$guest=str_replace("\r\n","<br>",$guest);
	return($guest);
}

/*
str_html �����������ݿ��ַ��е�HTML��ʽ
*/
function str_outdata($str){
	$guest=$str;
	$guest=str_replace("'","",$guest);
	$guest=str_replace("&nbsp;"," ",$guest);
	$guest=str_replace("<br>","\r\n",$guest);
	return($guest);
}

/*
str_url_encode �������ֵ�ַ�������
*/
function str_url_encode($str){
	//$guest='YXS'.$str.'YXS';
	$guest='YXS'.$str;
	$guest=base64_encode($guest);
	$guest=urlencode($guest);
	return($guest);
}

/*
str_url_decode �������ֵ�ַ�������
*/
function str_url_decode($str){
	$guest=$str;
	//$guest=str_replace(".html","",$guest);
	$guest=urldecode($guest);
	$guest=base64_decode($guest);
	$guest=str_replace("YXS","",$guest);

	return($guest);
}

/*
isnull ����ַ��Ƿ�Ϊ��
*/
function isnull($str) {
	$tempval=true;
	$str = str_replace("��","",$str);
	$str = str_replace(" ","",$str);
	$str = str_replace(chr(32),"",$str);
	$str = str_replace(chr(161),"",$str);
	if(($str!==' ')&&$str!=='&nbsp;'&&$str!=='')$tempval=false;
	return $tempval;
}

/*
str_trim ȥ���ַ��еĿո�
*/
function str_trim($str) {
	$str = trim(str_replace(" ","",$str));
	return $str;
}


/*
badwords_str ���˷Ƿ����ַ�
*/
function badwords_str($str,$badwords){
    if (!isnull($str)){
		$arr_bwords = explode(",",$badwords);
		foreach($arr_bwords as $value){
			$str = str_replace($value,"*",$str);
		}
    }
	return $str;
}

/*
dhtmlspecialchars ����ַ��Ϸ�
*/
function dhtmlspecialchars($string) {
	$string=str_replace("'","",$string);
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}

function tr_mouse($overclr='FD6A11',$outclr='ECECEC'){
	return ' onmouseover="this.style.backgroundColor=\'#'.$overclr.'\'" onmouseout="this.style.backgroundColor=\'#'.$outclr.'\'" ';
}

/*
get_tag_str ��ȡһ�δ���
*/
function tag_data($str,$start,$end,$hasMe=false)
{
	$strNew='';
	if(!isnull($str)){
		if(!isnull($start)){
			$message=explode($start,$str);
			if(count($message)>0){
				if(!isnull($end)){
					if(str_instr($message[1],$end)>=0){
						$strArray=explode($end,$message[1]);
						$strNew=$strArray[0];
					}else{
						$strNew=$message[1];
					}
				}else{
					$strNew=$message[1];
				}
			}else{
				$strNew='';	
			}
		}elseif(!isnull($end)){
			$message=explode($end,$str);
			$strNew=$message[0];
		}else{
			$strNew='';	
		}
	}
	if(!isnull($strNew))
	{
		if($hasMe)$strNew=$start.$strNew.$end;
	}else{
		$strNew='';	
	}
	return $strNew;
}
	
/*
arr_post �ύ������
*/
function arr_post($arr,$cls,$mod=0,$to="insert")
{
	foreach($arr as $Key=>$Val)
	{
		if(str_left($Key,1)==$cls)
		{
			$DataType=tag_data($Key,'(',')');
			$arrDataType=explode(':',$DataType);
			$Type=$arrDataType[0];
			$Key=str_right($Key,strlen($Key)-strlen($DataType)-3);
			$Len=0;
			if(count($arrDataType)>0){$Len=$arrDataType[1];$Len=str2int($Len);}
			if($Len>0){$Val=str_left($Val,$Len);}
			switch ($Type)
			{
				case 'int':
					$Val=str2int($Val);
					break;
				case 'date':
					$Val=format_dt($Val,'%Y-%m-%d %H:%M:%S');
					$Val=smarty_make_timestamp($Val);
					break;
				case 'str':
					$Val=str_putdata($Val);
					break;
				default:
					$Val=str_dehtml($Val);
					break;
			}
			if($to=="insert")
			{
				$SQLKey.="`$Key`,";
				$SQLVal.="'$Val',";
			}else{
				$SQL.="`$Key`='$Val',";	
			}
		}
	}
	$SQLKey=str_left($SQLKey,strlen($SQLKey)-1);
	$SQLVal=str_left($SQLVal,strlen($SQLVal)-1);
	$SQL=str_left($SQL,strlen($SQL)-1);
	if($to=="update")
	{
		return $SQL;
	}
	else
	{
		if ($mod==0)
		{
			return $SQLKey;
		}
		else
		{
			return $SQLVal;
		}
	}
} 
?>