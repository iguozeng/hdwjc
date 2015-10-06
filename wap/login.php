<?php
require_once 'include/init.php';
//require_once YXS.'m.global.class.php';
if(str2int(CacheEnable)==1){
	if($cacheact!='rewrite')$cache->load();
}
//$global=new global_event();

$strAction=$_POST['action'];
if($strAction=='send_register')event_register();
if($strAction=='send_login')event_login();
function event_register(){
	$errnum=false;
	$Postip=get_client_ip();
	$dtime=date("Y-m-d H:i:s");
	$Posttime=smarty_make_timestamp($dtime);
	$MemberName=str_putdata($_POST['MemberName']);
	$MemberPass=str_putdata($_POST['MemberPass']);
	$CmfMemberPass=str_putdata($_POST['CmfMemberPass']);
	$Name=str_putdata($_POST['Name']);
	$Moblie=str_putdata($_POST['Moblie']);
	$BcakUrl=$_POST['bcakurl'];
	if(isnull($MemberName))
	{
		$errnum=true;
		msg("请正确输入登录帐号","",1);
	}
	if(isnull($MemberPass))
	{
		$errnum=true;
		msg("请正确输入登录密码","",1);
	}
	if(isnull($CmfMemberPass))
	{
		$errnum=true;
		msg("请正确输入确认密码","",1);
	}
	if($MemberPass!=$CmfMemberPass)
	{
		$errnum=true;
		msg("两次密码不统一","",1);
	}
	if(isnull($Name))
	{
		$errnum=true;
		msg("请正确输入真实姓名","",1);
	}
	if(isnull($Moblie))
	{
		$errnum=true;
		msg("请正确输入手机号码","",1);
	}
	if(!$errnum)
	{
		$result =query("select MemberId from member_tbl where MemberName='$MemberName' and (MemberId>0 and MemberId is not null)");
		if(num_rows($result)){$errnum=true;msg("登录帐号已存在，请选择其他帐号","",2);}
	}
	if (!$errnum)
	{
		$RegisterPoints=str2int(RegisterPoints);
		$MemberPass=md5($MemberPass);
		$MemberClassId=1;
		$result =query("select MemberClassId from member_class_tbl order by MemberClassId limit 1");
		if(num_rows($result)){$row =fetch_array($result);$MemberClassId=$row[0];}
		/*插入注册信息*/
		query("insert into member_tbl(MemberName,MemberPass,MemberClassId,Points,`UnLock`,RegIp,RegDatetime) values
		('$MemberName','$MemberPass','$MemberClassId','$RegisterPoints','1','$Postip','$Posttime')");
		$MemberId=insert_id();
		/*插入联系人信息*/
		query("insert into member_info_tbl(MemberId,NiName,Name)values('$MemberId','$MemberName','$Name')");
		query("insert into member_address_tbl(MemberId,Linkman,Mobile)values('$MemberId','$Name','$Moblie')");
		$strContent="注册新会员[移动端]";
		insert_member_log($strContent,$MemberId,1);
		$_SESSION['session_verify']='';
		$_SESSION["MemberId"]=$MemberId;
		$_SESSION['MemberName']=$MemberName;
		$_SESSION['MemberPass']=$MemberPass;
		if($RegisterPoints>0)insert_points_log($MemberId,$RegisterPoints,$strContent);
		$UserName=$_COOKIE['UserName'];
		if(!isnull($UserName))
		{
			$result=query("select TempOrderId from temp_order_tbl where IsRegisterUser=0 and UserName='$UserName'");
			if(num_rows($result))query("update `temp_order_tbl` set IsRegisterUser=1,UserName='$MemberName' where IsRegisterUser=0 and UserName='$UserName'");
		}
		if(isnull($BcakUrl))
		{
			header("Location:m_member.control.php");
		}else{
			header("Location:$BcakUrl");
		}
	}
	return false;
};
function event_login(){
	$strResult="";
	$errnum=false;
	$Postip=get_client_ip();
	$dtime=date("Y-m-d H:i:s");
	$Posttime=smarty_make_timestamp($dtime);
	$MemberName=str_putdata($_POST['MemberName']);
	$MemberPass=str_putdata($_POST['MemberPass']);
	$BcakUrl=$_POST['bcakurl'];
	if(isnull($MemberName))
	{
		$errnum=true;
		msg("请正确输入登录帐号","",1);
	}
	if(isnull($MemberPass))
	{
		$errnum=true;
		msg("请正确输入登录密码","",1);
	}
	$MemberPass=md5($MemberPass);
	if(!$errnum)
	{
		$result =query("select MemberId,MemberName,MemberPass,`UnLock`,LoginIp,LoginDatetime from member_tbl where MemberName='$MemberName' and (AgentId=0 and MemberId>0 and MemberId is not null)");
		if(num_rows($result)){
			$row =fetch_array($result);
			if($row[1]!=$MemberName){$errnum=true;$strResult="[0,'user']";}
			if($row[2]!=$MemberPass){$errnum=true;$strResult="[0,'password']";}
			if($row[3]==0){$errnum=true;$strResult="[0,'lock']";}
		}else{
			$errnum=true;
			$strResult="[0,'user']";
		}
		if(!$errnum)
		{
			$LoginPoints=str2int(LoginPoints);
			$MemberId=$row[0];
			$MemberName=$row[1];
			$MemberPass=$row[2];
			$LastLoginIp=$row[4];
			$LastLoginDatetime=str2int($row[5]);
			$_SESSION['session_verify']='';
			$_SESSION["MemberId"]=$MemberId;
			$_SESSION['MemberName']=$MemberName;
			$_SESSION['MemberPass']=$MemberPass;
			$strContent="会员登录系统[移动端]";
			if($LoginPoints>0){
				if($LastLoginDatetime>0)$strLastLoginDatetime=format_dt($LastLoginDatetime,'%Y-%m-%d %H:%M:%S');
				$mod_date=datediff('h',$LastLoginDatetime,$dtime);
				$mod_date=str2int($mod_date);
				if($mod_date>2){
					insert_points_log($LoginPoints,$strContent);
				}else{
					$LoginPoints=0;
				}
			}
			query("update member_tbl set Points=Points+$LoginPoints,LoginIp='$Postip',LoginDatetime='$Posttime',LastLoginIp='$LastLoginIp',LastLoginDatetime='$LastLoginDatetime',LoginTotal=LoginTotal+1 where MemberId='$MemberId'");
			insert_member_log($strContent,$MemberId,1);
			$strResult="[1]";
			$UserName=$_COOKIE['UserName'];
			if(!isnull($UserName))
			{
				$result=query("select TempOrderId from temp_order_tbl where IsRegisterUser=0 and UserName='$UserName'");
				if(num_rows($result))query("update `temp_order_tbl` set IsRegisterUser=1,UserName='$MemberName' where IsRegisterUser=0 and UserName='$UserName'");
			}
			if(isnull($BcakUrl))
			{
				header("Location:member.control.php");
			}else{
				header("Location:$BcakUrl");
			}
		}else{
			msg("登录帐号或登录密码错误","",1);	
		}
	}
	return false;
};
if($action=='new')
{
	$Title='注册帐号';
}else{
	$Title='登录系统';
}
$global->HeaderTitle=$Title;

$page_name='用户登录';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>用户登录</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
</head>
<body>
<?php require_once 'p.header.php';?>
<div class="wrapper loginform">
<form name="Loginform" method="post">
<input type="hidden" name="action" value="send_login" />
	<span>用户名：</span>
    <div class="typein">
    	<img src="images/ico_01.png"/>
    	<input type="text" name="MemberName" value="" />
    </div>
    <span>密码：</span>
    <div class="typein" style="margin-bottom:30px;">
    	<img src="images/ico_02.png"/>
    	<input type="password" name="MemberPass" value="" />
    </div>
    <div style="margin:0 auto; width:50%;">
    	<input type="submit" value="登录"/>
    </div>
</form>
</div>
<div class="a_reg">
	<img class="bg" src="images/login_01.jpg">
</div>
<div class="shift">
	<a href="register.php">注册新的登录账户</a>
</div>
<div class="a_link" style="display:none;">
	<div class="sepeteor"></div>
    <div class="link_main">
    	<a href="">关于我们</a>
        <a href=""  class="selected">平台优势</a>
        <a href="">媒体报道</a>
        <a href="">联系我们</a>
    </div>
    <div class="sepeteor"></div>
</div>

<?php require_once 'p.footer.php';?>

</body>
</html>