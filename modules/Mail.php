<?php
class Mail extends Sql{
	public static function sendmail($data){
		if($data==null)
			$data=array();
		$data=Fun::setifunset($data,"to","mohitsaini1196@gmail.com");
		$data=Fun::setifunset($data,"from","mohitsaini1196@gmail.com");
		$data=Fun::setifunset($data,"subject","Untitled mail by mohit");
		$data=Fun::setifunset($data,"body","This is not filled body of mail.");
		$timenow=time();
		$fn="/tmp/newmail_".$data["to"]."_".$timenow;
		$content=$data["to"]."\n".$data["from"]."\n".$data["subject"]."\n".$data["body"]."\n";
		file_put_contents($fn , $content );
		chmod($fn ,0777);
		return 1;//sent
	}


}
?>
