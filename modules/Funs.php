<?php
abstract class Funs{
	public static function setcity(){
		if(ispost("city")){
			sets("city",post("city"));
		}
	}
	public static function carpic($provider,$cabType){
		$cabType=strtolower($cabType);
      if(($cabType == 'mini') || ($cabType == 'nano') || ($cabType == 'uber go') || ($cabType=='hatchback') )
      {
		  $cabTypeImg = 'images/car.png';
		  $cabFilter = 'hatchback';
	  }
      elseif (($cabType == 'radio taxi')  || ($cabType == 'Uber X') || ($cabType == 'sedan') || ($cabType == 'Uber Dynamic') || ($cabType=='economy sedan')  )
      {
		  $cabTypeImg = 'images/car2.png';
		  $cabFilter = 'sedan';		  
	  }
      elseif (($cabType == 'prime') || ($cabType == 'uber black'))
      {
		  $cabTypeImg = 'images/suv2.png';
		  $cabFilter = 'executive';		  
	  }
      else
      {
		  $cabTypeImg = 'images/suv.png';
		  $cabFilter = 'suv';		  
	  }
	  return array($cabTypeImg,$cabFilter);
	}
	public static function farebreak($row){
		$lines=array();
		$lines[]=rquery("Rs. {base_charge} for {base_km}KM. ",$row);
		if($row["extra_km_charge"]>0){
			$lines[]=rquery("Rs. {extra_km_charge} for {extra_km}KM ({extra_km} x {perkm_charge})",$row);
		}
		if($row["extra_time_charge"]>0){
			$lines[]=rquery("Rs. {extra_time_charge} Extra Time charge ({extra_min}min x {extramin_charge}) ",$row);
		}
		return implode("<br>",$lines);
	}
	public static function remotebooking($myf,$btime,$CarID,$start_add,$end_add){
		$start_add=cleanstr($start_add);
		$end_add=cleanstr($end_add);

		$cinfo=Sqle::getRow("select * from car where CarID=? limit 1",'i',array(&$CarID));
		$outp=array("ec"=>-1,"msg"=>"Some error occured");
		if($cinfo!=null){
			if($cinfo["Name"]=="fastrackcabs"){
				$bdate=date("M d Y",$btime);
				$bdtime=date("h:i a",$btime);
				$cmd='cd crawler/booking/fastrackcabs;python main.py "'.$myf["name"].'" "'.$myf["phone"].'" "'.$myf["email"].'" "'.$bdate.'" "'.$bdtime.'" "'.$start_add.'" "'.$end_add.'" ';
				$outp["msg"]="Remote output:\n".Fun::remoteelc($cmd);
				$outp["ec"]=1;
			}
		}
		return $outp;
	}
}

?>