<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>用户注册</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
</head>
<body>
<?php require_once 'p.header.php';?>
<div class="reg">
<form action="" method="post"> 
	<table cellpadding="0" cellspacing="8">
    	<tr>
        	<td class="td_left"><em>*</em>登录帐号：</td>
            <td class="td_right">
            	<div class="td_01">
                	<input type="text" name="" value="">
                </div>
            </td>
        </tr>
        <tr>
        	<td><em>*</em>登录密码：</td>
            <td>
            	<div class="td_02">
            	<input type="password" name="" value="">
                </div>
            </td>
        </tr>
        <tr>
        	<td><em>*</em>确认密码：</td>
            <td>
                <div class="td_03">
                    <input type="password" name="" value="">
                </div>
            </td>
        </tr>
        <tr>
        	<td><em>*</em>真实姓名：</td>
            <td>
            	<div class="td_04">
            	<input type="text" name="" value="">
                </div>
            </td>
        </tr>
        <tr>
        	<td><em>*</em>手机号码：</td>
            <td>
            	<div class="td_05">
            	<input type="text" name="" value="">
                </div>
            </td>
        </tr>
    </table>
    <div class="login_button">
    	<input type="submit" value="登录"/>
    </div>
</form>
</div>	
<div class="a_reg">
	<img class="bg" src="images/login_01.jpg">
</div>
<div class="shift">
	<a href="login.php">用已有账户进行登录</a>
</div>
<?php require_once 'p.footer.php';?>
</body>
</html>