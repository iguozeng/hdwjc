<?php
$page_name='����֧��';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>����֧��</title>
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
<div class="pay_frame">
    <div class="pay_menu">
    <dl>
        <dt>֧���ӿ�</dt>
        <dd>
            <ul><li class="selected"><a href="m_member.pay.php?action=&type=free&order=&id=9">֧����</a></li></ul>
        </dd>
    </dl>
    </div>
    
    <div class="pay_array">
        <div class="pay_num">
        <span>֧����<strong>��100</strong></span>
        <font><label>��ֵ�ˣ��Ż���</label><label>���ͣ���ֵ����</label></font>
    </div>
    <div class="pay_cmf">ȷ�������ת��֧��������</div>
        <label><input type="submit" class="send_post" value="ȥ֧����֧��"></label>
</div>
<?php require_once 'slides.php';?>
<?php require_once 'p.footer.php';?>
</div>
</body>
</html>