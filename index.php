<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();
$myf=User::myprofile();
$pageinfo=array();


$pageinfo["ec"]=get("ec");

load_view("template/index_top.php");
?>

<body id="top" class="home page page-template page-template-homepage-php no-js">

<div id="map-canvas" style="width:0px height:0px"></div>

<?php
if(true){

$pageinfo=Fun::mergeifunset($pageinfo,array("cityolist"=>$_ginfo["allcity"],"myf"=>$myf));

load_view("template/header.php",$pageinfo);

?>
<?php
}
else{
}
?>


<?php

load_view("index.php",$pageinfo);
?>


<?php

closedb();
?>
