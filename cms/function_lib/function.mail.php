<?php
function send_mail($toMail,$toName,$title,$content,$filepath){
	$ret=0;  
	$mail=new PHPMailer();  
	$mail->IsSMTP();                  // send via SMTP  
	$mail->Host=SMTP_Host;   // SMTP servers  
	$mail->SMTPAuth=true;           // turn on SMTP authentication  
	$mail->Username=SMTP_Username;     // SMTP username     ע�⣺��ͨ�ʼ���֤����Ҫ�� @���� 
	$mail->Password=SMTP_Password;          // SMTP password  
	$mail->From=SMTP_FromMail;        // ���������� 
	$mail->FromName=SMTP_FromName;    // ������ 
	//$mail->CharSet  = "GB2312";              // ����ָ���ַ����� 
	//$mail->Encoding = "base64"; 
	$mail->AddAddress($toMail,$toName);    // �ռ������������ 
	//$mail->AddReplyTo("263564@qq.com","qq.com");  //���͸�
	$mail->IsHTML(true);    // send as HTML             
	$mail->Subject="=?utf-8?B?".base64_encode($title)."?="; // �ʼ����� 
	$mail->Body=$content;// �ʼ�����
	//$mail->AltBody ="text/html";
	// �Ӹ���
	if(!isnull($filepath))
	{
		$mail->AddAttachment($filepath);
	}
	//$mail->Send();
	if(!$mail->Send())
	{
		$ret=$mail->ErrorInfo;
	}
	else
	{
		$ret=1;
	}
	return $ret;
}

function mail_msgbox($c,$m,$u,$p){
	$ret=$c;
	$ret=str_replace('${LoginName}',$u,$ret);
	$ret=str_replace('${Password}',$p,$ret);
	$ret=str_replace('${Site_URL}',Site_URL,$ret);
	$ret=str_replace('${Gbk_Site_Name}',Site_Name,$ret);
	$ret=str_replace('${MemberClass}',$m,$ret);
	return $ret;
}
?>