<?php
class  API_sms_class
{
	var $APIURL; //地址
	var $APIUSER; //用户名
	var $APIPASS; //密码
	var $SendNumber; //手机号码，多个号码用英文逗号","分隔
	var $SendBody; //短信内容，限70字，UTF-8编码
	
	public function __construct()
	{
		$this->APIURL="http://www.sms71.com/WebAPI/SmsAPI.asmx/SendSms";
		$this->APIUSER="ztkj";
		$this->APIPASS="123abc";
		$this->SendBody="您好，测试一下！";
	}
	
	public function Send(){
		$SMSBody=iconv("gbk","utf-8",$this->SendBody);
		$SMSData="user=$this->APIUSER&pwd=$this->APIPASS&mobiles=$this->SendNumber&contents=$SMSBody";
		$Result=$this->do_post_request($this->APIURL,$SMSData);
		return $Result;
	}
	
	function do_post_request($url,$data,$optional_headers =null)
	{
		$params = array('http' => array(
				  'method' => 'POST',
				  'content' => $data
			   ));
		if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			echo "err : $url, $php_errormsg";exit;
		}
		$response = @stream_get_contents($fp);
		if ($response === false) {
			echo "err for data : $url, $php_errormsg";exit;
		}
		return $response;
	}
}
?>