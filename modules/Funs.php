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
}

?>