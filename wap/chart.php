<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>购物车</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
</head>
<body>
<?php require_once 'p.header.php';?>
<form action="" method="post">
<div class="cart_array">
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
        <li>
        	<label>
            	<img src="images/[Temp]20150625164316_29905.gif" />
            </label>
            <div class="cart_list">
            	<strong>CR-V尖尾棘轮扳手/快速扳手sdfsdfsd</strong>
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