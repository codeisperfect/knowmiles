<?php
abstract class Funs{
	public static function setcity(){
		if(ispost("city")){
			sets("city",post("city"));
		}
	}
	public static function carpic($provider,$cabType){
      if(($cabType == 'Mini') || ($cabType == 'Nano') || ($cabType == 'Uber Go'))
      {
		  $cabTypeImg = 'images/car.png';
		  $cabFilter = 'hatchback';
	  }
      elseif (($cabType == 'Radio Taxi')  || ($cabType == 'Uber X') || ($cabType == 'Sedan') || ($cabType == 'Uber Dynamic'))
      {
		  $cabTypeImg = 'images/car2.png';
		  $cabFilter = 'sedan';		  
	  }
      elseif (($cabType == 'Prime') || ($cabType == 'Uber Black'))
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