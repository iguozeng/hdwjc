<?php
function send_mail($toMail,$toName,$title,$content,$filepath){
	$ret=0;  
	$mail=new PHPMailer();  
	$mail->IsSMTP();                  // send via SMTP  
	$mail->Host=SMTP_Host;   // SMTP servers  
	$mail->SMTPAuth=true;           // turn on SMTP authentication  
	$mail->Username=SMTP_Username;     // SMTP username     注意：普通邮件认证不需要加 @域名 
	$mail->Password=SMTP_Password;          // SMTP password  
	$mail->From=SMTP_FromMail;        // 发件人邮箱 
	$mail->FromName=SMTP_FromName;    // 发件人 
	//$mail->CharSet  = "GB2312";              // 这里指定字符集！ 
	//$mail->Encoding = "base64"; 
	$mail->AddAddress($toMail,$toName);    // 收件人邮箱和姓名 
	//$mail->AddReplyTo("263564@qq.com","qq.com");  //抄送给
	$mail->IsHTML(true);    // send as HTML             
	$mail->Subject="=?utf-8?B?".base64_encode($title)."?="; // 邮件主题 
	$mail->Body=$content;// 邮件内容
	//$mail->AltBody ="text/html";
	// 加附件
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