<?PHP
$type=($_GET['t'])?($_GET['t']):'png';
$width=($_GET['w'])?($_GET['w']):54;
$height=($_GET['h'])?($_GET['h']):22;
session_start();
Header("Content-type: image/".$type);
srand((double)microtime()*1000000);
$randval = sprintf("%04d", rand(0,9999));
$_SESSION['session_verify'] = $randval;
if ( is_array($_SESSION) ) { 
	$_SESSION['session_verify'] = $randval;
	$session_verify =$_SESSION['session_verify'];
} else { 
	$session_verify = $randval;
}
if ( $type!='gif' && function_exists('imagecreatetruecolor')) { 
	$im = @imagecreatetruecolor($width,$height);
} else { 
	$im = @imagecreate($width,$height);
}
$r = Array(225,255,255,223);
$g = Array(225,236,237,255);
$b = Array(225,236,166,125);
$key = rand(0,3);
$backColor = ImageColorAllocate($im, $r[$key],$g[$key],$b[$key]);//背景色（随机）
$borderColor = ImageColorAllocate($im, 255, 255, 255);//边框色
$pointColor = ImageColorAllocate($im, 255, 51, 153);//点颜色
@imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
@imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor);
$stringColor = ImageColorAllocate($im, 255,51,153);//字颜色
for($i=0;$i<=20;$i++){ //杂色
	$pointX = rand(2,$width-2);
	$pointY = rand(2,$height-2);
	@imagesetpixel($im, $pointX, $pointY, $pointColor);
}
@imagestring($im, 5, 8, 2, $randval, $stringColor);
$ImageFun='Image'.$type;
$ImageFun($im);
@ImageDestroy($im);
?> 