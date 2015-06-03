<?php
class Display{

	function f($data){
		$need=array('otp');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			if(isset($_SESSION["signupdata"]) && $_SESSION["signupdata"]["otp"]==$data["otp"]){
				$info=$_SESSION["signupdata"];
				$temp=User::signUp(array('type'=>'t','email'=>$info['email'],'password'=>$info['password'],'name'=>$info["name"],"phone"=>$info["phone"] ));
				if($temp>0){
					$datatoinsert=Fun::getflds(array('experience','addinfo','iit','iitentryyear','degree'),$info);
					$datatoinsert["tid"]=$temp['id'];
					$datatoinsert["isselected"]=($info["sec"]=="1"?'t':'f');
					$odata=Sqle::insertVal("teachers",$datatoinsert);
					$_SESSION['login']=$temp;
				}
				else
					$ec=-18;
			}
			else
				$ec=-17;
		}
		return array('ec'=>$ec,'data'=>$odata);
	}

}
?>
