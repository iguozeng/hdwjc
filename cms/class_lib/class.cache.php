<?php
class Cache {
   /**
    * $dir : �����ļ����Ŀ¼
    * $lifetime : �����ļ���Ч��,��λΪ��
    * $cacheid : �����ļ�·��,�����ļ���
   */
   private $dir="./cache/";
   private $lifetime=null;
   private $cacheid=null;
   function __construct($dir,$cacheid,$lifetime=1200) {
       if ($this->dir_isvalid($dir)){
           $this->dir = $dir;
           $this->lifetime = $lifetime;
		   if(!$cacheid){
			   $this->cacheid = $this->getcacheid();
		   }else{
			   $this->cacheid = $cacheid;
		   }
       }
   }
   /**
    * ��黺���Ƿ���Ч
   */
   private function isvalid(){
	   $val=true;
       if(!file_exists($this->cacheid))$val=false;
       if(!(@$mtime=filemtime($this->cacheid)))$val=false;
       if((mktime()-$mtime)>$this->lifetime)$val=false;
       return $val;
   }
   /**
    * д�뻺��
    * $mode == 0 , �����������ķ�ʽȡ��ҳ������
    * $mode == 1 , ��ֱ�Ӹ�ֵ(ͨ��$content��������)�ķ�ʽȡ��ҳ������
    * $mode == 2 , �Ա��ض�ȡ(fopen ile_get_contents)�ķ�ʽȡ��ҳ������(�ƺ����ַ�ʽûʲô��Ҫ)
   */
   public function write($mode=0,$content='') {
       switch ($mode) {
           case 0:
               $content=ob_get_contents();
               break;
           default:
               break;
       }
       ob_end_flush();
       try {
           file_put_contents($this->cacheid,$content);
       }
       catch (Exception $e) {
           $this->error('д�뻺��ʧ��!����Ŀ¼Ȩ��!');
       }
   }
   /**
    * ���ػ���
    * exit() ���뻺�����ֹԭҳ������ִ��,������Ч������ԭҳ��������ɻ���
    * ob_start() �������������������ҳ���β��ȡ��ҳ������
   */
   public function load(){
       if ($this->isvalid()) {
		   //echo '���������'.$this->cacheid;
           require_once($this->cacheid);exit();
       }
       else {
           ob_start();
       }
   }
   /**
    * �������
   */
   public function clean() {
       try {
           unlink($this->cacheid);
       }
       catch (Exception $e) {
           $this->error('��������ļ�ʧ��!����Ŀ¼Ȩ��!');
       }
   }
   /**
    * ȡ�û����ļ�·��
   */
   private function getcacheid(){return $this->dir.md5($this->geturl()).".txt";}
   /**
    * ���Ŀ¼�Ƿ���ڻ��Ƿ�ɴ���
    */
   private function dir_isvalid($dir) {
       if (is_dir($dir)) return true;
       try {
           mkdir($dir,0777);
       }
       catch (Exception $e) {
             $this->error('���趨����Ŀ¼�����ڲ��Ҵ���ʧ��!����Ŀ¼Ȩ��!');
             return false;            
       }
       return true;
   }
   /**
    * ȡ�õ�ǰҳ������url
   */
   private function geturl() {
       $url = '';
       if (isset($_SERVER['REQUEST_URI'])) {
           $url = $_SERVER['REQUEST_URI'];
       }
       else {
           $url = $_SERVER['Php_SELF'];
           $url .= empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'];
       }
       return $url;
   }
   /**
    * ���������Ϣ
   */
   private function error($str){echo '<div style="color:red;">'.$str.'</div>';}
}
?>