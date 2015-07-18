<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();

$distance=(0+get("dist"));//in KM.
$timetaken=intval(0+get("duration_min"));//in Min
$cityid=0+gets("city");
$myf=User::myprofile();

$day_charge="case when day_base_km>$distance then day_base_fare else day_base_fare+($distance-day_base_km)*day_fare_per_km end+extra_charge*$timetaken ";

$night_charge="case when night_base_km>$distance then night_base_fare else night_base_fare+($distance-night_base_km)*night_fare_per_km end+extra_charge*$timetaken ";

$booktime=strtotime(get("time"));
$booktime=($booktime==0?time():$booktime);
$hournow=date('H',$booktime);

$is_day= "not(((".$hournow."-nighttime_start+24)%24 between 0 AND (nighttime_end-nighttime_start+24)%24 ))";

$base_charge="(case when not($is_day) then night_base_fare else day_base_fare end)";
$base_km="(case when not($is_day) then night_base_km else day_base_km end)";
$perkm_charge="(case when not($is_day) then night_fare_per_km else day_fare_per_km end)";

$extra_km="(case when $base_km > $distance then 0 else $distance-$base_km end )";
$extra_km_charge=" $extra_km * $perkm_charge";

$extra_min="$timetaken";
$extra_time_charge="((case when extra_charge is null then 0 else extra_charge end )*$timetaken)";

//$charge="(case when ".$is_day." then ($day_charge) else ($night_charge) end)";
$charge= "($base_charge + $extra_km_charge + $extra_time_charge )" ;

$query="select * from (select cardata.day_waiting_charge, company.cid, (company.offerpic is not null) as isoffer, carratings.avgrating, cardata.CarID, cardata.CityID, cardata.CarTypeID, car.Name, cartype.TypeName, $charge as charge, $base_charge as base_charge, $base_km as base_km, $is_day as isday, $perkm_charge as perkm_charge, extra_charge as extramin_charge, $extra_min as extra_min, extra_charge*$timetaken as extra_time_charge, $extra_km_charge as extra_km_charge, $extra_km as extra_km from cardata left join car on cardata.CarID=car.CarID left join cartype on cartype.CarTypeID=cardata.CarTypeID left join company on (company.carid = cardata.CarID AND company.city=cardata.CityID ) left join ".gtable("carratings")." on carratings.cid=company.cid where CityID=$cityid  ) carresult order by charge asc ";


$carresult=Sqle::getA($query, array("uid" => User::loginId() ));


$needtofloor=array("base_charge","base_km","extra_km_charge","extra_km","extra_time_charge","extra_min","extramin_charge");
foreach($carresult as $i=>$row){
  $imgf=Funs::carpic($row["Name"],$row["TypeName"]);
  $carresult[$i]["image"]=$imgf[0];
  $carresult[$i]["filter"]=$imgf[1];
  $carresult[$i]["rating"]=number_format( $row["avgrating"],1 );//mt_rand(1,10);
  //$carresult[$i]["isoffer"]=(rand(1,100)<=60);
  $carresult[$i]["charge"] = intval($row["charge"]);
  
  foreach($needtofloor as $j=>$val){
    $carresult[$i][$val]=number_format($row[$val],1);
  }
  $carresult[$i]["farebreak"]=Funs::farebreak($carresult[$i]);


  $hidinps=array();
  $hinps=array("lat1"=>"loc1lat","lat2"=>"loc2lat","lon1"=>"loc1lon","lon2"=>"loc2lon","start_add"=>"fulloc1","end_add"=>"fulloc2");
  foreach($hinps as $key=>$val){
    $hidinps[$key]=get($val);
  }
  $hidinps["time"]=$booktime;
  $hidinps["fare"]=$row["charge"];
  $hidinps["bookcab"]="";
  foreach(array("CarID","CarTypeID","CityID") as $key=>$val){
    $hidinps[$val]=$row[$val];
  }
  $carresult[$i]["hidinps"]=$hidinps;



}


$pageinfo["cityolist"]=$_ginfo["allcity"];
$pageinfo["carresult"]=$carresult;
$pageinfo["carfilters"]=array("image"=>"images/auto.png","images/car.png", "images/car2.png", "images/suv.png","images/suv2.png");
$pageinfo["myf"]=$myf;
$pageinfo["distance"]=$distance;
$pageinfo["timetaken"]=$timetaken;


if(get("format") != "json") {
load_view("book.php",$pageinfo);
load_view("template/footer.php");
load_view("template/bottom.php", Fun::mergeifunset($pageinfo, array("dispbody" => false)));

?>
  <script>
      $(function () { $('.tooltip-show').tooltip('show');});
      $(function () { $('.tooltip-hide').tooltip('hide');});
      $(function () { $('.tooltip-destroy').tooltip('destroy');});
      $(function () { $('.tooltip-toggle').tooltip('toggle');});
      $(function () { $(".tooltip-options a").tooltip({html : true });
      });
   </script>

</body>
</html>
<?php
} else {

  print_r(json_encode($pageinfo));
}

closedb();
?>