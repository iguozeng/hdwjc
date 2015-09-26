<?php
/*
is_mobile 判断是否用微信浏览器
*/
function is_weixin() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$is_weixin = false;
	if(is_mobile())
	{
		if(!empty($user_agent)){
			if (preg_match('/android/i',$user_agent)&& preg_match('/micromessenger/i',$user_agent))$is_weixin = true;
			if (preg_match('/os/i',$user_agent)&& preg_match('/micromessenger/i',$user_agent))$is_weixin = true;
		}
	}
	return $is_weixin;
}

/*
is_mobile 判断是否属手机
*/
function is_mobile() {
	$user_agent = strtoupper($_SERVER['HTTP_USER_AGENT']);
	$mobile_agents = Array("240x320","iphone","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte","mqqbrowser");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	//if (preg_match('/nt 6.3/i',$user_agent)&& preg_match('/touch/i',$user_agent))$is_mobile = true; //win8平板
	return $is_mobile;
}

/*
get_client_os 返回客户端的操作系统
*/
function get_client_os(){
	$str="unknow";
	$OS=strtoupper($_SERVER['HTTP_USER_AGENT']);
	if(!empty($OS)){
		if (preg_match('/nt 6.3/i',$OS)) {
			$str = 'Windows8';
		}elseif (preg_match('/nt 6.2/i',$OS)) {
			$str = 'Windows8';
		}elseif (preg_match('/nt 6.1/i',$OS)) {
			$str = 'Windows7';
		}elseif (preg_match('/nt 6.0/i',$OS)) {
			$str = 'WindowsVista';
		}elseif (preg_match('/nt 5.2/i',$OS)) {
			$str = 'Windows2008';
		}elseif (preg_match('/nt 5.1/i',$OS)) {
			$str = 'WindowsXP';
		}elseif (preg_match('/nt 5/i',$OS)) {
			$str = 'Windows2000';
		}elseif (preg_match('/98/i',$OS)) {
			$str = 'Windows98';
		}elseif (preg_match('/win/i',$OS)) {
			$str = 'Windows';
		}elseif (preg_match('/mac/i',$OS)&& preg_match('/pc/i',$OS)) {
			$str = 'MAC';
		}elseif (preg_match('/android 2/i',$OS)) {
			$str = 'Android2x';
		}elseif (preg_match('/android 3/i',$OS)) {
			$str = 'Android3x';
		}elseif (preg_match('/android 4/i',$OS)) {
			$str = 'Android4x';
		}elseif (preg_match('/android 5/i',$OS)) {
			$str = 'Android5x';
		}elseif (preg_match('/android/i',$OS)) {
			$str = 'Android';
		}elseif (preg_match('/iphone/i',$OS)&& preg_match('/os 4/i',$OS)) {
			$str = 'iPhone4';
		}elseif (preg_match('/iphone/i',$OS)&& preg_match('/os 5/i',$OS)) {
			$str = 'iPhone5';
		}elseif (preg_match('/iphone/i',$OS)&& preg_match('/os 6/i',$OS)) {
			$str = 'iPhone6';
		}elseif (preg_match('/iphone/i',$OS)&& preg_match('/os/i',$OS)) {
			$str = 'iPhone';
		}elseif (preg_match('/ipad/i',$OS)&& preg_match('/os/i',$OS)) {
			$str = 'iPad';
		}elseif (preg_match('/linux/i',$OS)) {
			$str = 'Linux';
		}elseif (preg_match('/unix/i',$OS)) {
			$str = 'Unix';
		}elseif (preg_match('/bsd/i',$OS)) {
			$str = 'BSD';
		}else {
			$str = 'Other';
		}
		if (preg_match('/64;/i',$OS))$str.= '(X64)';
	}
	return $str;   
}
  
/*
get_client_lang 返回客户端的浏览器语言
*/
function get_client_lang(){

	if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
		$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$lang = substr($lang,0,5);
		if(preg_match("/zh/i",$lang)){
			$lang = "zh";
		}
		else{
			$lang = "en";
		}
		return $lang;
	}
	else{
		return "unknow";
	}
}
  
