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
			if(!(($sarr["users"]=="all" && User::islogin()) || $sarr["users"]=="" || ($sarr["users"] != "all" && in_array(User::loginType(), $sarr["users"])) ))
				return -2;
			if(!Fun::isAllSet($sarr["need"], $post_data))
				return -9;
		}
		return true;
	}

	function getmyneed($fname){
		global $_ginfo;
		return (islset($_ginfo, array("action_constrain", $fname, "need")) ? $_ginfo["action_constrain"][$fname]["need"]:array());
	}

	function autoscroll($post_data){
		global $_ginfo;
		$action_spec=$_ginfo["autoscroll"][$post_data["action"]];
		mergeifunset($action_spec, array('sort'=>'', 'maxl'=>null, 'minl'=>null, "filterfunc"=>null, "load_view"=>"template/".$post_data["action"].".php" ));
		$fixed=array("uid"=>User::loginId(), "time"=>time());
		$post_data=Fun::mergeforce($post_data, $fixed);
		$qoutput=Sqle::autoscroll($action_spec["query"], $post_data, $action_spec["key"], $action_spec["sort"], $post_data["isloadold"], $action_spec["minl"], $action_spec["maxl"]);
		if($action_spec["filterfunc"]!=null){
			$autos=new Autoscroll();
			$funcname=$action_spec["filterfunc"];
			if(method_exists($autos, $funcname))
				$qoutput=$autos->$funcname($qoutput);
		}
		$qoutput["action"]=$post_data["action"];
		$qoutput["load_view"]=$action_spec["load_view"];
		return $qoutput;
	}
	function handle_disp($post_data,$actionarg=null){
		global $_ginfo;
		if($actionarg!=null)
			$post_data["action"]=$actionarg;
		$a=new Actiondisp();
		$outp=array("ec"=>-7);
		if(isset($post_data["action"])  ){
			$isvalid=isvalid_action($post_data);
			if(!($isvalid>0))
				$outp["ec"]=$isvalid;
			else{
				$func=$post_data["action"];
				if( method_exists($a,$post_data["action"])){
					$a->$func($post_data,$actionarg==null);
					return;
				}
				else if(islset($_ginfo,array("autoscroll",$post_data["action"]))) {
					$as_handle = autoscroll($post_data);
					$outp["data"]=Fun::getflds(array("min", "max", "minl", "maxl", "qresultlen"), $as_handle);
					$outp["ec"]=1;
					if($actionarg==null)
						echo json_encode($outp)."\n";
					load_view($as_handle["load_view"], $as_handle);
					return;
				}
			}
		}
		if($actionarg==null)
			echo json_encode($outp)."\n";
	}

	function setifunset(&$data,$key,$val){
		if(!isset($data[$key]))
			$data[$key]=$val;
		return $data;
	}

	function mergeifunset(&$a,$b){
		$keys=array_keys($b);
		for($i=0;$i<count($keys);$i++){
			if(!isset($a[$keys[$i]]))
				$a[$keys[$i]]=$b[$keys[$i]];
		}
		return $a;
	}
	function myexplode($n,$st){
		$temp=explode($n,$st);
		return (count($temp)==1 && $temp[0]=="") ? array() : $temp;
	}
	function intexplode($ex,$inp){
		$temp=myexplode($ex,$inp);
		foreach($temp as $i=>$val){
			$temp[$i]=0+$val;
		}
		return $temp;
	}

	function handle_autodbrequest($post_data){
		global $_ginfo;
		$outp = array("ec" => -7);
		$fixvalues=array("time"=>time(),"uid"=>User::loginId());
		$id_data = Fun::getflds( getmyneed($post_data["action"]), $post_data );
		if(islset($_ginfo, array("autoinsert", $post_data["action"]))){
			$action_spec = Fun::mergeifunset( $_ginfo["autoinsert"][$post_data['action']], array("fixed" => array(), "add" => array(), "filter"=>null));
			if($action_spec["filter"] != null) {
				$filterdata = new Autoaction();
				$filterfunc = $action_spec["filter"];
				$id_data = $filterdata->$filterfunc($id_data);
			}
			$id_data = Fun::mergeifunset($id_data, $action_spec["add"]);
			$id_data = Fun::mergeforce($id_data, Fun::getflds( $action_spec["fixed"], $fixvalues ));
			$outp["data"] = Sqle::insertVal($action_spec['table'], $id_data);
			$outp["ec"] = 1;
		} else if(islset( $_ginfo, array("autodelete", $post_data["action"]) )) {
			$action_spec = Fun::mergeifunset( $_ginfo["autodelete"][$post_data['action']], array("match" => array()));
			$id_data = Fun::mergeforce( $id_data, Fun::getflds( $action_spec["match"], $fixvalues) );
			$outp["data"] = Sqle::deleteVal( $action_spec["table"], $id_data );
			$outp["ec"]=1;
		}
		return $outp;
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
					$outp = $b->$func($post_data);
				else {
					$outp = handle_autodbrequest($post_data);
				}
			}
		}
		return $outp;
	}
	function getr($inp) {//get one row of sql.
		return (count($inp)>0) ? $inp[0]:null;
	}

	function getrefarr(&$inp) {
	/*Returns the referenced array
	 Arguments: $inp: Input data array(passed by reference)
	*/    
		$outp=array();
		foreach($inp as $i=>$val){
			$outp[] = &$inp[$i];
		}
		return $outp;
	}

	function g($inp) {
		global $_ginfo;
		return $_ginfo[$inp];
	}

	function gtable($name, $alias=true) {
		global $_ginfo;
		return ($alias ? ("(".$_ginfo["query"][$name].") ".$name) : $_ginfo["query"][$name]);
	}

	function convchars($inp){
		$conv=array("&" => "&amp;", '"' => "&quot;", "'" => "&#039;", "<" => "&lt;", ">" => "&gt;");
		foreach($conv as $i => $val) {
			$inp=str_replace($i, $val, $inp);
		}
		return $inp;
	}
	function resizeimg($filename,$tosave, $max_width, $max_height){
		$imginfo=getimagesize($filename);
		list($orig_width, $orig_height) = $imginfo;
		$type=$imginfo[2];


		$crop_width=$orig_width;
		$crop_height=$orig_height;
		if($orig_width*$max_height <= $orig_height*$max_width){
			$crop_height=$orig_width*$max_height/$max_width;
		}
		else{
			$crop_width=$orig_height*$max_width/$max_height;
		}

		$image_p = imagecreatetruecolor($max_width, $max_height);
		switch($type){
			case "1": 
				$image = imagecreatefromgif($filename); 
				$transparent = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
				imagefill($image_p, 0, 0, $transparent);
				imagealphablending($image_p, true);         
				break;
			case "2": $image = imagecreatefromjpeg($filename);break;
			case "3": 
				$image = imagecreatefrompng($filename);
				imagealphablending($image_p, false);
				imagesavealpha($image_p, true);
				break;
			default:  $image = imagecreatefromjpeg($filename);
		}
		imagecopyresampled($image_p, $image, 0, 0, ($orig_width-$crop_width)/2, ($orig_height-$crop_height)/2, $max_width, $max_height, $crop_width, $crop_height);

		$ext=pathinfo($tosave, PATHINFO_EXTENSION);

		switch($ext){
			case "gif": imagegif($image_p,$tosave); break;
			case "jpg": imagejpeg($image_p,$tosave,100); break;
			case "jpeg": imagejpeg($image_p,$tosave,100); break;
			case "png": imagepng($image_p,$tosave,0);break;
			default: imagejpeg($image_p,$tosave,100);
		}
		chmod($tosave,0777);
	}


	function setift(&$var, $val, $istrue=true){
		if($istrue){
			$var = $val;
		}
	}

	function setifnn(&$var, $val) {
		setift($var, $val, $var==null);
	}

	function tf($inp=true) {
		return ($inp?"true":"false");
	}
	function rit($toprint, $cond=true, $toprint_false=''){
		if($cond)
			return $toprint;
		else
			return $toprint_false;
	}

	function makealnum($inp){
		$outp="";
		for($i=0; $i<strlen($inp); $i++){
			if(ctype_alnum($inp[ $i ])) {
				$outp.=$inp[$i];
			}
		}
		return $outp;
	}

	function arr2dataarr($inp = array()) {
		$outp = array();
		foreach( $inp as $i => $val) {
			$outp["data-".$i]=$val;
		}
		return $outp;
	}

	function f($content) {
		global $msvar;
		$af = function($inp, $ind) use ($content, $msvar) {
			$content = '$foutput  = '.$content.';';
			eval($content);
			return $foutput;
		};
		return $af;
	}

	function s($inp, $val=null) {
		global $$inp;
		$$inp = $val;
	}

	function gi($inp) {
		return getval($inp, g("_ginfo"));
	}

	function listget() {
		$args = func_get_args();
		$inplist = array_slice($args, 1);
		$outp = getval(0,$args);
		foreach($inplist as $i => $val) {
			$outp = getval( $val, $outp );
		}
		return $outp;
	}

	function gget() {
		$args = func_get_args();
		$args[0] = g(getval(0, $args));
		return call_user_func_array("listget", $args);
	}

	function giget() {
		$args = func_get_args();
		$args[0] = gi(getval(0, $args));
		return call_user_func_array("listget", $args);
	}
	
	function filter($list, $boolfunc) {
		$outp = array();
		foreach($list as $i => $val) {
			if($boolfunc($val) === true) {
				$outp[] = $val;
			}
		}
		return $outp;
	}

	function map($list ,$func, $custom=array()) {
		mergeifunset($custom, array("isindexed" => false, "ismapkey"=>false));
		$outp = array();
		foreach($list as $i => $val) {
			if($custom["ismapkey"] )
				$outp[ $func($i) ] = $val;
			else
				$outp[($custom["isindexed"]?$val:$i)] = $func($val, $i);
		}
		return $outp;
	}


	function add($a, $b) {
		if(gettype($a) == "array" && gettype($b) == "array" ) {
			return Fun::array_append($a, $b);
		} else if (gettype($a) == "array" && gettype($b) == "integer") {
			return Fun::array_addinall($a, $b);
		}
	}

	function msvalprint($inp) {//recursive function.
		if(gettype($inp) == "array") {
			$isnindex = (array_keys($inp) == Fun::oneToN(count($inp)-1, 0));//is natural indexed
			$otext = map(array_keys($inp), function($ind) use($isnindex, $inp) {
				return ($isnindex?"":"'".$ind."'=>").msvalprint($inp[$ind]);
			});
			return "array(".implode(", ", $otext).")";
		} else if(gettype($inp) == 'integer') {
			return $inp;
		} else {
			$inp = str_replace("'", "\\'", "".$inp);
			return "'".$inp."'";
		}
	}

	function msimplode($glue, $inp, $defval=null) {
		 return (count($inp) == 0 && $defval != null ) ? $defval : implode($glue, $inp);
	}

?>