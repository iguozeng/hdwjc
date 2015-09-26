<?php
/*
msg 信息提示
*/
function msg($msg,$href='',$mode='') {
	echo "<html><meta http-equiv=Content-Type content=text/html; charset=gb2312>\n";
	echo "<head><title>" . $msg . "</title>\n";
	echo "<style type='text/css'>\n";
	echo ".button_h{cursor:pointer;background-image: url(../images/button_submit_1.gif);border-top-style: none;border-right-style: none;border-left-style: none;border-bottom-style: none;text-align:center;color:#666;width:66px;height:23px}\n";
	echo "</style>\n";
	echo "</head>\n";
	echo "<body leftmargin='0' topmargin='0'>\n";
	echo "<table border='0' cellpadding='0' cellspacing='0' width='100%' height='100%'>\n";
	echo "<tr>\n";
	echo "<td width='100%' align=center valign='top' style='padding-top:120px;'>\n";
	echo "<table border='0' cellpadding='0' cellspacing='0' width='60%' align=center>\n";
	echo "<tr>\n";
	echo "<td width='100%' bgcolor='#ACDEF1' height='5' colspan='2'></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td colspan='2' height='2'></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=100% bgcolor=#DFF7FF style='color: #000000; font-family: Arial; font-size: 14px; font-weight:bold' valign=bottom height=60 align=center><br>　" . $msg . "</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=100% bgcolor=#DFF7FF valign=bottom height=100 align='right'>\n";
	switch ($mode){	
		case "0":
			echo "<SCRIPT>\nalert('".$msg."');\nwindow.opener=null;\nwindow.close();\n</SCRIPT>\n";
			break;
		case "1":
			echo "<input type=button value=返回 class=button_h onclick='javascript:history.back(1)'>\n";
			break;
		case "2":
			echo "<input type=button value=返回 class=button_h onclick=window.open('".$href."','_self')>\n";
			break;
		case "3":
			echo "<SCRIPT>alert('".$msg."');this.location.href='".$href."';</SCRIPT>\n";
			break;
		case "4":
			header("Location:$href");
			break;
		default:
			echo "<SCRIPT>alert('".$msg."');\nwindow.location='javascript:history.back(1)';</SCRIPT>\n";
			break;
	}	
	echo "</td></tr>\n";
	echo "<tr>\n";
	echo "<td colspan='2' height='2'></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width='100%' bgcolor='#ACDEF1' height='5' colspan='2'></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</body>\n";
	echo "</html>";
	exit;
}

/*dialog页头*/
function htmlhead(){
	$str='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><link type="text/css" rel="stylesheet" href="/css/dialog.css" /><style type="text/css">*{margin:0;padding:0}html{border:0}body,div,dl,dt,dd,ul,ol,li,pre,code,form,fieldset,legend,input,textarea,blockquote,th,td,p,font{font-size:12px;color:#000;font-family:Arial,"宋体";line-height:22px}</style></head><body>';
	return $str;
}
?>