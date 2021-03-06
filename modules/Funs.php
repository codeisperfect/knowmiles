<?php
abstract class Funs{
	public static function setcity(){
		if(ispost("city")){
			sets("city",post("city"));
		}
	}

	public static function carpic($provider,$cabType){
		$cabType=strtolower($cabType);
		if(($cabType == 'mini') || ($cabType == 'nano') || ($cabType == 'uber go') || ($cabType=='hatchback') ) {
			$cabTypeImg = 'images/car.png';
			$cabFilter = 'hatchback';
		} elseif (($cabType == 'radio taxi')  || ($cabType == 'uber x') || ($cabType == 'sedan') || ($cabType == 'uber dynamic') || ($cabType=='economy sedan') || ($cabType == 'ac sedan') || ($cabType == 'non ac sedan' ) || $cabType == 'radio texi' || $cabType == 'indigo' ) {
			$cabTypeImg = 'images/car2.png';
			$cabFilter = 'sedan';		  
		} elseif (($cabType == 'prime') || ($cabType == 'uber black')) {
			$cabTypeImg = 'images/suv2.png';
			$cabFilter = 'executive';		  
		} else {
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
		$outp=array("ec"=>-1,"msg"=>"Direct Booking code not created yet for this cab");
		$myf["phone"]="0".$myf["phone"];
		if($cinfo!=null){
			if($cinfo["Name"]=="Fastrackcabs"){
				$bdate=date("M d Y",$btime);
				$bdtime=date("h:i a",$btime);
				$cmd='cd crawler/booking/fastrackcabs;python main.py "'.$myf["name"].'" "'.$myf["phone"].'" "'.$myf["email"].'" "'.$bdate.'" "'.$bdtime.'" "'.$start_add.'" "'.$end_add.'" ';
				$outp["msg"]="Remote output:\n".Fun::remoteelc($cmd);
				$outp["ec"]=1;
			}
			else if($cinfo["Name"]=="Aircab"){
				$bdate=date("d/m/Y",$btime);
				$btime=$btime-($btime%(1800))+($btime%1800==0?0:1800);
				$bdtime=date("H:i",$btime ) ;
				$inputs=array($myf["name"], $myf["phone"], $myf["email"], $bdate, $bdtime, $start_add, $end_add);
				$cmd='cd crawler/booking/aircab;python main.py ';//"'.$myf["name"].'" "'.$myf["phone"].'" "'.$myf["email"].'" "'.$bdate.'" "'.$bdtime.'" "'.$start_add.'" "'.$end_add.'" ';
				foreach($inputs as $i=>$val){
					$cmd.=' "'.$val.'" ';
				}
				$outp["msg"]=" Remote output:\n".Fun::remoteelc($cmd);
				$outp["ec"]=1;
			}
			else if($cinfo["Name"]=="BlueSky Cabs"){
				$bdate=date("d/m/Y",$btime);
				$bdtime=date("H:i",$btime ) ;
				$inputs=array($myf["name"], $myf["phone"], $myf["email"], $bdate, $bdtime, $start_add, $end_add);
				$cmd='cd crawler/booking/bluesky;python main.py ';//"'.$myf["name"].'" "'.$myf["phone"].'" "'.$myf["email"].'" "'.$bdate.'" "'.$bdtime.'" "'.$start_add.'" "'.$end_add.'" ';
				foreach($inputs as $i=>$val){
					$cmd.=' "'.$val.'" ';
				}
				$outp["msg"]=" Remote output:\n".Fun::remoteelc($cmd);
				$outp["ec"]=1;
			}
			else if($cinfo["Name"]=="Hellocabs"){
				$bdate=date("d/m/Y",$btime);
				$btime=$btime-$btime%(15*60);
				$bdtime=date("H:i",$btime ) ;
				$inputs=array($myf["name"], $myf["phone"], $myf["email"], $bdate, $bdtime, $start_add, $end_add);
				$cmd='cd crawler/booking/hellocabs;python main.py ';//"'.$myf["name"].'" "'.$myf["phone"].'" "'.$myf["email"].'" "'.$bdate.'" "'.$bdtime.'" "'.$start_add.'" "'.$end_add.'" ';
				foreach($inputs as $i=>$val){
					$cmd.=' "'.$val.'" ';
				}
				$outp["msg"]=" Remote output:\n".Fun::remoteelc($cmd);
				$outp["ec"]=1;
			}
		}
		return $outp;
	}
	public static function loginaction(){
		$login=array("loginec"=>1, "signupec"=>1);
		if(ispost("loginform") || ispost("signup") ){
			$reqtype=ispost("loginform") ? "login" : "signup" ;
			$loginreq=handle_request( Fun::setifunset( $_POST, "action", $reqtype) );
			if( $loginreq["ec"] > 0 && User::isloginas("c") ) {
				Fun::redirect(HOST."company.php");
			}
			$login[$reqtype."ec"]=$loginreq["ec"];
		}
		return $login;
	}

	public static function getCarInfo($cid) {
		$query = "select users.name, carratings.avgrating, carratings.numpeople, company.* from company left join users on users.id = company.cid left join ".gtable("carratings")." on carratings.cid=company.cid  where company.cid = {cid} limit 1";
		return getr(Sqle::getA($query, array( "cid" => $cid, "uid" => User::loginId() )));
	}

	public static function headerinfo($myf){
		$temp=explode(" ",$myf["name"]." ", 2);
		$myf["fname"]=$temp[0];
		$myf["lname"]=$temp[1];
		return $myf;
	}

	public static function profiletabs() {
		return getval( User::loginType(), g("profiletabs") );
	}

	public static function mycartypes($carid) {
		return Fun::dbarrtooption( Sqle::getA("select * from ".gtable("carmaps")." where CarId={carid} or ".tf($carid == -1)." ", array("carid" => $carid)), "CarTypeID", "TypeName");
	}

	public static function updatedata() {
		$data=(array)json_decode(file_get_contents("crawler/cars/crawldata.json"));
		$data = $data["data"];
		$data = array_slice($data, 1);
		foreach($data as $i => $row) {
			$insert_info["CarID"] = Sqle::insertValUniq( "car", array("Name" => $row[0]), "CarID" );
			$insert_info["CityID"] = Sqle::insertValUniq( "city", array("Name" => $row[1]), "CityID" );
			$insert_info["CarTypeID"] = Sqle::insertValUniq( "cartype", array("TypeName" => $row[2]), "CarTypeID" );
			s("msvar", add($row, 0));
			$pushrow = map(array('nighttime_start', 'night_base_fare', 'night_base_km', 'night_fare_per_km', 'night_waiting_charge', 'day_base_fare', 'day_base_km', 'day_fare_per_km', 'day_waiting_charge', 'nighttime_end', 'min_bill', 'cancel_charge', 'extra_charge', 'extra_charge_after', 'night_extra_charge', 'night_extra_charge_after'), f('getval($ind+3, $msvar)'), array("isindexed" => true));
			echo "<br>";
			msprint($pushrow);
			echo "<br>";
			msprint($insert_info);
			echo "<br>";
			echo Sqle::insertValUniq("cardata", $pushrow, null, $insert_info, true);
			echo "<br>";
		}
	}
}

?>