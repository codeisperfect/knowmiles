<?php
function get($inp){
	if(isset($_GET[$inp]))
		return $_GET[$inp];
	else
		return false;
}

function post($inp){
	if(isset($_POST[$inp]))
		return $_POST[$inp];
	else
		return false;
}

function val($arr,$key,$add=array()){
	$add=Fun::mergeifunset($add,array("ret"=>""));
	if($arr!=null && isset($arr[$key]))
		return $arr[$key];
	else
		return $add["ret"];
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

?>