<?php
	include_once( 'includes/setting.php' ) ;
	include_once( 'includes/data.php' ) ;
	include_once( 'includes/password.php' ) ;

	ini_set('display_errors', 'on');
	ini_set('error_reporting', E_ALL);
	date_default_timezone_set('Asia/Calcutta');

	function loadModule($className){
		$inside=array('Td'=>'Table','Row'=>'Table','Text'=>'Table', "Special"=>"Fun" );
		if(isset($inside[$className]))
			$className=$inside[$className];
		if(file_exists(ROOT.'modules/'.$className.'.php'))
			require_once(ROOT.'modules/'.$className.'.php');
	}
	spl_autoload_register('loadModule');
	include "php/func.php";

	if(!isset($config))
		$config=array();
	$config=Fun::mergeifunset($config,array("session_start"=>true,"set_session_id"=>0,'calallcity'=>false, "addccode"=>true));

	if($config["session_start"])
		@session_start();
	else if($config["session_start"]!=0)
		session_id($config["set_session_id"]);

	if(!isses("city"))
		sets("city",9);


	include_once( 'includes/data_loadonce.php' );
	include_once('includes/initdb.php');
	include "php/display.php";
	include "php/specf_display.php";
	if($config["addccode"]){
		include "includes/ccode.php";
	}



?>