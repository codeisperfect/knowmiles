<?php

$view_default=array(
	'template/top.php'=>array(
		"title"=>"Player",
		"css"=>array("bootstrap-3.1.1-dist/css/bootstrap.css","bootstrap-3.1.1-dist/css/bootstrap-theme.css","css/main.css")
		),
	'template/bottom.php'=>array(
		"needpopup"=>true,
		"dispbody"=>true
		),
	"template/mselect.php"=>array(
		"name"=>"",
		"data"=>"all",
		"divstyle"=>"",
		"blocked"=>array(),
		"selectall"=>true,
		"selectallselected"=>true,
		"label"=>""
		),
	"template/select.php"=>array(
		"name"=>"",
		"label"=>"",
		"selectval"=>"",
		"dc"=>"simple",
		"onchange"=>""
		),
	"template/select_bool.php"=>array(
		"label"=>"",
		"name"=>"",
		"options"=>array("Yes","No")
		),
	"template/header.php"=>array(
		"islogin"=>null,//redefined latter in includes/data_loadonce.php
		"ec"=>null
		)
	);



$_ginfo=array();
$_ginfo["attributes"]=array("name","value","style","class","id","type","ph","onclick","dc",'rows',"disabled","align","valign","action","autofocus","style","rel","type","href","value","src","selected");
$_ginfo["attrs_shortcut"]=array("ph"=>"placeholder","dc"=>"data-condition");

$_ginfo['sql']=array(
	"cartypenamemap"=>"select car.*,cartype.* from cartype left join (select CarID,CarTypeID from cardata group by CarID,CarTypeID)cartypemap on cartypemap.CarTypeID=cartype.CarTypeID left join car on car.CarID=cartypemap.CarID"
	);

$_ginfo["error"]=array(
	"-1"=>"Session expired",
	"-2"=>"You are not right person to perform this action.",
	"-3"=>"Incorrect formate of input",
	"-4"=>"Incorrect credentials [Password]",
	"-5"=>"Username doesn't exist",
	"-6"=>"Incorrect credentials [Email ID]",
	"-7"=>"Action handler not defined",
	"-8"=>"Session expired or You are not right person to perform this action.",
	"-9"=>"Not sufficient arguments.",
	"-16"=>"This email id used Already",
	"-17"=>"OTP is incorrect",
	"-18"=>"Some unknown error while creating account.",
	"-19"=>"You cannot choose slot of past.",
	"-20"=>"You Cannot generate link",
	"-21"=>"Your account deactivated",
	"-22"=>"Nobody is login",
	"1"=>"Positive"
);


?>