<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();

$distance=(0+get("dist"));//in KM.
$timetaken=(0+get("duration_min"));//in Min
$cityid=0+gets("city");
$myf=User::myprofile();


$day_charge="case when day_base_km>$distance then day_base_fare else day_base_fare+($distance-day_base_km)*day_fare_per_km end+extra_charge*$timetaken ";
$night_charge="case when night_base_km>$distance then night_base_fare else night_base_fare+($distance-night_base_km)*night_fare_per_km end+extra_charge*$timetaken ";


$booktime=strtotime(get("time"));
$hournow=date('H',$booktime==0?time():$booktime);
echo $hournow;

$is_day= "not(((".$hournow."-nighttime_start+24)%24 between 0 AND (nighttime_end-nighttime_start+24)%24 ))";

$base_charge="(case when not($is_day) then night_base_fare else day_base_fare end)";
$base_km="(case when not($is_day) then night_base_km else day_base_km end)";
$perkm_charge="(case when not($is_day) then night_fare_per_km else day_fare_per_km end)";

$extra_km="(case when $base_km > $distance then 0 else $distance-$base_km end )";
$extra_km_charge=" $extra_km * $perkm_charge";

$extra_min="$timetaken";
$extra_time_charge="extra_charge*$timetaken";

$charge="(case when ".$is_day." then ($day_charge) else ($night_charge) end)";

$query="select * from (select cardata.day_waiting_charge, cardata.CarID, cardata.CityID, cardata.CarTypeID, car.Name, cartype.TypeName, $charge as charge, $base_charge as base_charge, $base_km as base_km, $is_day as isday, $perkm_charge as perkm_charge, extra_charge as extramin_charge, $extra_min as extra_min, extra_charge*$timetaken as extra_time_charge, $extra_km_charge as extra_km_charge, $extra_km as extra_km from cardata left join car on cardata.CarID=car.CarID left join cartype on cartype.CarTypeID=cardata.CarTypeID where CityID=$cityid ) carresult order by charge asc ";//It is not SQL injection ( why ? ask mohit :p ) , so chill  :P 
//echo $query;

$carresult=Sql::getArray($query);
$needtofloor=array("charge","base_charge","base_km","extra_km_charge","extra_km","extra_time_charge","extra_min","extramin_charge");
foreach($carresult as $i=>$row){
  $imgf=Funs::carpic($row["Name"],$row["TypeName"]);
  $carresult[$i]["image"]=$imgf[0];
  $carresult[$i]["filter"]=$imgf[1];
  $carresult[$i]["rating"]=mt_rand(1,10);
  $carresult[$i]["isoffer"]=(rand(1,100)<=60);
  
  foreach($needtofloor as $j=>$val){
    $carresult[$i][$val]=number_format($row[$val],1);
  }
  $carresult[$i]["farebreak"]=Funs::farebreak($carresult[$i]);


  $hidinps=array();
  $hinps=array("lat1"=>"loc1lat","lat2"=>"loc2lat","lon1"=>"loc1lon","lon2"=>"loc2lon","start_add"=>"fulloc1","end_add"=>"fulloc2","time"=>"time");
  foreach($hinps as $key=>$val){
    $hidinps[$key]=get($val);
  }
  $hidinps["fare"]=$row["charge"];
  $hidinps["bookcab"]="";
  foreach(array("CarID","CarTypeID","CityID") as $key=>$val){
    $hidinps[$val]=$row[$val];
  }
  $carresult[$i]["hidinps"]=$hidinps;



}


$pageinfo=array();
$pageinfo["cityolist"]=$_ginfo["allcity"];
$pageinfo["carresult"]=$carresult;
$pageinfo["carfilters"]=array("image"=>"images/auto.png","images/car.png", "images/car2.png", "images/suv.png","images/suv2.png");
$pageinfo["myf"]=$myf;
$pageinfo["distance"]=$distance;
$pageinfo["timetaken"]=$timetaken;

load_view("template/book_top.php",$pageinfo);
load_view("book.php",$pageinfo);
load_view("template/footer.php");





if(false){
?>


<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
  if(false){
    $('a[href^="#"]').click(function(){  
        var the_id = $(this).attr("href");  
        $('html, body').animate({  
            scrollTop:$(the_id).offset().top  
        }, 'slow');  
        return false;  
    });
  }

    var dateToday=new Date();
    $(".form_datetime1").datetimepicker({
      format: 'yyyy-mm-dd hh:ii', 
      forceParse: true,
      minDate:dateToday,
     onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
          instance = $(this).data("datepicker"),
           date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
       dates.not(this).datepicker("option", option, date);
    }
  });
    
  </script>
  <script>
      $(function () { $('.tooltip-show').tooltip('show');});
      $(function () { $('.tooltip-hide').tooltip('hide');});
      $(function () { $('.tooltip-destroy').tooltip('destroy');});
      $(function () { $('.tooltip-toggle').tooltip('toggle');});
      $(function () { $(".tooltip-options a").tooltip({html : true });
      });
   </script>


<?php
  addall_js(array("js/mohit.js","js/mohitlib.js","js/lib.js","js/main.js"));
}
else{
  load_view("template/bottom.php");
?>
  <script>
      $(function () { $('.tooltip-show').tooltip('show');});
      $(function () { $('.tooltip-hide').tooltip('hide');});
      $(function () { $('.tooltip-destroy').tooltip('destroy');});
      $(function () { $('.tooltip-toggle').tooltip('toggle');});
      $(function () { $(".tooltip-options a").tooltip({html : true });
      });
   </script>

<?php  
}
?>


</body>
</html>
<?php

closedb();
?>