<?php
$page_name='�����޸�';
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
		msg("����ȷ������ʵ����","",1);
	}
	if(isnull($Linkman))
	{
		$errnum=true;
		msg("����ȷ�����ջ�������","",1);
	}
	if(isnull($Mobile))
	{
		$errnum=true;
		msg("����ȷ�����ջ����ֻ�����","",1);
	}
	if(isnull($Address))
	{
		$errnum=true;
		msg("����ȷ�����ջ��˽ֵ���ַ","",1);
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
		$strContent="�޸Ļ�Ա������Ϣ[�ƶ���]";
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
<title>�����޸�</title>
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
            	<dt>��Ա��Ϣ</dt>
                <dd>
                	<ul>
                    	<li><font>��Ա���</font><span><?php echo $MemberId;?></span></li>
                    	<li><font>΢�ű�ʶ</font><span><?php echo $MemberName;?></span></li>
                        <li><font>΢���ǳ�</font><span><input type="text" name="InfoNiName" value="<?php echo $InfoNiName;?>"></span></li>
                        <li><font>��ʵ����</font><span><input type="text" name="InfoName" value="<?php echo $InfoName;?>"></span></li>
                        <li><font>�ԡ�����</font><span><input type="radio" name="InfoSex" value="1"<?php if($InfoSex==1)echo'  checked';?>>��<input type="radio" name="InfoSex" value="0"<?php if($InfoSex==0)echo'  checked';?>>Ů</span></li>
                        <li><font>���ڵ���</font><span>
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
            	<dt>�ջ�����Ϣ</dt>
                <dd>
                	<ul>
                    	<li><font>�ջ���</font><span><input type="text" name="Linkman" value='<?php echo $Linkman;?>' placeholder="�ջ�����ʵ����������Ϊ��"></span></li>
                        <li><font>�ֻ�����</font><span><input type="text" name="Mobile" value='<?php echo $Mobile;?>' placeholder="�ջ����ֻ����룬����Ϊ��"></span></li>
                        <li><font>�绰����</font><span><input type="text" name="Tel" value='<?php echo $Tel;?>' placeholder="�ջ��������绰����"></span></li>
                        <li><font>���ڵ���</font><span><select id="province_select" name="ProvinceId" style="width:26%;">
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
                        <li><font>�ֵ���ַ</font><span><input type="text" name="Address" value='<?php echo $Address;?>' placeholder="�ջ�����ϸ��ַ������Ϊ��"></span></li>
                    </ul>
                </dd>
            </dl>
            <label><input type="submit" class="send_post" value="�ύ�޸�"></label>
        </form>
        </div>

<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>