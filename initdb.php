<?php
include "includes/app.php";


$data=(array)json_decode(file_get_contents("data/tmp/json_car_data.json"));


function makecitycar(){
	global $data;
	$query="insert into city select * from (".Fun::makeDummyTableColumns($data["db_city"],array("mohit","saini"),'is').")temp ";
	echo Sql::query($query);

	$query="insert into car select * from (".Fun::makeDummyTableColumns($data["db_car"],array("mohit","saini"),'is').")temp ";
	echo Sql::query($query);

	$query="insert into cartype select * from (".Fun::makeDummyTableColumns($data["db_cartypes"],array("mohit","saini"),'is').")temp ";
	echo Sql::query($query);
	//$query="insert into cardata select * from (".Fun::makeDummyTableColumns($data["db_cardata"],array("mohit","saini","m1","m2","m3","m4","m5","m6","m7","m8","m9","m10","m11","m12","m13","m14","m15","m16","m17"),'').")temp ";

	$query="insert into cardata select * from (".Fun::makeDummyTableColumns($data["db_cardata"]).")temp ";


	//echo $query;


	echo Sql::query($query);

	//echo Sql::query("delete from  cardata where day_base_fare=0 OR day_fare_per_km=0");
}



function makesomeaccounts(){
	print_r(User::signUp(array("email"=>"admin@admin.com","password"=>"p","type"=>"a")));
	print_r(User::signUp(array("email"=>"mohit@t.com","password"=>"p","type"=>"u")));
	print_r(User::signUp(array("email"=>"mohit@s.com","password"=>"p","type"=>"u","name"=>"Mohit Saini")));


}

function makecompanyprofile(){
	$cardata = Sqle::getA("select car.CarID, cardata.CityID, car.Name as carname, city.Name as cityname from cardata left join car on car.CarID = cardata.CarID left join city on city.CityID=cardata.CityID group by car.CarID, cardata.CityID");
	foreach($cardata as $i => $val){
		$temp = handle_request(array("emailId"=>makealnum($val["carname"].$val["cityname"])."@mail.com", "passOne"=>"p", "type"=>"c", "fName"=>$val["carname"] , "lName" => $val["cityname"], "telephone" => "", "accept_conditions_1"=>"", "action" => "signup"));
		Sqle::updateVal("company", array("city" => $val["CityID"], "carid" => $val["CarID"]), array("cid" => $temp["data"]["id"]), 1);
	}
}

//print_r(handle_request(array("emailId"=>"tfs1@mail.com", "passOne"=>"p", "type"=>"c", "fName"=>"TexiForSure", "lName" => "", "telephone" => "", "accept_conditions_1"=>"", "action" => "signup")));

//print_r(handle_request(array("emailId"=>"tfs1@mail.com", "passOne"=>"p", "type"=>"c", "fName"=>"TexiForSure", "lName" => "", "telephone" => "", "accept_conditions_1"=>"", "action" => "signup")));

makecitycar();
makesomeaccounts();
makecompanyprofile();

closedb();
?>