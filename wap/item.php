<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="gb2312">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<title>华东五金网</title>
		<link href="css/global.css" rel="stylesheet">
		<link href="css/goods.css" rel="stylesheet">
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/TouchSlide.1.1.js"></script>
	</head>
	<body>
		<div id="preview" class="preview">
			<div class="hd">
				<li><span>1/5</span></li>
				<li><span>2/5</span></li>
				<li><span>3/5</span></li>
				<li><span>4/5</span></li>
				<li><span>5/5</span></li>
			</div>
			<div class="bd">
				<ul>
					<li><img src="images/[Temp]20150622161545_75468.jpg" /></li>
					<li><img src="images/[Temp]20150622161927_54927.jpg" /></li>
					<li><img src="images/[Temp]20150622161931_32107.jpg" /></li>
					<li><img src="images/[Temp]20150622161935_46603.jpg" /></li>
					<li><img src="images/[Temp]20150622161545_75468.jpg" /></li>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			TouchSlide({ 
				slideCell:"preview",
				mainCell:".bd ul", 
				effect:"leftLoop", 
				autoPlay:false,
			});
		</script>
	</body>
</html>