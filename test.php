<?php
include "includes/app.php";


//Funs::updatedata();


echo Sqle::insertValUniq("cardata", array('nighttime_start'=>0, 'night_base_fare'=>'49', 'night_base_km'=>'4', 'night_fare_per_km'=>'12', 'night_waiting_charge'=>0, 'day_base_fare'=>'49', 'day_base_km'=>'4', 'day_fare_per_km'=>'12', 'day_waiting_charge'=>0, 'nighttime_end'=>6, 'min_bill'=>0, 'cancel_charge'=>0, 'extra_charge'=>'1.25', 'extra_charge_after'=>0, 'night_extra_charge'=>'1.25', 'night_extra_charge_after'=>0), null, array('CarID'=>2, 'CityID'=>25, 'CarTypeID'=>4), true);




if(0){

	echo gtable("allreviews");

	Disp::disp_table(Sqle::getA(gtable("allreviews", false), array("uid" => 3)));

	Disp::disp_table(Sqle::getA(gtable("allreviews", false), array("carid" => 8)));
	
	function f($b, $a){
		echo $a($b);
	}

	$mohit=11;

	f("mohit", function($saini) use($mohit) {
		return $mohit.$saini;
	});

}

closedb();
?>