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

	function signup($data){
		global $_ginfo;
		$outp=array("ec"=>1,"data"=>0);
		$temp=User::signUp(array("name"=>$data["fName"]." ".$data["lName"],"email"=>$data["emailId"],"password"=>$data["passOne"],"type"=>$data["type"], "phone"=>$data["telephone"]));
		if($temp>0) {
			$outp["data"]=$temp;
			if($data["type"] == 'c'){
				Sqle::insertVal( "company", array("cid" => $temp["id"], "dispname" => "", "bgpic" => "wp-content/themes/woodshed/assets/images/journal-bg-1.jpg") );
				$outp["data"]["ref"] = "company.php";
			}
		}
		else
			$outp["ec"]=$temp;
		return $outp;
	}
	function login($data){
		global $_ginfo;
		$outp=array("ec"=>1,"data"=>0);
		$temp=User::signIn($data["email"],$data["password"]);
		if($temp>0)
			$outp["data"]=$temp;
		else
			$outp["ec"]=$temp;
		return $outp;
	}


}
?>
