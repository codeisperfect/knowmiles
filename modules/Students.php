<?php
class Students{
	function bookslotfinal($data){
		$need=array('tid','daytime',"slot" );
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			Sqle::updateVal("timeslot",array("sid"=>User::loginId(),"conf"=>"t"),array("tid"=>$data["tid"],"daytime"=>$data["daytime"],"slot"=>$data["slot"],"sid"=>0 ));
			$time=Fun::timetostr($data["daytime"]+3600*$data["slot"] );
			Fun::notf( $data["tid"],"php/notf/n1.txt" , array("Student name"=>User::name(User::loginId()),"time"=>$time ) );
			Fun::notf( User::loginId(),"php/notf/n2.txt" , array("Teacher Name"=>User::name($data["tid"]),"time"=>$time ) );
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function feedbackform_student($data){
		$need=array('tid','daytime',"slot","rate","feedback" );
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$constrain= Fun::getflds(array("tid","slot","daytime"),$data);
			$constrain["sid"]=User::loginId();
			$odata=Sqle::updateVal("timeslot", Fun::getflds(array("rate","feedback"),$data)   , $constrain  );
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
}