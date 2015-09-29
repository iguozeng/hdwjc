<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>用户登录</title>
<meta charset="gb2312">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<link href="css/global.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet">
</head>
<body>
<?php require_once 'p.header.php';?>
<div class="wrapper loginform">
<form action="" method="post">
	<span>用户名：</span>
    <div class="typein">
    	<img src="images/ico_01.png"/>
    	<input type="text" name="" value="" />
    </div>
    <span>密码：</span>
    <div class="typein" style="margin-bottom:30px;">
    	<img src="images/ico_02.png"/>
    	<input type="text" name="" value="" />
    </div>
    <div style="margin:0 auto; width:50%;">
    	<input type="submit" value="登录"/>
    </div>
</form>
</div>
<div class="a_reg">
	<img class="bg" src="images/login_01.jpg">
    <a href=""><img class="bg" src="images/login_02.jpg"></a>
</div>
<div class="a_link">
	<div class="sepeteor"></div>
    <div class="link_main">
    	<a href="">关于我们</a>
        <a href=""  class="selected">平台优势</a>
        <a href="">媒体报道</a>
        <a href="">联系我们</a>
    </div>
    <div class="sepeteor"></div>
</div>
<?php require_once 'p.footer.php';?>

</body>
</html>