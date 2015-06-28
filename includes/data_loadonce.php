<?php

if($config["calallcity"]){
	$_ginfo["allcitylist"]=Sql::getArray("select * from city order by Name");
	$_ginfo["allcity"]=Fun::dbarrtooption($_ginfo["allcitylist"],"CityID","Name");
	$_ginfo["allcityiddict"]=Fun::idtovalarr($_ginfo["allcitylist"],"CityID","Name");
}


$_ginfo["query"]=array();
$_ginfo["query"]["carmaps"]="select car.*,cartype.* from cartype left join (select CarID,CarTypeID from cardata group by CarID,CarTypeID)cartypemap on cartypemap.CarTypeID=cartype.CarTypeID left join car on car.CarID=cartypemap.CarID";
$_ginfo["query"]["allreviews"]="select users.name, users.profilepic, city.Name as cityname, carmaps.Name as carname, carmaps.TypeName, carmaps.CarID, review.* from review left join ".gtable("carmaps")." on carmaps.CarTypeId=review.carTypeId left join city on city.CityID=review.cityID left join users on users.id=review.uid order by review.id desc";
$_ginfo["query"]["myreviewscar"]="select * from ".gtable("allreviews")." where carId={carid} ";
$_ginfo["query"]["myreviewsuser"]="select * from ".gtable("allreviews")." where uid={userid} ";


$_ginfo["page"]=curfilename();


?>