<?php
date_default_timezone_set('PRC');
$mtime = explode(' ', microtime());
$starttime = $mtime[1] + $mtime[0]; 
$PHP_SELF = $_SERVER['REQUEST_URI'];
$PHP_SELF_SCRIPT_NAME = $_SERVER['SCRIPT_NAME'];
$php_error_reporting = 3;
switch($php_error_reporting) {
	case 0: error_reporting(0); break;
	case 1: error_reporting(E_ERROR | E_WARNING | E_PARSE); break;
	case 2: error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); break;
	case 3: error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); break;
	case 4: error_reporting(E_ALL ^ E_NOTICE); break;
	case 5: error_reporting(E_ALL); break;
	default:error_reporting(E_ALL);
}
if (isset($PHP_SELF)){
	$URI=$PHP_SELF;
}else{
	$URI=$_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
}
$Url=urlencode("http://".$_SERVER['HTTP_HOST'].$URI);
session_start(); 
//$nocache = 0;
if($nocache) {
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
}else {
	session_cache_limiter('public');
	header("Cache-control: public");
	@header("Expires: 100");
}
ob_start();
define('YXS', substr(dirname(__FILE__), 0, -7));
define('SYS', 'e:/wwwroot/main/cms/');
define('SYS', 'D:/wwwroot/hdwjc.com/cms.hdwjc.com/');

@set_magic_quotes_runtime(0); 
$magic_quotes_gpc = get_magic_quotes_gpc();
extract(daddslashes($_POST,1));
extract(daddslashes($_GET,1));
extract($_COOKIE);
if(!$magic_quotes_gpc) $_FILES = daddslashes($_FILES);
require_once 'conn.php';
global $Global;
$page_url = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
define('PHP_NEXTLINE', (PHP_OS == 'WINNT')?"\r\n":"\n");
define("mysql_HOST","localhost");
define("mysql_USERNAME","hdwjc_user");
define("mysql_PASSWORD","5220400");
define("mysql_DATABASE","hdwjc_data");
require_once SYS.'include/config.php';
require_once SYS.'include/var.php';
require_once SYS.'include/class_lib/class.cache.php';
require_once SYS.'include/function_lib/function.string.php';
require_once SYS.'include/function_lib/function.msg.php';
require_once SYS.'include/function_lib/function.net.php';
require_once SYS.'include/function_lib/function.io.php';
require_once SYS.'include/function_lib/function.img.php';
require_once SYS.'include/function_lib/function.date.php';
require_once SYS.'include/function_lib/function.pinyin.php';
if(CacheEnable)$cache=new Cache(YXS."cache/");
$ip_local=get_area_array();
$i=0;
foreach($ip_local as $arr){foreach($arr as $aid=>$area){if($i==0){$ProvinceId=str2int($aid);$ProvinceName=$area;}if($i==1){$CityId=str2int($aid);$CityName=$area;}if($i==2){$DistrictId=str2int($aid);$DistrictName=$area;}$i++;}}

function daddslashes($string, $force = 0) {
	global $magic_quotes_gpc;
	if(!$GLOBALS['magic_quotes_gpc'] || $force || $magic_quotes_gpc) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}
?>