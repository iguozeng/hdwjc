<?php
$page_name='个人中心';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>个人中心</title>
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
<div class="info_profile">
	<img src="images/profile_bg.jpg" class="bg">
    <div class="top_profile">
    	<strong>五金网会员<label>VIP</label></strong>
        <span>注册时间：2015-03-26</span>
        <span>积分 0</span>
    </div>
</div>
<div class="count_array">
	<a href="">
    	<img src="images/ico_07.png">
        <span>待结算</span>
    </a>
    <a href="">
    	<img src="images/ico_08.png">
        <span>待结算</span>
    </a>
    <a href="">
    	<img src="images/ico_09.png">
        <span>待结算</span>
    </a>
</div>
<div class="partion"></div>
<div class="menu_array">
	<ul>
    	<li class="li_01">
        	<a href="">账户余额</a>
            <span> > </span>
        </li>
        <li class="li_02">
        	<a href="">在线充值</a>
            <span> > </span>
        </li>
        <li class="li_03">
        	<a href="">收货地址</a>
            <span> > </span>
        </li>
        <li class="li_04">
        	<a href="">档案修改</a>
            <span> > </span>
        </li>
        <li class="li_05">
        	<a href="">历史记录</a>
            <span> > </span>
        </li>
    </ul>
</div>
<div class="partion"></div>
<div class="record_array">
	<ul>
    	<li>
        	<span>2015-09-26 <label>江苏省泰州市</label></span>
            <strong>初始化订单信息(MXSO0000000109,MXSO0000000109)[移动端]</strong>
        </li>
        <li>
        	<span>2015-09-26 <label>江苏省泰州市</label></span>
            <strong>初始化订单信息(MXSO0000000109,MXSO0000000109)[移动端]sssssssssssssssss</strong>
        </li>
        <li>
        	<span>2015-09-26 <label>江苏省泰州市</label></span>
            <strong>初始化订单信息(MXSO0000000109,MXSO0000000109)[移动端]</strong>
        </li>
    </ul>
</div>
</div>
<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>