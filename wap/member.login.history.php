<?php
$page_name='登录历史';
require_once 'include/init.php';
require_once YXS.'check.member.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>登录历史</title>
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
<div class="log_array">
    <ul>
	<?php	
$result=query("select DateTime,Content from member_log_tbl where MemberId='$MemberId' order by DateTime desc limit 50");
while($rows=fetch_array($result))
{
echo'<li><label>'.format_dt($rows[0],'%Y-%m-%d %H:%M').'</label><span>'.$rows[1].'</span></li>';
}
?>
    </ul>
</div>

<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>