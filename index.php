<?php
$config=array('calallcity'=>true);
include "includes/app.php";
Funs::setcity();
$myf=User::myprofile();

load_view("template/index_top.php");
?>

<body id="top" class="home page page-template page-template-homepage-php no-js">

<div id="map-canvas" style="width:0px height:0px"></div>

<?php
if(true){

load_view("template/header.php",array("cityolist"=>$_ginfo["allcity"],"myf"=>$myf));

?>
<?php
}
else{
}
?>


<?php

load_view("index.php");
load_view("template/footer.php");
load_view("template/bottom.php");
?>


<?php

closedb();
?>
