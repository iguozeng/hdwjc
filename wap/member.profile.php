<?php
$page_name='�����޸�';
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
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.m.ui.js"></script>
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
                    	<li><font>��Ա���</font><span>22</span></li>
                    	<li><font>΢�ű�ʶ</font><span>xxxxxxxx</span></li>
                        <li><font>΢���ǳ�</font><span><input type="text" name="InfoNiName" value=""></span></li>
                        <li><font>��ʵ����</font><span><input type="text" name="InfoName" value=""></span></li>
                        <li><font>�ԡ�����</font><span><input type="radio" name="InfoSex" value="1">��<input type="radio" name="InfoSex" value="0"  checked>Ů</span></li>
                        <li><font>���ڵ���</font><span><select id="info_province_select" name="InfoProvinceId"></select><select id="info_city_select" name="InfoCityId"></select><select id="info_district_select" name="InfoDistrictId"></select></span></li>
                    </ul>
                </dd>
            </dl>
            <dl>
            	<dt>�ջ�����Ϣ</dt>
                <dd>
                	<ul>
                    	<li><font>�ջ���</font><span><input type="text" name="Linkman" value='' placeholder="�ջ�����ʵ����������Ϊ��"></span></li>
                        <li><font>�ֻ�����</font><span><input type="text" name="Mobile" value='' placeholder="�ջ����ֻ����룬����Ϊ��"></span></li>
                        <li><font>�绰����</font><span><input type="text" name="Tel" value='' placeholder="�ջ��������绰����"></span></li>
                        <li><font>���ڵ���</font><span><select id="province_select" name="ProvinceId"></select><select id="city_select" name="CityId"></select><select id="district_select" name="DistrictId"></select></span></li>
                        <li><font>�ֵ���ַ</font><span><input type="text" name="Address" value='' placeholder="�ջ�����ϸ��ַ������Ϊ��"></span></li>
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