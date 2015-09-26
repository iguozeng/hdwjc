<?php
/*
read_file 获取指定文件数据流
*/
function read_file($file){
	@set_time_limit(0);
	$fp=@fopen($file, "r");
	if($fp){
		while(!feof($fp)){
			@set_time_limit(0);
			$data=@fgets($fp,2048);
			if(!$data)break;
			$return.= $data;
		}
		//$return = @iconv("gb2312", "utf-8", $return);
		fclose($fp);
		return $return;
	}else{
		fclose($fp);
		return false;
	}
} 

/*
wirte_file 将数据写入一个文件
*/
function wirte_file($file,$str){ 
	@set_time_limit(0);
	$fp=@fopen($file,"w");
	if(@fwrite($fp,$str)){ 
		fclose($fp);
		return true;
	}else{
		fclose($fp);
		return false;
	}
} 

/*
del_file 删除一个文件
*/
function del_file($file){ 
	if(file_exists($file))unlink($file);
} 

/*
copy_file 复制一个文件
*/
function copy_file($old_file,$new_file){ 
	if(file_exists($old_file)){
		copy($old_file,$new_file);
		return true;
	}else{
		return false;
	}
} 

/*
rename_file 移动或者更名一个文件或目录
*/
function rename_file($old_file,$new_file){ 
	if(file_exists($old_file)){
		rename($old_file,$new_file);
		return true;
	}else{
		return false;
	}
} 

