<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();

$goback=true;
$uinfo=null;
$qargs=Fun::mergeifunset($_GET,array("tab"=>"tabs2-pane3"));
$cururl=HOST."profile.php?tab=".$qargs["tab"];

$uid=User::loginId();

$myf=User::myprofile();

Fun::redirect(HOST, $myf==null);

$bookingmsg="";

if(Fun::isSetP("bookcab","lat1","lat2","lon1","lon2","fare","start_add","end_add","time","CarID","CarTypeID","CityID")){
	$ins_data=Fun::getflds(array("lat1","lat2","lon1","lon2","fare","start_add","end_add","time","CarID","CarTypeID","CityID"),$_POST);
	$ins_data=Fun::mergeifunset($ins_data,array("UID"=>User::loginId(),"bookingtime"=>time()));
	$myf=User::myprofile();
	$remote_booking=Funs::remotebooking($myf,$ins_data["time"], $ins_data["CarID"], $ins_data["start_add"], $ins_data["end_add"]);
	$bookingmsg=$remote_booking["msg"];

	Sqle::insertVal("booking",$ins_data);
	Fun::redirect($cururl);
}


if(User::isloginas("c") ){
	if(isset($_FILES["bgpic"]) && $_FILES["bgpic"]["size"]>0 )
		Fun::uploadpic($_FILES["bgpic"], "bgpic", null, 100, array(), "company", "cid");
	if(isset($_FILES["offerpic"]) && $_FILES["offerpic"]["size"]>0 )
		Fun::uploadpic($_FILES["offerpic"], "offerpic", null, 280, array(), "company", "cid");
}


$myf=User::myprofile();
$temp=explode(" ",$myf["name"]." ");
$myf["fname"]=$temp[0];
$myf["lname"]=$temp[1];

$allcar = Fun::dbarrtooption( Sqle::getA( "select CarTypeID, CarID, concat(Name, ' : ', TypeName) as car_name from ".gtable("carmaps") ), "CarTypeID", "car_name", array("CarID") );

$myreview=array();//reviewprintable(Help::myreviewlist(User::loginId()));

$mybooking=Sql::getArray("select * from booking where UID=? order by time desc ",'i',array(&$uid));
$pageinfo=array('myreview'=>$myreview,'mybooking'=>$mybooking,'myf'=>$myf,"cityolist"=>$_ginfo["allcity"],"qargs"=>$qargs,'allcar'=>$allcar );



$pageinfo["tabs"]=array(
	"tabs2-pane1"=>"My Miles",
	"tabs2-pane2"=>"Booking",
	"tabs2-pane3"=>"Profile",
	"tabs2-pane4"=>"My Reviews",
	"tabs2-pane5"=>"My Cab Details",
	"tabs2-pane6"=>"Manage company",
	);

$save_details=Sql::getArray("select car.*,mycabdetails.email,mycabdetails.password,mycabdetails.time,(mycabdetails.CarId is not NULL) issaved  from car left join (select * from cabdetails where uid=?)mycabdetails on mycabdetails.CarID=car.CarID order by car.CarID",'i',array(&$uid));


for($i=0;$i<count($save_details);$i++){
	$save_details[$i]["lastupdated"]=($save_details[$i]["time"]>0?"last updated ".Fun::timepassed(time()-$save_details[$i]["time"]):"");
}


$pageinfo["profiletabs"]=Funs::profiletabs();
$pageinfo["save_details"]=$save_details;
$pageinfo["bookingmsg"]=$bookingmsg;

$pageinfo["userinfo"] = $myf;

load_view("profile.php",$pageinfo);

closedb();
?>