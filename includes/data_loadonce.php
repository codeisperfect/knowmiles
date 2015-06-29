<?php

if($config["calallcity"]){
	$_ginfo["allcitylist"]=Sql::getArray("select * from city order by Name");
	$_ginfo["allcity"]=Fun::dbarrtooption($_ginfo["allcitylist"],"CityID","Name");
	$_ginfo["allcityiddict"]=Fun::idtovalarr($_ginfo["allcitylist"],"CityID","Name");
	$_ginfo["selectedcity"] = getval(gets("city"), $_ginfo["allcityiddict"]);
}


$_ginfo["query"]=array();

$_ginfo["query"]["carmaps"] = "select car.*,cartype.* from cartype left join (select CarID,CarTypeID from cardata group by CarID,CarTypeID)cartypemap on cartypemap.CarTypeID=cartype.CarTypeID left join car on car.CarID=cartypemap.CarID";

$_ginfo["query"]["reviewlikes"] = "select bid, count(uid) as numlikes, sum(uid={uid}) as amiliked from likes where type='r' group by bid";

$_ginfo["query"]["allreviews"] = "select users.name, users.profilepic, city.Name as cityname, carmaps.Name as carname, carmaps.TypeName, carmaps.CarID, reviewlikes.numlikes, reviewlikes.amiliked, review.* from review left join company on review.cid = company.cid left join ".gtable("carmaps")." on carmaps.CarTypeId=review.carTypeId left join city on city.CityID=company.city left join users on users.id=review.uid left join ".gtable("reviewlikes")." on reviewlikes.bid = review.id order by review.id desc";

$_ginfo["query"]["carratings"] = "select cid, avg(rating) as avgrating, count(rating) as numpeople from ".gtable("allreviews")." where rating is not null group by cid";

$_ginfo["query"]["myreviewscar"] = "select * from ".gtable("allreviews")." where cid={cid} ";

$_ginfo["query"]["myreviewsuser"] = "select * from ".gtable("allreviews")." where uid={userid} ";

$_ginfo["query"]["myreviewreply"] = "select users.name, comments.* from comments left join users on users.id = comments.uid where comments.bid={bid} and comments.type = 'c' order by id asc";




$_ginfo["page"]=curfilename();


?>