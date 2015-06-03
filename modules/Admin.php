<?php
class Admin{
	function acceptreq($data){
		$need=array('tid');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data)){
			$ec=-9;
		}
		else{
			$odata=Sqle::updateVal("teachers",array("isselected"=>"t"),array("tid"=>$data["tid"]));
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
}
?>
