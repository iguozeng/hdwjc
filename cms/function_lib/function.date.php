<?php
function dateadd($part,$n,$date){ 
	$val=date("Y-m-d H:i:s");
	switch($part)
	{
		case "y": $val = date("Y-m-d H:i:s", strtotime($date ." +$n year")); break;
		case "m": $val = date("Y-m-d H:i:s", strtotime($date ." +$n month")); break;
		case "w": $val = date("Y-m-d H:i:s", strtotime($date ." +$n week")); break;
		case "d": $val = date("Y-m-d H:i:s", strtotime($date ." +$n day")); break;
		case "h": $val = date("Y-m-d H:i:s", strtotime($date ." +$n hour")); break;
		case "n": $val = date("Y-m-d H:i:s", strtotime($date ." +$n minute")); break;
		case "s": $val = date("Y-m-d H:i:s", strtotime($date ." +$n second")); break;
	}
	return $val;
} 

function datediff($part,$date1,$date2){ 
	$val=0;
	switch ($part) {
		case 's':$dividend = 1;break;
		case 'i':$dividend = 60;break;
		case 'h':$dividend = 60 * 60;break;
		case 'd':$dividend = 60 * 60 * 24;break;
		case 'w':$dividend = 60 * 60 * 24 * 7;break;
		case 'm':$dividend = 60 * 60 * 24 * 30;break;
		case 'y':$dividend = 60 * 60 * 24 * 365;break;
		default:$dividend = 1;
	}
	$time1=strtotime($date1);
	$time2=strtotime($date2);
	if ($time1&&$time2){
		$val=(float)($time1-$time2)/$dividend;
	}
	return $val;
} 

function format_dt($string, $format='%b %e, %Y', $default_date=null)
{
	$tTime=date("Y-m-d H:i:s");
    if(substr(PHP_OS,0,3)=='WIN')
	{
	   $_win_from=array ('%e','%T','%D');
	   $_win_to=array ('%#d','%H:%M:%S','%m/%d/%y');
	   $format=str_replace($_win_from, $_win_to, $format);
    }
    if(!strIsnull($string))
	{
        return strftime($format,smarty_make_timestamp($string));
    }
	elseif (isset($default_date) && $default_date != '')
	{
        return strftime($format,smarty_make_timestamp($default_date));
    }
	else
	{
        return $tTime;
    }
}

function smarty_make_timestamp($string)
{
	$tTime=time();
    if(empty($string)){
        $string="now";
    }
    $time=strtotime($string);
    if (is_numeric($time) && $time != -1)
        return $time;
    if (PReg_match('/^\d{14}$/', $string)) {
        $time = mktime(substr($string,8,2),substr($string,10,2),substr($string,12,2),
               substr($string,4,2),substr($string,6,2),substr($string,0,4));
        return $time;
    }
    $time = (int) $string;
    if ($time > 0)
	{
        return $time;
	}
    else
	{
        return $tTime;
	}
}

function strIsnull($str) {
	$tempval=true;
	$str = str_replace("　","",$str);
	$str = str_replace(" ","",$str);
	$str = str_replace(chr(32),"",$str);
	$str = str_replace(chr(161),"",$str);
	if(($str!==' ')&&$str!=='&nbsp;'&&$str!=='')$tempval=false;
	return $tempval;
}

function date2week($date,$mode=0)
{
	$string=0;
	$rt=date("w", strtotime($date));
	if($mode!=0)
	{
		switch($rt)
		{
			case 0:
				$string='星期天';
				break;
			case 6:
				$string='星期六';
				break;	
			case 5:
				$string='星期五';
				break;	
			case 4:
				$string='星期四';
				break;
			case 3:
				$string='星期三';
				break;
			case 2:
				$string='星期二';
				break;
			case 1:
				$string='星期一';
				break;
		}
	}else $string=$rt;
	return $string;
}
?>
