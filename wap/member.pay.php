<?php
$page_name='在线支付';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>在线支付</title>
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
<div class="pay_frame">
    <div class="pay_menu">
    <dl>
        <dt>支付接口</dt>
        <dd>
            <ul><li class="selected"><a href="m_member.pay.php?action=&type=free&order=&id=9">支付宝</a></li></ul>
        </dd>
    </dl>
    </div>
    
    <div class="pay_array">
        <div class="pay_num">
        <span>支付金额：<strong>￥100</strong></span>
        <font><label>充值人：张华芳</label><label>类型：充值订单</label></font>
    </div>
    <div class="pay_cmf">确认无误后转向支付宝付款</div>
        <label><input type="submit" class="send_post" value="去支付宝支付"></label>
</div>
<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>