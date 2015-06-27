<?php
$config=array('calallcity'=>true);
include "includes/app.php";


$carid=0+get("CarID");
$cid=0+get("cid", User::loginId());


$carinfo=Funs::getCarInfo($carid, $cid);

Fun::redirectinv($carinfo == null);
$carinfo = Funs::headerinfo($carinfo);


$namelist=array(1=>"Ola Cabs",2=>"TexiForSure");
$offers=array(1=>"offer.jpg",2=>"tfsoffer1.png");

$pageinfo["cabtypes"] = Funs::mycartypes($carinfo['carid']);

load_view( "company.php", Fun::mergeifunset($pageinfo, array("cityolist"=>$_ginfo["allcity"],"myf"=>$carinfo)) );



closedb();
?>