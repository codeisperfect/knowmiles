<?php
class Actions{


	function updateprofile($data){
		$need=array('fname','lname','email','phone','address');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$update_data=Fun::getflds(array("email","phone","address"),$data);
			$update_data["name"]=$data["fname"]." ".$data["lname"];
			$odata=Sqle::updateVal("users",$update_data,array("id"=>User::loginId()));
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function changecity($data){
		$need=array('city');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			sets("city",$data["city"]);
		}
		return array('ec'=>$ec,'data'=>$odata);
	}


}
?>
