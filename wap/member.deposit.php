<?php
$page_name='预存余额';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>预存余额</title>
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
<div class="deposit_profile">
    <span>预存款：<strong>￥0.00</strong></span>
    <span>1.账户预存余额是您在华东五金网留下的交易现金</span>
    <span>2.在订单结算时，您可根据需要选择使用您的支付余额</span>
    <label><a href="m_member.pay.php?type=free&num=100">立刻在线充值</a></label>
</div>
<div class="deposit_array">
    <ul><li><strong>支付购物订单</strong><span>存入：点，支出：0.01，时间：2015-09-23</span></li><li><strong>购物订单充值</strong><span>存入：0.01点，支出：，时间：2015-09-23</span></li><li><strong>支付购物订单</strong><span>存入：点，支出：0.01，时间：2015-09-23</span></li><li><strong>购物订单充值</strong><span>存入：0.01点，支出：，时间：2015-09-23</span></li><li><strong>支付购物订单</strong><span>存入：点，支出：0.01，时间：2015-09-23</span></li></ul>
</div>

<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>