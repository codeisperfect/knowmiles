<?php

if($config["calallcity"]){
	$_ginfo["allcitylist"]=Sql::getArray("select * from city order by Name");
	$_ginfo["allcity"]=Fun::dbarrtooption($_ginfo["allcitylist"],"CityID","Name");
	$_ginfo["allcityiddict"]=Fun::idtovalarr($_ginfo["allcitylist"],"CityID","Name");
}


$_ginfo["query"]=array();
$_ginfo["query"]["carmaps"]="select car.*,cartype.* from cartype left join (select CarID,CarTypeID from cardata group by CarID,CarTypeID)cartypemap on cartypemap.CarTypeID=cartype.CarTypeID left join car on car.CarID=cartypemap.CarID";


$_ginfo["page"]=curfilename();


?>