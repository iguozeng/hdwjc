<?php
class mail_class
{
	var $SmtpHost='smtp.97rc.com';    						//���ͼ���� 
	var $Mail='service@97rc.com';     						//�����ʼ���ַ 
	var $Username='service@97rc.com'; 						//SMTP��֤���û���
	var $Password='123cnj';          						//SMTP��֤������
	var $To='';                      						//�������ʼ���ַ
	var $From='�����˲���';           						//����������
	var $Subject='��ӭʹ�ñ�������';  						//�ʼ�����
	var $Body='��ӭ��ʹ�ñ����������Ǳȳ�ŵ���ĸ��ã�';   //�ʼ�����
	var $Err='';											//���ʹ�����Ϣ
	
	public function __construct()
	{
		$this->_inti();
	}
	
	private function _inti()
	{
		
	}
	public function Send(){
		$hasErr=false;
		$headers="Content-Type: text/html; charset=\"gb2312\"\r\nContent-Transfer-Encoding: base64"; 
		$lb="\r\n";
		$hdr=explode($lb,$headers);
		if($this->Body){
			$Content=preg_replace("/^\./","..",explode($lb,$this->Body));
		}
		else
		{
			$Content='��ӭ��ʹ�ñ����������Ǳȳ�ŵ���ĸ��ã�';
		}
		$smtp=array(
			array("EHLO ".$this->SmtpHost.$lb,"220,250","HELO error: "), 
			array("AUTH LOGIN".$lb,"334","AUTH error:"), 
			array(base64_encode($this->Username).$lb,"334","AUTHENTIFICATION error : "), 
			array(base64_encode($this->Password).$lb,"235","AUTHENTIFICATION error : ")
		); 
		$smtp[]=array("MAIL FROM: <".$this->Mail.">".$lb,"250","MAIL FROM error: "); 
		$smtp[]=array("RCPT TO: <".$this->To.">".$lb,"250","RCPT TO error: "); 
		$smtp[]=array("DATA".$lb,"354","DATA error: "); 
		$smtp[]=array("From: ".$this->From."<".$this->Mail.">".$lb,"",""); 
		$smtp[]=array("To: ".$this->To.$lb,"",""); 
		$smtp[]=array("Subject: ".$this->Subject.$lb,"",""); 
		foreach($hdr as $h)
		{
			$smtp[]=array($h.$lb,"","");
		} 
		$smtp[]=array($lb,"",""); 
		if($Content){ 
			foreach($Content as $b){$smtp[] = array(base64_encode($b.$lb).$lb,"",""); }
		} 
		$smtp[]=array(".".$lb,"250","DATA(end)error: "); 
		$smtp[]=array("QUIT".$lb,"221","QUIT error: "); 
		$fp = @fsockopen($this->SmtpHost,25); 
		if(!$fp)
		{
			$hasErr=true;
			$this->Err="Error: Cannot conect to ".$this->SmtpHost.""; 
		}
		else
		{
			while($result=@fgets($fp,1024)){ 
				if(substr($result,3,1)==" "){break;} 
			}
			foreach($smtp as $req) { 
				@fputs($fp,$req[0]); 
				if($req[1]){ 
					while($result = @fgets($fp, 1024)){ 
						if(substr($result,3,1)==" "){break;} 
					} 
					if(!strstr($req[1],substr($result,0,3)))
					{
						$result_str.=$req[2].$result.""; 
					}
				}
			} 
			if($result_str!="")
			{
				$hasErr=true;
				$this->Err=$result_str;
			}
		}
		@fclose($fp); 
		if (!$hasErr)
		{
			return true;
		}
		else
		{
			return false;
		} 
	}
}
?>