<?php
$page_name='��������';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>��������</title>
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
    	<dt>�ջ�����Ϣ</dt>
        <dd>
        	<ul>
            	<li>
                	<p>�ջ���ʽ</p>
                    <span><select><option value="1">��������</option><option value="2">�������ȡ</option><option value="3">�ֿ���ȡ</option></select></span>
                </li>
                <li><p>�ջ���</p><span><input type="text" name="Linkman" value='' placeholder="�ջ�����ʵ����������Ϊ��"></span></li>
                <li><p>�ֻ�����</p><span><input type="text" name="Mobile" value='' placeholder="�ջ����ֻ����룬����Ϊ��"></span></li>
                <li><p>�绰����</p><span><input type="text" name="Tel" value='' placeholder="�ջ��������绰����"></span></li>
                <li><p>���ڵ���</p><span><select id="province_select" name="ProvinceId"></select><select id="city_select" name="CityId"></select><select id="district_select" name="DistrictId"></select></span></li>
                <li style="border:0;"><p>�ֵ���ַ</p><span><input type="text" name="Address" value='' placeholder="�ջ�����ϸ��ַ������Ϊ��"></span></li>
            </ul>
        </dd>
        <dt>����֧����ʽ</dt>
        <dd>
            <ul>
                <li><p>��������</p><span><select name="PayClassId"><option value="1">����֧��</option></select></span></li>
                <li><p>�ʻ����</p><span class="pay_money">��</span></li> 
            </ul>
        </dd>
        <dt>������ţ�</dt>
    </dl>
</div>
<div class="cart_array" style="margin-top:5px; min-height:100px; border-top:0;">
	<ul>
    	<li>
        	<label>
            	<img src="images/[Temp]20150625164316_29905.gif" />
            </label>
            <div class="cart_list">
            	<strong>CR-V��β���ְ���/���ٰ��ֳ�������</strong>
                <span>���:100,���� De��LiDL4197</span>
                <h4>����ͺţ�xxxx</h4>
                <div class="modified">
                	<input type="button" class="input_btn" value="-" />
                    <input type="text" class="input_text" readonly value="12" />
                    <input type="button" class="input_btn" value="+" />
                </div>
            </div>
            <em class="off">��</em>
            <em class="price">&yen; 200.00</em>
        </li>
        <li>
        	<label>
            	<img src="images/[Temp]20150625164316_29905.gif" />
            </label>
            <div class="cart_list">
            	<strong>CR-V��β���ְ���/���ٰ���</strong>
                <span>���:100,���� De��LiDL4197</span>
                <h4>����ͺţ�xxxx</h4>
                <div class="modified">
                	<input type="button" class="input_btn" value="-" />
                    <input type="text" class="input_text" readonly value="12" />
                    <input type="button" class="input_btn" value="+" />
                </div>
            </div>
            <em class="off">��</em>
            <em class="price">&yen; 200.00</em>
        </li>

    </ul>
</div>
<div class="action_buy">
	<input type="button" class="buy_button" value="�� ��">
    <span>�ϼƽ�&yen; 213.00</span>
</div>
</form>
<?php require_once 'p.footer.php';?>
</body>
</html>