/*
ex_file 判断一个文件是否存在
*/
function ex_file($file,$path=PicPath){ 
	if(!isnull($file))
	{
		if(!isnull($path))$file=$path.$file;
		//echo $file;exit;
		if(file_exists($file)){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
} 

/*
get_img 显示上传的图片
*/
function get_img($file,$msize=PicDisplaySize){ 
	$msize=str2int($msize);
	if(ex_file($file)){
		$filesize=str2int(abs(filesize(PicPath.$file)));
		$maxsize=1024*$msize; //默认为200K
		if($filesize<=$maxsize)
		{
			$str='http://'.PicUrl.'/'.$file;
		}else{
			$str='/images/unkownpic.gif';
		}
	}else{
		$str='/images/nopic.gif';
	}
	return $str;
} 

/*
mk_dir 新建目录
*/
function mk_dir($directory,$mode=0777){
    $arr_path=explode('/',$directory);
    foreach ($arr_path as $value){
        if(!empty($value)){
            if(empty($tm_path))$tm_path=$value;
            else $tm_path.='/'.$value;
            is_dir($tm_path) or mkdir($tm_path,$mode) or chmod($tm_path,$mode);
        }
    }
    if(is_dir($directory))return true;
    return false;
}

/*
chk_dir 从路径中返回目录
*/
function val_url($path,$cls){
	if(str_left($path,1)=="/")$path=substr($path,1,str_len($path));
	if(str_left($path,2)=="./")$path=substr($path,2,str_len($path));
	if(str_left($path,3)=="../")$path=substr($path,3,str_len($path));
	$arr_path=explode('/',$path);
	$count_path=count($arr_path);
	if($cls=="d")
	{
		$count_path=$count_path-1;
		for($i=0;$i<$count_path;$i++){
			if(!isnull($arr_path[$i]))$tempval.='/'.$arr_path[$i];
		}
	}
	else
	{
		$tempval=$arr_path[$count_path-1];
	}
	return $tempval;
}

/*
del_dir 目录删除
*/
function del_dir($directory){ 
	$mydir=dir($directory); 
	while(@$file=$mydir->read()){ 
		if((is_dir("$directory/$file"))&&($file!=".")&&($file!="..")){ 
			del_dir("$directory/$file"); 
		}else{ 
			if(($file!=".")&&($file!=".."))@unlink("$directory/$file");
		}
	}
	$mydir->close();
	@rmdir($directory);
}

/*
get_dir_dize 获取整个目录大小
*/
function get_dir_dize($dir)
{ 
	$sizeResult=0;
	$handle = opendir($dir);
	while (false!==($FolderOrFile = readdir($handle)))
	{ 
		if($FolderOrFile != "." && $FolderOrFile != "..") 
		{ 
			if(is_dir("$dir/$FolderOrFile"))
			{ 
				$sizeResult += getDirSize("$dir/$FolderOrFile"); 
			}
			else
			{ 
				$sizeResult += filesize("$dir/$FolderOrFile"); 
			}
		}    
	}
	closedir($handle);
	return $sizeResult;
}

/*
format_file_size 格式化文件大小
*/
function format_file_size($size)
{ 
	$kb = 1024;         // Kilobyte
	$mb = 1024 * $kb;   // Megabyte
	$gb = 1024 * $mb;   // Gigabyte
	$tb = 1024 * $gb;   // Terabyte
	
	if($size < $kb)
	{ 
		return $size." B";
	}
	else if($size < $mb)
	{ 
		return round($size/$kb,2)." KB";
	}
	else if($size < $gb)
	{ 
		return round($size/$mb,2)." MB";
	}
	else if($size < $tb)
	{ 
		return round($size/$gb,2)." GB";
	}
	else
	{ 
		return round($size/$tb,2)." TB";
	}
}

/*
file_chk 检查文件格式是否合法
*/
function file_chk($file,$arr_type){
	$tempval=false;
	$array_Type=explode(',',$arr_type); 
	foreach($array_Type as $value){
		if($file['type']==$value){
			$tempval=true;
		}
	}
	return $tempval;
}

/*
get_u_file_ext 获取上传文件的格式
*/
function get_u_file_ext($file){
	$tempval="";
	switch($file){
		case "image/pjpeg":
			$tempval='jpg';
			break;
		case "image/jpeg":
			$tempval='jpg';
			break;
		case "image/gif":
			$tempval='gif';
			break;
		case "image/png":
			$tempval='png';
			break;
		case "image/x-png":
			$tempval='png';
			break;
		case "image/png":
			$tempval='png';
			break;
		default:
			$tempval='steam';
			break;
	}
	return $tempval;
}

/*
get_file_ext 获取form中文件的格式
*/
function get_f_file_ext($file){
	$tempval="";
	if(!empty($file)&&!isnull($file)){
		$Array_type=explode('.',$file); 
		$tempval=$Array_type[count($Array_type)-1]; 
	}
	return $tempval;
}

/**
 * 根据HTML代码获取word文档内容
 * 创建一个本质为mht的文档，该函数会分析文件内容并从远程下载页面中的图片资源
 * 该函数依赖于类MhtFileMaker
 * 该函数会分析img标签，提取src的属性值。但是，src的属性值必须被引号包围，否则不能提取
 * 
 * @param string $content HTML内容
 * @param string $absolutePath 网页的绝对路径。如果HTML内容里的图片路径为相对路径，那么就需要填写这个参数，来让该函数自动填补成绝对路径。这个参数最后需要以/结束
 * @param bool $isEraseLink 是否去掉HTML内容中的链接
 */
function getWordDocument($content ,$absolutePath="", $isEraseLink=true )
{
    $mht = new MhtFileMaker();
    if ($isEraseLink)
        $content = preg_replace('/<a\s*.*?\s*>(\s*.*?\s*)<\/a>/i' , '$1' , $content);   //去掉链接
 
    $images = array();
    $files = array();
    $matches = array();
    //这个算法要求src后的属性值必须使用引号括起来
    if ( preg_match_all('/<img[.\n]*?src\s*?=\s*?[\"\'](.*?)[\"\'](.*?)\/>/i',$content ,$matches ) )
    {
        $arrPath = $matches[1];
        for ( $i=0;$i<count($arrPath);$i++)
        {
            $path = $arrPath[$i];
            $imgPath = trim( $path );
            if ( $imgPath != "" )
            {
                $files[] = $imgPath;
                if( substr($imgPath,0,7) == 'http://')
                {
                    //绝对链接，不加前缀
                }
                else
                {
                    $imgPath = $absolutePath.$imgPath;
                }
                $images[] = $imgPath;
            }
        }
    }
    $mht->AddContents("tmp.html",$mht->GetMimeType("tmp.html"),$content);
    for ( $i=0;$i<count($images);$i++)
    {
        $image = $images[$i];
        if ( @fopen($image , 'r') )
        {
            $imgcontent = @file_get_contents( $image );
            if ( $content )
                $mht->AddContents($files[$i],$mht->GetMimeType($image),$imgcontent);
        }
       // else
        //{
        //    echo "file:".$image." not exist!<br />";
       // }
    }
    return $mht->GetFile();
}

function array2xml($array){ 
	$xml="<?xml version=\"1.0\" encoding=\"gb2312\"?>\n"; 
	$xml.="<Result>\n";
	foreach ($array as $arr) { 
		foreach ($arr as $key=>$val){
			//if(preg_match("/([x81-xfe][x40-xfe])/",$val,$match))$val=iconv('gbk','utf-8',$val);
			$xml.="<$key>".str_input2data($val)."</$key>\n";
		}
	}
	$xml.="</Result>";
    return $xml; 
}
?>
