<?php
$page_name='档案修改';
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
            	<dt>会员信息</dt>
                <dd>
                	<ul>
                    	<li><font>会员编号</font><span>22</span></li>
                    	<li><font>微信标识</font><span>xxxxxxxx</span></li>
                        <li><font>微信昵称</font><span><input type="text" name="InfoNiName" value=""></span></li>
                        <li><font>真实姓名</font><span><input type="text" name="InfoName" value=""></span></li>
                        <li><font>性　　别</font><span><input type="radio" name="InfoSex" value="1">男<input type="radio" name="InfoSex" value="0"  checked>女</span></li>
                        <li><font>所在地区</font><span><select id="info_province_select" name="InfoProvinceId"></select><select id="info_city_select" name="InfoCityId"></select><select id="info_district_select" name="InfoDistrictId"></select></span></li>
                    </ul>
                </dd>
            </dl>
            <dl>
            	<dt>收货人信息</dt>
                <dd>
                	<ul>
                    	<li><font>收货人</font><span><input type="text" name="Linkman" value='' placeholder="收货人真实姓名，不能为空"></span></li>
                        <li><font>手机号码</font><span><input type="text" name="Mobile" value='' placeholder="收货人手机号码，不能为空"></span></li>
                        <li><font>电话号码</font><span><input type="text" name="Tel" value='' placeholder="收货人座机电话号码"></span></li>
                        <li><font>所在地区</font><span><select id="province_select" name="ProvinceId"></select><select id="city_select" name="CityId"></select><select id="district_select" name="DistrictId"></select></span></li>
                        <li><font>街道地址</font><span><input type="text" name="Address" value='' placeholder="收货人详细地址，不能为空"></span></li>
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