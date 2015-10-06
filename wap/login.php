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
		msg("����ȷ�����¼�ʺ�","",1);
	}
	if(isnull($MemberPass))
	{
		$errnum=true;
		msg("����ȷ�����¼����","",1);
	}
	if(isnull($CmfMemberPass))
	{
		$errnum=true;
		msg("����ȷ����ȷ������","",1);
	}
	if($MemberPass!=$CmfMemberPass)
	{
		$errnum=true;
		msg("�������벻ͳһ","",1);
	}
	if(isnull($Name))
	{
		$errnum=true;
		msg("����ȷ������ʵ����","",1);
	}
	if(isnull($Moblie))
	{
		$errnum=true;
		msg("����ȷ�����ֻ�����","",1);
	}
	if(!$errnum)
	{
		$result =query("select MemberId from member_tbl where MemberName='$MemberName' and (MemberId>0 and MemberId is not null)");
		if(num_rows($result)){$errnum=true;msg("��¼�ʺ��Ѵ��ڣ���ѡ�������ʺ�","",2);}
	}
	if (!$errnum)
	{
		$RegisterPoints=str2int(RegisterPoints);
		$MemberPass=md5($MemberPass);
		$MemberClassId=1;
		$result =query("select MemberClassId from member_class_tbl order by MemberClassId limit 1");
		if(num_rows($result)){$row =fetch_array($result);$MemberClassId=$row[0];}
		/*����ע����Ϣ*/
		query("insert into member_tbl(MemberName,MemberPass,MemberClassId,Points,`UnLock`,RegIp,RegDatetime) values
		('$MemberName','$MemberPass','$MemberClassId','$RegisterPoints','1','$Postip','$Posttime')");
		$MemberId=insert_id();
		/*������ϵ����Ϣ*/
		query("insert into member_info_tbl(MemberId,NiName,Name)values('$MemberId','$MemberName','$Name')");
		query("insert into member_address_tbl(MemberId,Linkman,Mobile)values('$MemberId','$Name','$Moblie')");
		$strContent="ע���»�Ա[�ƶ���]";
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
		msg("����ȷ�����¼�ʺ�","",1);
	}
	if(isnull($MemberPass))
	{
		$errnum=true;
		msg("����ȷ�����¼����","",1);
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
			$strContent="��Ա��¼ϵͳ[�ƶ���]";
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
			msg("��¼�ʺŻ��¼�������","",1);	
		}
	}
	return false;
};
if($action=='new')
{
	$Title='ע���ʺ�';
}else{
	$Title='��¼ϵͳ';
}
$global->HeaderTitle=$Title;

$page_name='�û���¼';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>�û���¼</title>
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
	<span>�û�����</span>
    <div class="typein">
    	<img src="images/ico_01.png"/>
    	<input type="text" name="MemberName" value="" />
    </div>
    <span>���룺</span>
    <div class="typein" style="margin-bottom:30px;">
    	<img src="images/ico_02.png"/>
    	<input type="password" name="MemberPass" value="" />
    </div>
    <div style="margin:0 auto; width:50%;">
    	<input type="submit" value="��¼"/>
    </div>
</form>
</div>
<div class="a_reg">
	<img class="bg" src="images/login_01.jpg">
</div>
<div class="shift">
	<a href="register.php">ע���µĵ�¼�˻�</a>
</div>
<div class="a_link" style="display:none;">
	<div class="sepeteor"></div>
    <div class="link_main">
    	<a href="">��������</a>
        <a href=""  class="selected">ƽ̨����</a>
        <a href="">ý�屨��</a>
        <a href="">��ϵ����</a>
    </div>
    <div class="sepeteor"></div>
</div>

<?php require_once 'p.footer.php';?>

</body>
</html>