/*
get_client_browser 返回客户端的浏览器类型
*/
function get_client_browser(){
	if(!empty($_SERVER['HTTP_USER_AGENT'])){
		$br = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/:11./i',$br)) {    
			$br = 'IE11';
		}
		elseif (preg_match('/ie 10/i',$br)) { 
			$br = 'IE10';
		}
		elseif (preg_match('/ie 9/i',$br)) { 
			$br = 'IE9';
		}
		elseif (preg_match('/ie 8/i',$br)) { 
			$br = 'IE8';
		}
		elseif (preg_match('/ie 7/i',$br)) { 
			$br = 'IE7';
		}
		elseif (preg_match('/ie 6/i',$br)) { 
			$br = 'IE6';
		}
		elseif (preg_match('/firefox/i',$br)) {
			$br = 'Firefox';
		}
		elseif (preg_match('/chrome/i',$br)) {
			$br = 'Chrome';
		}
		elseif (preg_match('/micromessenger/i',$br)) {
			$br = 'Weixin';
		}
		elseif (preg_match('/mobile safari/i',$br)) {
			$br = 'Mobile';
		}
		elseif (preg_match('/safari/i',$br)) {
			$br = 'Safari';
		}
		elseif (preg_match('/opera/i',$br)) {
			$br = 'Opera';
		}else {
			$br = 'Other';
		}
		return $br;
	}
	else{
		return "unknow";
	} 
}

/*
get_client_ip 返回客户端的IP地址值
*/
function get_client_ip(){
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$ip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$ip = preg_replace("/^([\d\.]+).*/", "\\1", $ip);
	return $ip;
}

/*
post_chk 判断是否外部提交
*/
function post_chk(){
	$chk=false;
	$server_v1 = $_SERVER['HTTP_REFERER'];
	$server_v2 = $_SERVER['SERVER_NAME'];
	if ($server_v1<>"") {
		$requesturl=substr($server_v1,7);
		$requesturllist = explode("/",$requesturl);
		if ( $requesturllist[0]!=$server_v2 ) {
			$chk=false;
		} else {
			$chk=true;
		}
	} else {
		$chk=false;
	}
	return $chk;
}


function ip2int($str)
{
	$str=explode(".",$str);
	if (!is_numeric(join(NULL,$str)) or count($str)!=4)
	{
		return false;
	}
	else
	{
		return($str[3]+256*$str[2]+65536*$str[1]+16777216*$str[0]);
	}
}

function ip2float($str)
{
	$arr=explode(".",$str);
	$strNum="";
	foreach($arr as $v)
	{
		if(strlen($v)<3)
		{
			$nval=3-strlen($v);
			$nstr=str_pad("",$nval,'0');
			$nstr=$nstr.$v;
			$strNum.=$nstr;
		}
		else
		{
			$strNum.=$v;
		}
	}
	$key=str_left($strNum,1);
	$val=str_right($strNum,strlen($strNum)-1);
	$strVal=$key.'.'.$val;
	$strVal=round($strVal,11);
	return $strVal;
}

function ip2area($str)
{
	$arrIP=explode('.',$str);
	$sip=$arrIP[0].'.'.$arrIP[1].'.'.$arrIP[2].'.1';
	$sipnum=ip2float($sip);
	$eipnum=ip2float($str);
	$rel=query("select Area,Location from ipaddress_tbl where IpStartFloat<='$eipnum' and IpEndFloat>='$eipnum' order by IpEndFloat limit 1");
	if(num_rows($rel)){
		$rs=fetch_array($rel);
		$str_Area=$rs[0];
		$str_Location=$rs[1];
		if(!isnull($str_Location))$str_Location='，'.$str_Location;
		$strRegLocation=$str_Area.$str_Location;
	}
	return $strRegLocation;
}

/*
get_all_url 取得所有URL超链接
*/

function get_all_url($string){
	$string = str_replace("\r","",$string); 
	$string = str_replace("\n","",$string); 
	$regex[url] = "((http|https|ftp|telnet|news):\/\/)?([a-z0-9_\-\/\.]+\.[][a-z0-9:;&#@=_~%\?\/\.\,\+\-]+)";  
	$regex[email] = "([a-z0-9_\-]+)@([a-z0-9_\-]+\.[a-z0-9\-\._\-]+)"; 
	//去掉标签之间的文字 
	$string = eregi_replace(">[^<>]+<","><", $string); 
	//去掉JAVASCRIPT代码 
	$string = eregi_replace("<!--.*//-->","", $string); 
	//去掉非<a>的HTML标签   
	$string = eregi_replace("<[^a][^<>]*>","", $string); 
	//去掉EMAIL链接        
	$string = eregi_replace("<a([ ]+)href=([\"']*)mailto:($regex[email])([\"']*)[^>]*>","", $string); 
	//替换需要的网页链接  
	$string = eregi_replace("<a([ ]+)href=([\"']*)($regex[url])([\"']*)[^>]*>","\\3\t", $string); 
	$output[0] = strtok($string, "\t"); 
	while(($temp = strtok("\t"))) 
	{ 
		if($temp && !in_array($temp, $output)) 
		$output[++$i] = $temp; 
	} 
	return $output;
}

