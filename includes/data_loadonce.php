<?php

if($config["calallcity"]){
	$_ginfo["allcitylist"]=Sql::getArray("select * from city order by Name");
	$_ginfo["allcity"]=Fun::dbarrtooption($_ginfo["allcitylist"],"CityID","Name");
	$_ginfo["allcityiddict"]=Fun::idtovalarr($_ginfo["allcitylist"],"CityID","Name");
}
$_ginfo["page"]=curfilename();
$view_default["template/header.php"]["islogin"]=User::loginType();
$view_default["template/cablisting.php"]["islogin"]=User::loginType();

?>