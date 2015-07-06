<?php
$config=array('calallcity'=>true);
include "includes/app.php";


$cid=0+get("cid", User::loginId());

$carinfo = Funs::getCarInfo($cid);

Fun::redirectinv($carinfo == null);

$carinfo = Funs::headerinfo($carinfo);

	
$myf=User::myprofile();
$pageinfo["myf"] = $myf;
$pageinfo["cabtypes"] = Funs::mycartypes($carinfo['carid']);

load_view( "company.php", Fun::mergeifunset($pageinfo, array("cityolist"=>$_ginfo["allcity"],"carinfo"=>$carinfo)) );



closedb();
?>