/*
get_link_title 取得所有URL超链接和标签
*/
function get_link_title($code){ 
	$links='';$texts='';$match=array(); 
	$pattern='/<a.*?(?: |\\t|\\r|\\n)?href=[\'"]?(.+?)[\'"]?(?:(?: |　|  |\\t|\\r|\\n)+.*?)?>(.+?)<\/a.*?>/sim';
	@preg_match_all($pattern,$code,$arr); 
	while(list($key,$val)=each($arr[1])){ 
		$links.=$val.'||||'; 
	}
	while(list($key,$val)=each($arr[2])){ 
		$texts.=$val.'||||'; 
	}
	$arrlink=explode('||||',$links);
	$arrtext=explode('||||',$texts);
	for($i=0;$i<count($arrlink);$i++){
		$str.="'$arrtext[$i]'=>'$arrlink[$i]',";
	}
	$str='$match=array('.$str.');';
	eval($str);
	return $match;
}

function get_link($link){ 
	$strLink=$link;
	//$ret=eregi('"',$link);
	if(strpos($link,'"')>-1)
	{
		$links=explode('"',$link);
		$strLink=$links[0];
	}
	//$ret=eregi("'",$link);
	if(strpos($link,"'")>-1)
	{
		$links=explode("'",$link);
		$strLink=$links[0];
	}
	return $strLink; 
}

function match_links($document) {    
   preg_match_all("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</a>'isx",$document,$links);                        
   while(list($key,$val) = each($links[2])) {
       if(!empty($val))
           $match['link'][] = $val;
   }
   while(list($key,$val) = each($links[3])) {
       if(!empty($val))
           $match['link'][] = $val;
   }        
   while(list($key,$val) = each($links[4])) {
       if(!empty($val))
           $match['content'][] = $val;
   }
   while(list($key,$val) = each($links[0])) {
       if(!empty($val))
           $match['all'][] = $val;
   }                
   return $match;
}

/*
get_img_url 取得所有图片URL地址
*/
function get_img_url($code) {   
	$pattern='/src=["|\']?([^>"\' ]+)["|\']?\s*[^>]*>([^>]+)/i';  
	@preg_match_all($pattern,$code,$arr);   
	$arr_code=array($arr[1]); 
	foreach($arr_code as $imgkey=>$imgval){
		foreach($imgval as $simgkey=>$imgurl){
			$end_str=substr($imgurl,-5); 
			$Isimg=false;
			if(eregi('.gif',$end_str)){ 
				$Isimg=true;
			}elseif(eregi('.jpg',$end_str)){ 
				$Isimg=true;
			}elseif(eregi('.jpeg',$end_str)){ 
				$Isimg=true;
			}elseif(eregi('.bmp',$end_str)){ 
				$Isimg=true;
			}elseif(eregi('.png',$end_str)){ 
				$Isimg=true;
			}else{ 
				$Isimg=false;
			} 
			if($Isimg)$return.=$imgurl.',';
		}
	}
	return $return;
}

/*
get_uri 当前URL地址
*/
function get_uri(){
	if (isset($_SERVER['REQUEST_URI'])){
		//$uri = $_SERVER['REQUEST_URI'] .'?'.$_SERVER['QUERY_STRING'];
		$uri = $_SERVER['REQUEST_URI'];
	}else{
		//if (isset($_SERVER['argv'])){
			//$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
		//}else{
			$uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
		//}
		//$uri = $_SERVER['PHP_SELF']
	}
	return $uri;
}

