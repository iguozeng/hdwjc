<?php
/*
read_file ��ȡָ���ļ�������
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
wirte_file ������д��һ���ļ�
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
del_file ɾ��һ���ļ�
*/
function del_file($file){ 
	if(file_exists($file))unlink($file);
} 

/*
copy_file ����һ���ļ�
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
rename_file �ƶ����߸���һ���ļ���Ŀ¼
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
ex_file �ж�һ���ļ��Ƿ����
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
get_img ��ʾ�ϴ���ͼƬ
*/
function get_img($file,$msize=PicDisplaySize){ 
	$msize=str2int($msize);
	if(ex_file($file)){
		$filesize=str2int(abs(filesize(PicPath.$file)));
		$maxsize=1024*$msize; //Ĭ��Ϊ200K
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
mk_dir �½�Ŀ¼
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
chk_dir ��·���з���Ŀ¼
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
del_dir Ŀ¼ɾ��
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
get_dir_dize ��ȡ����Ŀ¼��С
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
format_file_size ��ʽ���ļ���С
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
file_chk ����ļ���ʽ�Ƿ�Ϸ�
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
get_u_file_ext ��ȡ�ϴ��ļ��ĸ�ʽ
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
get_file_ext ��ȡform���ļ��ĸ�ʽ
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
 * ����HTML�����ȡword�ĵ�����
 * ����һ������Ϊmht���ĵ����ú���������ļ����ݲ���Զ������ҳ���е�ͼƬ��Դ
 * �ú�����������MhtFileMaker
 * �ú��������img��ǩ����ȡsrc������ֵ�����ǣ�src������ֵ���뱻���Ű�Χ����������ȡ
 * 
 * @param string $content HTML����
 * @param string $absolutePath ��ҳ�ľ���·�������HTML�������ͼƬ·��Ϊ���·������ô����Ҫ��д������������øú����Զ���ɾ���·����������������Ҫ��/����
 * @param bool $isEraseLink �Ƿ�ȥ��HTML�����е�����
 */
function getWordDocument($content ,$absolutePath="", $isEraseLink=true )
{
    $mht = new MhtFileMaker();
    if ($isEraseLink)
        $content = preg_replace('/<a\s*.*?\s*>(\s*.*?\s*)<\/a>/i' , '$1' , $content);   //ȥ������
 
    $images = array();
    $files = array();
    $matches = array();
    //����㷨Ҫ��src�������ֵ����ʹ������������
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
                    //�������ӣ�����ǰ׺
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
