<?php
include "includes/app.php";


$data=(array)json_decode(file_get_contents("data/tmp/json_car_data.json"));


if(true){
	$query="insert into city select * from (".Fun::makeDummyTableColumns($data["db_city"],array("mohit","saini"),'is').")temp ";
	echo Sql::query($query);

	$query="insert into car select * from (".Fun::makeDummyTableColumns($data["db_car"],array("mohit","saini"),'is').")temp ";
	echo Sql::query($query);

	$query="insert into cartype select * from (".Fun::makeDummyTableColumns($data["db_cartypes"],array("mohit","saini"),'is').")temp ";
	echo Sql::query($query);
}


$query="insert into cardata select * from (".Fun::makeDummyTableColumns($data["db_cardata"],array("mohit","saini","m1","m2","m3","m4","m5","m6","m7","m8","m9","m10","m11","m12","m13","m14"),'').")temp ";
echo Sql::query($query);

//echo Sql::query("delete from  cardata where day_base_fare=0 OR day_fare_per_km=0");





closedb();
?>