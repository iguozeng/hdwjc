<?php
$page_name='订单结算';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>订单结算</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
</head>
<body>
<?php require_once 'p.header.php';?>
<form action="" method="post">
<div class="address_array">
	<dl>
    	<dt>收货人信息</dt>
        <dd>
        	<ul>
            	<li>
                	<p>收货方式</p>
                    <span><select><option value="1">物流配送</option><option value="2">体验店自取</option><option value="3">仓库自取</option></select></span>
                </li>
                <li><p>收货人</p><span><input type="text" name="Linkman" value='' placeholder="收货人真实姓名，不能为空"></span></li>
                <li><p>手机号码</p><span><input type="text" name="Mobile" value='' placeholder="收货人手机号码，不能为空"></span></li>
                <li><p>电话号码</p><span><input type="text" name="Tel" value='' placeholder="收货人座机电话号码"></span></li>
                <li><p>所在地区</p><span><select id="province_select" name="ProvinceId"></select><select id="city_select" name="CityId"></select><select id="district_select" name="DistrictId"></select></span></li>
                <li style="border:0;"><p>街道地址</p><span><input type="text" name="Address" value='' placeholder="收货人详细地址，不能为空"></span></li>
            </ul>
        </dd>
        <dt>结算支付方式</dt>
        <dd>
            <ul>
                <li><p>结算类型</p><span><select name="PayClassId"><option value="1">在线支付</option></select></span></li>
                <li><p>帐户余额</p><span class="pay_money">￥</span></li> 
            </ul>
        </dd>
        <dt>订单编号：</dt>
    </dl>
</div>
<div class="cart_array" style="margin-top:5px; min-height:100px; border-top:0;">
	<ul>
    	<li>
        	<label>
            	<img src="images/[Temp]20150625164316_29905.gif" />
            </label>
            <div class="cart_list">
            	<strong>CR-V尖尾棘轮扳手/快速扳手出问题了</strong>
                <span>库存:100,得力 De＆LiDL4197</span>
                <h4>规格型号：xxxx</h4>
                <div class="modified">
                	<input type="button" class="input_btn" value="-" />
                    <input type="text" class="input_text" readonly value="12" />
                    <input type="button" class="input_btn" value="+" />
                </div>
            </div>
            <em class="off">×</em>
            <em class="price">&yen; 200.00</em>
        </li>
        <li>
        	<label>
            	<img src="images/[Temp]20150625164316_29905.gif" />
            </label>
            <div class="cart_list">
            	<strong>CR-V尖尾棘轮扳手/快速扳手</strong>
                <span>库存:100,得力 De＆LiDL4197</span>
                <h4>规格型号：xxxx</h4>
                <div class="modified">
                	<input type="button" class="input_btn" value="-" />
                    <input type="text" class="input_text" readonly value="12" />
                    <input type="button" class="input_btn" value="+" />
                </div>
            </div>
            <em class="off">×</em>
            <em class="price">&yen; 200.00</em>
        </li>

    </ul>
</div>
<div class="action_buy">
	<input type="button" class="buy_button" value="结 算">
    <span>合计金额：&yen; 213.00</span>
</div>
</form>
<?php require_once 'p.footer.php';?>
</body>
</html>