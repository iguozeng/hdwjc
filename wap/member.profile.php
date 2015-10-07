<?php
$page_name='档案修改';
require_once 'include/init.php';
$strAction=$_POST['action'];
if($strAction=='send')event_send();
function event_send(){
	$errnum=false;
	$MemberId=str2int($_SESSION["MemberId"]);
	$InfoName=str_putdata($_POST['InfoName']);
	$InfoNiName=str_putdata($_POST['InfoNiName']);
	$InfoSex=str2int($_POST['InfoSex']);
	$InfoProvinceId=str2int($_POST['InfoProvinceId']);
	$InfoCityId=str2int($_POST['InfoCityId']);
	$InfoDistrictId=str2int($_POST['InfoDistrictId']);
	$Linkman=str_putdata($_POST['Linkman']);
	$Mobile=str_putdata($_POST['Mobile']);
	$Tel=str_putdata($_POST['Tel']);
	$ProvinceId=str2int($_POST['ProvinceId']);
	$CityId=str2int($_POST['CityId']);
	$DistrictId=str2int($_POST['DistrictId']);
	$Address=str_putdata($_POST['Address']);
	if(isnull($InfoName))
	{
		$errnum=true;
		msg("请正确输入真实姓名","",1);
	}
	if(isnull($Linkman))
	{
		$errnum=true;
		msg("请正确输入收货人姓名","",1);
	}
	if(isnull($Mobile))
	{
		$errnum=true;
		msg("请正确输入收货人手机号码","",1);
	}
	if(isnull($Address))
	{
		$errnum=true;
		msg("请正确输入收货人街道地址","",1);
	}
	if (!$errnum)
	{
		$strSQL="update member_info_tbl set NiName='$InfoNiName',Name='$InfoName',Sex='$InfoSex',ProvinceId='$InfoProvinceId',CityId='$InfoCityId',DistrictId='$InfoDistrictId' where MemberId='$MemberId';";
		$hasAddress=false;
		$result=query("select MemberId from member_address_tbl where IsRoot=1 and MemberId='$MemberId'");
		if(num_rows($result))$hasAddress=true;
		if(!$hasAddress)
		{
			$strSQL.="insert into member_address_tbl(MemberId,ProvinceId,CityId,DistrictId,Linkman,Mobile,Tel,Address,IsRoot)values
			('$MemberId','$ProvinceId','$CityId','$DistrictId','$Linkman','$Mobile','$Tel','$Address',1);";
		}else{
			$strSQL.="update member_address_tbl set Linkman='$Linkman',Mobile='$Mobile',Tel='$Tel',ProvinceId='$ProvinceId',CityId='$CityId',DistrictId='$DistrictId',Address='$Address' where IsRoot=1 and MemberId='$MemberId';";
		}
		array_query($strSQL);
		$strContent="修改会员资料信息[移动端]";
		insert_member_log($strContent,$MemberId,1);
		header("Location:m_member.profile.php");
	}
	return false;
};
$NickName=$_COOKIE['NickName'];
$UserFace=$_COOKIE['UserFace'];
$result=query("select Name,NiName,Sex,ProvinceId,CityId,DistrictId from member_info_tbl where MemberId='$MemberId'");
if(num_rows($result)){
	$row=fetch_array($result);
	$InfoName=$row[0];
	$InfoNiName=$row[1];
	$InfoSex=str2int($row[2]);
	$InfoProvinceId=str2int($row[3]);
	$InfoCityId=str2int($row[4]);
	$InfoDistrictId=str2int($row[5]);
}
$result=query("select Linkman,Address,PostCode,Tel,Mobile,ProvinceId,CityId,DistrictId from member_address_tbl where IsRoot=1 and MemberId='$MemberId'");
if(num_rows($result)){
	$row=fetch_array($result);
	$Linkman=$row[0];
	$Address=$row[1];
	$PostCode=$row[2];
	$Tel=$row[3];
	$Mobile=$row[4];
	$ProvinceId=str2int($row[5]);
	$CityId=str2int($row[6]);
	$DistrictId=str2int($row[7]);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>档案修改</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
<script language="javascript">var idPage="member.orders";</script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery.ui.js" type="text/javascript"></script>
<script src="js/jquery.m.ui.js" type="text/javascript"></script>
<script language="javascript">
$(function($){
	$.getSelectarea("#info_province_select:<?php echo str2int($InfoProvinceId);?>","#info_city_select:<?php echo str2int($InfoCityId);?>","#info_district_select:<?php echo str2int($InfoDistrictId);?>");
	$.getSelectarea("#province_select:<?php echo str2int($ProvinceId);?>","#city_select:<?php echo str2int($CityId);?>","#district_select:<?php echo str2int($DistrictId);?>");
});
</script>
</head>
<body>
<div class="warmp">
<?php require_once 'p.header.php';?>
<div class="profile_array">
        <form name="profileform" method="post"><input type="hidden" name="action" value="send" />
        <input type="hidden" name="bcakurl" value='' />
        	<dl>
            	<dt>会员信息</dt>
                <dd>
                	<ul>
                    	<li><font>会员编号</font><span><?php echo $MemberId;?></span></li>
                    	<li><font>微信标识</font><span><?php echo $MemberName;?></span></li>
                        <li><font>微信昵称</font><span><input type="text" name="InfoNiName" value="<?php echo $InfoNiName;?>"></span></li>
                        <li><font>真实姓名</font><span><input type="text" name="InfoName" value="<?php echo $InfoName;?>"></span></li>
                        <li><font>性　　别</font><span><input type="radio" name="InfoSex" value="1"<?php if($InfoSex==1)echo'  checked';?>>男<input type="radio" name="InfoSex" value="0"<?php if($InfoSex==0)echo'  checked';?>>女</span></li>
                        <li><font>所在地区</font><span>
							<select id="info_province_select" name="InfoProvinceId" style="width:26%;">
							<?php
								$result=query("select ProvinceId,ProvinceName from province_tbl order by ProvinceId");
								if(num_rows($result)){
									$strResult="[";
									while($row=fetch_array($result))
									{
										$strResult.="{'id':'$row[0]','name':'$row[1]'},";
									}
									$strResult.="]";
								}?>
							</select>
							<select id="info_city_select" name="InfoCityId" style="width:26%;"></select>
							<select id="info_district_select" name="InfoDistrictId" style="width:23%;"></select>
						</span></li>
                    </ul>
                </dd>
            </dl>
            <dl>
            	<dt>收货人信息</dt>
                <dd>
                	<ul>
                    	<li><font>收货人</font><span><input type="text" name="Linkman" value='<?php echo $Linkman;?>' placeholder="收货人真实姓名，不能为空"></span></li>
                        <li><font>手机号码</font><span><input type="text" name="Mobile" value='<?php echo $Mobile;?>' placeholder="收货人手机号码，不能为空"></span></li>
                        <li><font>电话号码</font><span><input type="text" name="Tel" value='<?php echo $Tel;?>' placeholder="收货人座机电话号码"></span></li>
                        <li><font>所在地区</font><span><select id="province_select" name="ProvinceId" style="width:26%;">
						<?php
							$result=query("select ProvinceId,ProvinceName from province_tbl order by ProvinceId");
							if(num_rows($result)){
								$strResult="[";
								while($row=fetch_array($result))
								{
									$strResult.="{'id':'$row[0]','name':'$row[1]'},";
								}
								$strResult.="]";
							}?>
						</select><select id="city_select" name="CityId" style="width:26%;"></select><select id="district_select" name="DistrictId" style="width:23%;"></select></span></li>
                        <li><font>街道地址</font><span><input type="text" name="Address" value='<?php echo $Address;?>' placeholder="收货人详细地址，不能为空"></span></li>
                    </ul>
                </dd>
            </dl>
            <label><input type="submit" class="send_post" value="提交修改"></label>
        </form>
        </div>

<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>