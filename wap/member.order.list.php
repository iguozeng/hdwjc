<?php
$page_name='������ѯ';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>������ѯ</title>
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
<div class="orders_statu">
	<ul>
    	<li><a href="member.order.list.php?action=nopay">������</a></li>
        <li><a href="member.order.list.php?action=send">���ջ�</a></li>
        <li><a href="member.order.list.php" class="selected">���ж���</a></li>
    </ul>
</div>
<div class="orders_list">
	<ul>
    	<li>
        	<div class="array_title">
            	<span>�µ�ʱ��:2015-06-01 18:45:11</span>
                <a href="">ȡ������</a>
            </div>
            <div class="array_column">
            	<strong>
                	<span>������ţ�1654564545545</span>
                	<label>�ܶ<em>&yen;1156455.00</em></label>
                </strong>
                <span class="status">����״̬��������</span>
                <div class="array_pic">
                	<a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                </div>
            </div>
        </li>
        <li>
        	<div class="array_title">
            	<span>�µ�ʱ��:2015-06-01 18:45:11</span>
                <a href="">ȡ������</a>
            </div>
            <div class="array_column">
            	<strong>
                	<span>������ţ�1654564545545</span>
                	<label>�ܶ<em>&yen;1156455.00</em></label>
                </strong>
                <span class="status">����״̬��������</span>
                <div class="array_pic">
                	<a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                    <a href=""><img src="images/[Temp]20150625164316_29905.gif"></a>
                </div>
            </div>
        </li>
    </ul>
</div>
<?php require_once 'slides.php';?>
<div class="action_buy">
	<input type="button" class="buy_button" value="�� ��">
    <span>�ϼƽ�&yen; 213.00</span>
</div>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>