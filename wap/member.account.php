<?php
$page_name='历史账单';
require_once 'include/init.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>历史账单</title>
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
<div class="account_array">
            <ul>
			<?php	
				$result=query("select AddTime,LinkOrderId,Remark,OutAmount from running_account_tbl where OutAmount>0 and MemberId='$MemberId' $strWhere order by AddTime desc limit 50");
				while($row=fetch_array($result))
				{
				echo'<li><strong>'.$row['Remark'].'</strong><span>金额：'.$row['OutAmount'].'，'.$row['LinkOrderId'].'，产生时期：'.format_dt($row['AddTime'],'%Y-%m-%d').'</span></li>';
				}
			?>
            	
            </ul>
        </div>

<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>