<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();

$goback=true;
$uinfo=null;
$qargs=Fun::mergeifunset($_GET,array("tab"=>"tabs2-pane3"));
$cururl=HOST."profile.php?tab=".$qargs["tab"];

$uid=User::loginId();

$ec=1;

if(Fun::isSetP("loginform","email","password")){
  $temp=User::signIn($_POST["email"],$_POST["password"]);
  if($temp>0){
    Fun::redirect(HOST);
  }
  else
    $ec=$temp;
}

if(Fun::isSetP("fName","lName","emailId","telephone","passOne","passTwo","accept_conditions_1")){
  $temp=User::signUp(array("name"=>$_POST["fName"]." ".$_POST["lName"],"email"=>$_POST["emailId"],"password"=>$_POST["passOne"],"type"=>"u","phone"=>$_POST["telephone"]));
  if($temp>0){
    Fun::redirect(HOST);
  }
  else
    $ec=$temp;
}

if(!User::islogin()){
  Fun::redirect(HOST."?ec=".$ec);
}


if(Fun::isSetP("bookcab","lat1","lat2","lon1","lon2","fare","start_add","end_add","time","CarID","CarTypeID","CityID")){
  $ins_data=Fun::getflds(array("lat1","lat2","lon1","lon2","fare","start_add","end_add","time","CarID","CarTypeID","CityID"),$_POST);
  if($ins_data["time"]==0)
    $ins_data["time"]=time();
  $ins_data["time"]=strtotime($ins_data["time"]);
  $ins_data=Fun::mergeifunset($ins_data,array("UID"=>User::loginId(),"bookingtime"=>time()));
  Sqle::insertVal("booking",$ins_data);
  Fun::redirect($cururl);
}


if(Fun::isSetP("rating","carId","cityId","content")){
  $ins_data=Fun::getflds(array("rating","carId","cityId","content"),$_POST);
  $ins_data["time"]=time();
  $ins_data["uid"]=User::loginId();
  $ins_data['carId']=0+lastelm(explode("-",$ins_data["carId"]));
  Sqle::insertVal("review",$ins_data);
  Fun::redirect($cururl);
}



$myf=User::myprofile();
$temp=explode(" ",$myf["name"]);
$myf["fname"]=$temp[0];
$myf["lname"]=$temp[1];

$allcar=Sql::getArray("select concat(car.CarID,'-',cartype.CarTypeID) as car_id, concat(car.Name,' : ',cartype.TypeName) as car_name from cartype left join (select CarID,CarTypeID from cardata group by CarID,CarTypeID)cartypemap on cartypemap.CarTypeID=cartype.CarTypeID left join car on car.CarID=cartypemap.CarID");

$myreview=Help::myreviewlist(User::loginId());
foreach( $myreview as $i=>$row){
  $myreview[$i]=Fun::mergeifunset($row,array(
    'timepassed'=>Fun::timepassed_t2(time()-$row["time"]),
    'smilymsg'=>Fun::smilymsg($row["content"])
    ));
}

$mybooking=Sql::getArray("select * from booking where UID=? order by time desc ",'i',array(&$uid));
$pageinfo=array('myreview'=>$myreview,'mybooking'=>$mybooking,'myf'=>$myf,"cityolist"=>$_ginfo["allcity"],"qargs"=>$qargs,'allcar'=>Fun::dbarrtooption($allcar,"car_id","car_name") );



$pageinfo["tabs"]=array(
  "tabs2-pane1"=>"My Miles",
  "tabs2-pane2"=>"Booking",
  "tabs2-pane3"=>"Profile",
  "tabs2-pane4"=>"My Reviews",
  "tabs2-pane5"=>"My Cab Details"
  );

$save_details=Sql::getArray("select car.*,mycabdetails.email,mycabdetails.password,mycabdetails.time,(mycabdetails.CarId is not NULL) issaved  from car left join (select * from cabdetails where uid=?)mycabdetails on mycabdetails.CarID=car.CarID order by car.CarID",'i',array(&$uid));


for($i=0;$i<count($save_details);$i++){
  $save_details[$i]["lastupdated"]=($save_details[$i]["time"]>0?"last updated ".Fun::timepassed(time()-$save_details[$i]["time"]):"");
}


$pageinfo["save_details"]=$save_details;




load_view("profile.php",$pageinfo);

closedb();
?>