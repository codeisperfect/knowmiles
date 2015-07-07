<?php
include "includes/app.php";



function dt($tn){
	global $DB;
	echo Sql::query("drop table ".$tn);
}


function drop_table(){
	$tl=array("company", "review", "users");
//	$tl=array("car","cartype","cardata","city");
	$tl=array("car","cartype","cardata","city", "users", "booking", "review", "company" );
	foreach($tl as $i=>$val){
		dt($val);
	}
}

function drop_all(){
	$allt=Sql::getArray("show tables");
	foreach($allt as $i=>$val){
		dt($val["Tables_in_mohit"]);
	}
}

function make_table(){
	echo Sql::query("CREATE TABLE users (id int NOT NULL AUTO_INCREMENT,username varchar(100), password varchar(100) , email varchar(100) ,  name varchar(100) , address varchar(500) , phone varchar(13) , type varchar(3) , create_time int,update_time int , last_login int,last_ip varchar(20),conf varchar(1),econf varchar(1), PRIMARY KEY ( id) ) ");
	echo Sql::query("ALTER TABLE users add profilepic varchar(100) NULL ");



	echo Sql::query("CREATE TABLE booking (id int NOT NULL AUTO_INCREMENT,start_add varchar(300), end_add varchar(300), lat1 float, lon1 float, lat2 float, lon2 float, time int, CarID int, CityID int, CarTypeID int, iscancelled varchar(1), PRIMARY KEY ( id) ) ");
	echo Sql::query("ALTER TABLE booking add fare int NULL ");
	echo Sql::query("ALTER TABLE booking add UID int NULL ");
	echo Sql::query("ALTER TABLE booking add bookingtime int NULL ");


	echo Sql::query("CREATE TABLE cabdetails (id int NOT NULL AUTO_INCREMENT, email varchar(100), password varchar(100), time int, CarID int, uid int, PRIMARY KEY ( id), UNIQUE(CarID,uid) ) ");



	echo Sql::query("create table cartype ( CarTypeID int not null UNIQUE, TypeName varchar(100) ) ");
	echo Sql::query("create table city (  CityID int not null UNIQUE, Name varchar(1000) ) ");
	echo Sql::query("create table car (  CarID int  not null UNIQUE, Name varchar(1000) ) ");


	echo Sql::query("create table cardata ( CarID int, CityID int, CarTypeID int, nighttime_start int,  night_base_fare int, night_base_km int, night_fare_per_km int, night_waiting_charge int, day_base_fare int, day_base_km int, day_fare_per_km int, day_waiting_charge int, nighttime_end int, min_bill int, cancel_charge int   ) ");
	echo Sql::query("ALTER TABLE cardata add extra_charge int NULL ");
	echo Sql::query("ALTER TABLE cardata add extra_charge_after int NULL ");
	echo Sql::query("ALTER TABLE cardata add night_extra_charge int NULL ");
	echo Sql::query("ALTER TABLE cardata add night_extra_charge_after int NULL ");

	echo Sql::query("create table company ( cid int not null, carid int, bgpic varchar(500), offerpic varchar(300), city int )");
	echo Sql::query("ALTER TABLE company add dispname varchar(300) NULL ");
	echo Sql::query("ALTER TABLE company add constraint carid_city_uniq unique (carid, city) ");

	echo Sql::query("CREATE TABLE review (id int NOT NULL AUTO_INCREMENT, rating int, content varchar(1000), cid int, carTypeId int, uid int, time int, PRIMARY KEY ( id) ) ");

	echo Sql::query("create table likes ( uid int not null, bid int, type varchar(1), time int, constraint uniq_likes unique (uid, bid, type) )");//type => r:review, c:comment, 

	echo Sql::query("CREATE TABLE comments (id int NOT NULL AUTO_INCREMENT, bid int, content varchar(1000), uid int, type varchar(1), time int, PRIMARY KEY ( id) ) ");//type => r:review


}


drop_table();
make_table();




closedb();
?>
<br>
