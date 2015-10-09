<?php
$page_name='采购订单详情';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>采购订单详情</title>
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
<div class="order_head">
    <ul>
        <li><font>订单编号</font><span></span></li>
        <li><font>合计金额</font><span>￥</span></li>
        <li><font>订单时间</font><span></span></li>
    </ul>
</div>
<div class="clear"></div>
<div class="order_workflow"><label class="nodata">×&nbsp;订单已关闭</label></div>
<div class="clear"></div>
<div style="background:#fff;min-height:300px;">
<div class="pay_array">
    <dl>
        <dt>结算支付方式</dt>
        <dd>
            <ul>
                <li><span style="color:#F30"></span></li>
            </ul>
        </dd>
    </dl>
</div>
</div>
<div class="clear"></div>
<div class="address_array">
    <dl>
        <dt>收货人信息</dt>
        <dd>
            <ul>
                <li><font>收货方式</font><span></span></li>
                <li><font>收货人</font><span></span></li>
                <li><font>手机号码</font><span></span></li>
                <li><font>电话号码</font><span></span></li>
                <li><font>街道地址</font><span></span></li>
            </ul>
        </dd>
    </dl>
</div>
<div class="send_array">
    <dl>
        <dt>配送信息</dt>
        <dd></dd>
    </dl>
</div>
<div class="orders_list">
    <dl>
        <dt>订单明细</dt>
        <dd>
            <ul></ul>
        </dd>
    </dl>
</div>

<?php require_once 'p.footer.php';?>
</div>
</body>
</html>