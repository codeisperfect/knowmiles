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
}

?>