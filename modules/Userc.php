<?php
class Userc {

	function savecabdetails($data){
		$need=array('CarID', 'email', 'password',"querytype");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else if(!User::isloginas('u')){
			$ec=-2;
		}
		else{
			$update_data=Fun::getflds(array("email","password"),$data);
			$update_data["time"]=time();
			if($data["querytype"]=="insert"){
				$update_data["uid"]=User::loginId();
				$update_data["CarID"]=$data["CarID"];
				$odata=Sqle::insertVal("cabdetails",$update_data);
			}
			else{
				$odata=Sqle::updateVal("cabdetails",$update_data,array("uid"=>User::loginId(),"CarID"=>$data["CarID"] ));
			}
		}
		return array('ec'=>$ec,'data'=>$odata);
	}

}
?>
