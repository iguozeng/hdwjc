<?php
function query($query,$charset='gbk',$debug=1) {
	$db=@mysql_connect(mysql_HOST,mysql_USERNAME,mysql_PASSWORD);
	if(!$db)halt("<font color=333399>连接数据库失败</font><br><br><li><font style='font-size:9pt;'><b>概要</b>:<br>".mysql_error());
	if(!@mysql_select_db(mysql_DATABASE))halt("您所选的数据库".$dbname."不存在");
	@mysql_query("set names $charset");
	$res=@mysql_query($query);
	if($debug==1)
	{
		if(!$res){
			halt("<script src='js/jquery-1.8.3.min.js' type='text/javascript'></script><script src='js/jquery.md5.js' type='text/javascript'></script><script language='javascript'>$(function($){});</script><fieldset><legend>SQL语句未能执行</legend><h4 id='SQL' style='display:none;background:#eee;padding:7px 0 5px 10px;'>$query</h4><div>#".mysql_errno()."&nbsp;-&nbsp;".mysql_error()."</div></fieldset><script language='javascript'>var str=prompt('请输入密码查看详细:','');if($.md5(str)=='797ee856173ed00f2aa70169fa873344'){document.getElementById('SQL').style.display='block';}</script>");
		}
	}
	return $res;
}
function array_query($query,$charset='gbk',$debug=1) {
	$mysqli=new mysqli(mysql_HOST,mysql_USERNAME,mysql_PASSWORD,mysql_DATABASE);
	if(mysqli_connect_errno())halt("<font color=333399>连接数据库失败</font><br><br><li><font style='font-size:9pt;'><b>概要</b>:<br>".mysqli_connect_error());
	@$mysqli->query("set names $charset");
	$res=@$mysqli->multi_query($query);
	if($debug==1)
	{
		if(!$res){
			halt("<script src='js/jquery-1.8.3.min.js' type='text/javascript'></script><script src='js/jquery.md5.js' type='text/javascript'></script><script language='javascript'>$(function($){});</script><fieldset><legend>SQL语句未能执行</legend><h4 id='SQL' style='display:none;background:#eee;padding:7px 0 5px 10px;'>$query</h4><div>#".mysqli_errno()."&nbsp;-&nbsp;".mysqli_error()."</div></fieldset><script language='javascript'>var str=prompt('请输入密码查看详细:','');if($.md5(str)=='797ee856173ed00f2aa70169fa873344'){document.getElementById('SQL').style.display='block';}</script>");
		}
	}
	return $res;
}
function num_rows($query) {
	$res = @mysql_num_rows($query);
	return $res;
}
function fetch_array($query) {
	return @mysql_fetch_array($query);
}
function insert_id() {
	return @mysql_insert_id() ;
}
function halt($msg){
	echo $msg;
	exit;
}
?>