//使用代理获得远程文件url
function get_agent_url($path_get)
{
	$ret=false;
	$q_host=$q_path=str_replace('http://','',$path_get);
	$q_host=explode('/',$q_host);
	$q_host=$q_host[0];
	$q_path=strstr($q_path,'/');
	@$fsp=fsockopen($q_host,80,$errno,$errstr,30);
	if($fsp)
	{
		@fputs($fsp, "GET $q_path HTTP/1.1\r\n");
		@fputs($fsp, "Host: $q_host\r\n");
		@fputs($fsp, "Accept: */*\r\n");
		@fputs($fsp, "Cache-Control: no-cache\r\n");
		@fputs($fsp, "Cookie: adunion1010417=yes\r\n");
		@fputs($fsp, "Pragma: no-cache\r\n");
		@fputs($fsp, "Referer: http://$q_host/\r\n");
		@fputs($fsp, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)\r\n");
		@fputs($fsp, "Connection: Close\r\n\r\n");
	}
	$fsp_Content='';
	while($fsp_str=fread($fsp,4096))
	$fsp_Content.= $fsp_str;
	@fclose($fsp);
	$path_get=str_trim(tag_data($fsp_Content,"Location:","\n"));
	if(!isnull($path_get))
	{
		$ret=$path_get;
	}
	return $ret;
}

//使用真实远程文件url
function get_true_url($path_get)
{
	$ret=false;
	ob_start();
	$ch = curl_init($path_get);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, 1);
	if (!empty($user) && !empty($pw))
	{
		$headers = array('Authorization: Basic ' . 
		base64_encode($user.':'.$pw));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}
	$okay = curl_exec($ch);
	curl_close($ch);
	$head = ob_get_contents();
	ob_end_clean(); 
	$path_get=str_trim(tag_data($head,"Location:","\n"));
	if(!isnull($path_get))
	{
		$ret=$path_get;
	}
	return $ret;
}


function get_url_data($url,$file_path){
	$ret=false;	
	$url = eregi_replace('^http://', '', $url);
	$temp = explode('/', $url);
	$host = array_shift($temp);
	$path = '/'.implode('/', $temp);
	$temp = explode(':', $host);
	$host = $temp[0];
	$port = isset($temp[1]) ? $temp[1] : 80;
	/*
	$fp = @fsockopen($host, $port, &$errno, &$errstr, 30);
	if ($fp)@fputs($fp,"GET $path HTTP/1.1\r\nHost: $host\r\nAccept: //*\r\nReferer:$url\r\nUser-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)\r\nConnection: Close\r\n\r\n");
	$size=0;
	while(!feof($fp)){
		$tmp = fgets($fp);
		if(trim($tmp)==''){
			break;
		}else if(preg_match('/Content-Length:(.*)/si',$tmp,$arr)){
			$file_size=trim($arr[1]);
		}
	}
	*/
	$file_size=str2int($file_size);
	@$hdl_write = fopen(YXS.$file_path,'wb');
	$get_Size=1024;
	while ($str=@fread($fp,$get_Size)){
		fwrite($hdl_write,$str);
		$pro_Size=$pro_Size+$get_Size;
		if($pro_Size>$file_size)$pro_Size=$file_size;
		$pro_b_num=round($pro_Size/$file_size,2)*100;
		if($pro_b_num>100)$pro_b_num=100;
		$is_dis=false;
		if($pro_b_num%5==0)$is_dis=true;
		if($is_dis)
		{
			/* echo '<script>getId("pro_num").innerHTML="<b>'.$pro_b_num.'%</b>/'.format_file_size($pro_Size).'";</script>';
			ob_end_flush();*/
		}
	}
	@fclose($fp);
	//重定向
	if(preg_match("/^HTTP\/\d.\d 301 Moved Permanently/is",$Content)){
		if(preg_match("/Location:(.*?)\r\n/is",$Content,$murl))return get_page_content($murl[1]);
	}
	//读取内容
	if(preg_match("/^HTTP\/\d.\d 200 OK/is",$Content)){
		preg_match("/Content-Type:(.*?)\r\n/is",$Content,$murl);
		$contentType=trim($murl[1]);
		$Content=explode("\r\n\r\n",$Content,2);
		$Content=$Content[1];
	}
	if($file_size>0)$ret=$file_size;
	return $ret;
}

