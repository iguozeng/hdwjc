<?php
$page_name='��������';
require_once 'include/init.php';
require_once YXS.'global.class.php';
require_once YXS.'check.member.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>��������</title>
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
	<?php
		$result=query("select MemberName,RegDatetime,Points from member_tbl where MemberId='$MemberId';");
		if(num_rows($result)){
			$row=fetch_array($result);
			$MemberName=$row[0];
			$RegTime=$row[1];
			$Points=$row[2];
		}
	?>
    	<strong><?php echo $MemberName;?><label>VIP</label></strong>
        <span>ע��ʱ�䣺<?php echo format_dt($RegTime,'%Y-%m-%d');?></span>
        <span>���� <?php echo $Points;?></span>
    </div>
</div>
<div class="count_array">
	<a href="member.order.list.php?action=nopay">
    	<img src="images/ico_07.png">
        <span>������</span>
    </a>
    <a href="member.order.list.php?action=send">
    	<img src="images/ico_08.png">
        <span>���ջ�</span>
    </a>
    <a href="member.order.list.php">
    	<img src="images/ico_09.png">
        <span>�ҵĶ���</span>
    </a>
    </a>
</div>
<div class="partion"></div>
<div class="menu_array">
	<ul>
    	<li class="li_01">
        	<a href="">�˻����</a>
            <span> > </span>
        </li>
        <li class="li_02">
        	<a href="">���߳�ֵ</a>
            <span> > </span>
        </li>
        <li class="li_03">
        	<a href="">�ջ���ַ</a>
            <span> > </span>
        </li>
        <li class="li_04">
        	<a href="">�����޸�</a>
            <span> > </span>
        </li>
        <li class="li_05">
        	<a href="">��ʷ��¼</a>
            <span> > </span>
        </li>
    </ul>
</div>
<div class="partion"></div>
<div class="record_array">
	<ul>
    	<li>
        	<span>2015-09-26 <label>����ʡ̩����</label></span>
            <strong>��ʼ��������Ϣ(MXSO0000000109,MXSO0000000109)[�ƶ���]</strong>
        </li>
        <li>
        	<span>2015-09-26 <label>����ʡ̩����</label></span>
            <strong>��ʼ��������Ϣ(MXSO0000000109,MXSO0000000109)[�ƶ���]sssssssssssssssss</strong>
        </li>
        <li>
        	<span>2015-09-26 <label>����ʡ̩����</label></span>
            <strong>��ʼ��������Ϣ(MXSO0000000109,MXSO0000000109)[�ƶ���]</strong>
        </li>
    </ul>
</div>
</div>
<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>