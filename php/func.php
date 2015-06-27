<?php
	function jshref($url=""){
		return "window.location.href='$url'";
	}
	function sessm($key,$val){
		return (isset($_SESSION[$key]) && $_SESSION[$key]==$val);
	}
	function init_db(){
		global $DB,$db_data;
		if($DB==null){
			$DB = new mysqli( $db_data['host'] , $db_data['user'] , $db_data['pass'] , $db_data['db']);
			Sql::init($DB);
		}
	}
	function closedb(){
		global $DB;
		if($DB!=null)
			$DB->close();
	}
	function getval($key,$arr,$default=null){
		 return (isset($arr[$key]) ? $arr[$key] : $default );
	}
	function post($key,$default=null){
		return getval($key,$_POST,$default);
	}
	function isget($key){
		return isset($_GET[$key]);
	}
	function ispost($key){
		return isset($_POST[$key]);
	}
	function isses($key){
		return isset($_SESSION[$key]);
	}
	function get($key,$default=null){
		return getval($key,$_GET,$default);
	}
	function sets($key,$val){
		$_SESSION[$key]=$val;
	}
	function gets($key){
		return $_SESSION[$key];
	}
	function load_view($view,$inp=array()){
		global $view_default,$_ginfo;
		if(isset($view_default[$view]))
			$inp=Fun::mergeifunset($inp,$view_default[$view]);
		$inp=Fun::setifunset($inp,"page",$_ginfo["page"]);
		$inp=Fun::setifunset($inp,"islogin", User::loginType());
		foreach($inp as $key=>$val){
			$$key=$val;
		}
		$view="php/views/".$view;
		if(file_exists($view))
			include $view;
		else
			echo "MM Error : Unable to load view ".$view." Line ".__LINE__." in file ".__FILE__ ;
	}
	function str2json($inp){
		$temp=json_decode($inp);
		if($temp)
			return (array)$temp;
		else
			return null;
	}

	function arr2option($arr, $type='intval'){
		$outp=array();
		for($i=0; $i<count($arr); $i++) {
			if($type == 'firstchar' ){
				$val=strtolower($arr[$i][0]);
			} else if( $type=='intval' ) {
				$val = $i+1;
			} else {
				$val = $arr[$i];
			}
			$outp[] = array('disptext'=>$arr[$i],'val'=> $val);
		}
		return $outp;
	}
	function lastelm($arr){
		if(count($arr)==0)
			return null;
		else
			return $arr[count($arr)-1];
	}
	function firstelm($arr){
		if(count($arr)==0)
			return null;
		else
			return $arr[0];
	}
	function curfilename(){
		$cfname=firstelm(explode(".",lastelm(explode("/",$_SERVER['SCRIPT_FILENAME']))));
		if($cfname=='')
			$cfname="index";
		return $cfname;
	}
	function rquery($str,$data){
		preg_match_all("|{[^}]+}|U",$str,$matches);
		$matches=$matches[0];
		for($i=0;$i<count($matches);$i++){
			$key=substr($matches[$i],1,strlen($matches[$i])-2);
			$str=str_replace($matches[$i],$data[$key],$str);
		}
		return $str;
	}
	function cleanstr($inp){
		$inp=str_replace('"', "", $inp);
		$inp=str_replace("'", "", $inp);
		return $inp;
	}

	function errormsg($ec, $cnd=true) {
		global $_ginfo;
		return (($ec<0 && $cnd) ?getval($ec, $_ginfo["error"], "Error : ".$ec):"");
	}

	function islset($data, $arr) {
	/*Checks whether the required keys value are set or not in given data
	 Arguments: $data: Input data array
							$arr: array of keys 
	*/    
		for($i = 0;$i<count($arr);$i++){
			if(!isset($data[$arr[$i]]))
				return false;
			$data = $data[$arr[$i]];
		}
		return true;
	}

	function isloginin($inp='') {
		return in_array(User::loginType(), gettype($inp)=='string' ? str_split($inp) : $inp );
	}

	function isvalid_action($post_data) {
	/*Checks whether all the fields in post data are set or not according to g_info["action_constraint"] requirements
	 Arguments: $post_data: Input data array
	*/
 
		global $_ginfo;
		if(isset($_ginfo["action_constrain"][$post_data["action"]])){
			$sarr=$_ginfo["action_constrain"][$post_data["action"]];
			$sarr=Fun::mergeifunset($sarr,array("users"=>"","need"=>array()));
			if(!(($sarr["users"]=="all" && User::islogin()) || $sarr["users"]=="" || in_array(User::loginType(), $sarr["users"]) ))
				return -2;
			if(!Fun::isAllSet($sarr["need"], $post_data))
				return -9;
		}
		return true;
	}
	function handle_request($post_data) {
		global $_ginfo;
		$b=new Actions();
		if(User::isloginas('s'))
			$a=new Students();
		else if(User::isloginas('a'))
			$a=new Admin();
		else if(User::isloginas('t'))
			$a=new Teachers();
		else
			$a=$b;
		$outp=array("ec"=>-7);
		if(isset($post_data["action"])  ){
			$isvalid=isvalid_action($post_data);
			if(!($isvalid>0))
				$outp["ec"]=$isvalid;
			else{
				$func=$post_data["action"];
				if( method_exists($a,$post_data["action"]))
					$outp=$a->$func($post_data);
				else if( method_exists($b,$post_data["action"]))
					$outp=$b->$func($post_data);
				else if(islset($_ginfo,array("autoinsert",$post_data["action"]))) {
					$action_spec=$_ginfo["autoinsert"][$post_data["action"]];
					$action_spec=Fun::mergeifunset($action_spec,array("fixed"=>array(),"add"=>array()));
					$ins_data=Fun::getflds(getmyneed($post_data["action"]) , $post_data );
					$ins_data=Fun::mergeifunset($ins_data,$action_spec["add"]);
					$fixvalues=array("time"=>time(),"uid"=>User::loginId());
					foreach($action_spec["fixed"] as $i=>$val){
						$ins_data[$val]=$fixvalues[$val];
					}
					$outp["data"]=Sqle::insertVal($action_spec["table"],$ins_data);
					$outp["ec"]=1;
				}
			}
		}
		return $outp;
	}


?>