/*保存远程文件*/
function save_urlfile($path_get,$path_save,$open_mod=0)
{
	if($open_mod==1)
	{
		$q_host=$q_path=str_replace('http://','',$path_get);
		$q_host=explode('/',$q_host);
		$q_host=$q_host[0];
		$q_path=strstr($q_path,'/');
		@$fsp=fsockopen($q_host,80,$errno,$errstr,30);
		if($fsp)
		{
			@fputs($fsp, "GET $q_path HTTP/1.1\r\n");
			@fputs($fsp, "Host: $q_host\r\n");
			@fputs($fsp, "Accept: */*\r\n");
			@fputs($fsp, "Referer: http://$q_host/\r\n");
			@fputs($fsp, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)\r\n");
			@fputs($fsp, "Connection: Close\r\n\r\n");
		}
		$fsp_Content='';
		while($fsp_str=fread($fsp,4096))
		$fsp_Content.= $fsp_str;
		@fclose($fsp);
		//if(preg_match('/Location:(.*)/si',$fsp_Content,$arr))$path_get=trim($arr[0]);
		$path_get=str_trim(get_tag_data($fsp_Content,"Location:","\n"));
	}
	$Ext=getExt($path_get);	
	@$hdl_read = fopen($path_get,'rb');
	if(!$hdl_read)
	{
		return -1;
	}
	else
	{
		@$hdl_write = fopen($path_save.'.'.$Ext,'wb');
		if($hdl_write)
		{
			while(!feof($hdl_read))
			{
				fwrite($hdl_write,fread($hdl_read,8192));
			}
			fclose($hdl_write);
			fclose($hdl_read);
			return 1;
		}else
		{
			return 0;
		}
	}
}
/*获得远程文件数据*/
function get_urlfile_data($path_get,$open_mod=0)
{
	$ret=false;
	if($open_mod==1)
	{
		$q_host=$q_path=str_replace('http://','',$path_get);
		$q_host=explode('/',$q_host);
		$q_host=$q_host[0];
		$q_path=strstr($q_path,'/');
		@$fsp=fsockopen($q_host,80,$errno,$errstr,30);
		if($fsp)
		{
			@fputs($fsp, "GET $q_path HTTP/1.1\r\n");
			@fputs($fsp, "Host: $q_host\r\n");
			@fputs($fsp, "Accept: */*\r\n");
			@fputs($fsp, "Cache-Control: no-cache\r\n");
			@fputs($fsp, "Cookie: adunion1010417=yes\r\n");
			@fputs($fsp, "Pragma: no-cache\r\n");
			@fputs($fsp, "Referer: http://$q_host/\r\n");
			@fputs($fsp, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)\r\n");
			@fputs($fsp, "Connection: Close\r\n\r\n");
		}
		$fsp_Content='';
		while($fsp_str=fread($fsp,8192))
		$fsp_Content.= $fsp_str;
		@fclose($fsp);
		//if(preg_match('/Location:(.*)/si',$fsp_Content,$arr))$path_get=trim($arr[0]);
		$path_get=str_trim(tag_data($fsp_Content,"Location:","\n"));
	}
	$Ext=getExt($path_get);	
	@$hdl_read = fopen($path_get,'rb');
	if($hdl_read)
	{
		$_getContent='';
		while($fp_str=fread($hdl_read,4096))
		$_getContent.= $fp_str;
		@fclose($fp_str);
		$ret=$_getContent;
	}else $ret=false;
	@fclose($hdl_read);
	$ret=str_replace("  "," ",$ret);
	$ret=str_replace("　"," ",$ret);
	$ret=str_replace("'","",$ret);
	return $ret;
}

//取得远程文件扩展名
function getExt($path)
{
	$ret=false;
	$path=pathinfo($path);
	$ret=strtolower($path['extension']);
	if(isnull($ret))
	{
		$paths=explode('.',$path);
		$ret=$paths[1];
	}
	return $ret;
}

//取得远程文件大小
function remote_filesize($url) 
{ 
	$url=parse_url($url);
	if($fp=@fsockopen($url['host'],empty($url['port'])?80:$url['port'],$error)){
		fputs($fp,"GET ".(empty($url['path'])?'/':$url['path'])." HTTP/1.1\r\n");
		fputs($fp,"Host:$url[host]\r\n\r\n");
		while(!feof($fp)){
			$tmp = fgets($fp);
			if(trim($tmp)==''){
				break;
			}else if(preg_match('/Content-Length:(.*)/si',$tmp,$arr)){
				$size=trim($arr[1]);
			}
		}
	}else{
		$size=0;
	}
	@fclose($fp);
	return $size;
}
?>