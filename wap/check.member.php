<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified:".gmdate("D, d M Y H:i:s")."GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pramga: no-cache"); 
@set_time_limit(0);

/*
$_SESSION["MemberId"]=124;
$_SESSION['MemberName']='om2e3wYAkuQNW5jVBBDV4mqJlVRI';
$_SESSION['MemberPass']='af9f769d875fc131075a24934f08b478';
$MemberId=str2int($_SESSION["MemberId"]);
//*/

$ReUrl="http://".AppSiteUrl."/oauth.php?url=".$Url;
$OauthUrl="login.php";

if($MemberId>0)
{
	$hadLogin=true;
	$rel=query("select MemberId,MemberName,MemberPass,`UnLock`,IdNumber,Deposit,Points,(select Name from member_info_tbl where MemberId=member_tbl.MemberId) as NickName from member_tbl where MemberName='".$_SESSION['MemberName']."' and (AgentId=0 and MemberId>0 and MemberId is not null)");
	if(num_rows($rel)){
		$rs=fetch_array($rel);
		if($rs[1]!=$_SESSION["MemberName"])$hadLogin=false;
		if($rs[2]!=$_SESSION["MemberPass"])$hadLogin=false;
		if($rs[3]==0)$hadLogin=false;
	} else $hadLogin=false;
	if (!$hadLogin){
		header("Location:".$OauthUrl);
	}else{
		$MemberId=$rs[0];
		$MemberName=$rs[1];
		$IdNumber=$rs[4];
		$Deposit=$rs[5];
		$Points=$rs[6];
		$NickName=$rs[7];
	}
}else{
	header("Location:".$OauthUrl);
}
?>