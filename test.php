<?php
include "includes/app.php";



echo gtable("allreviews");

Disp::disp_table(Sqle::getA(gtable("allreviews", false), array("uid" => 3)));


if(0){
	Disp::disp_table(Sqle::getA(gtable("allreviews", false), array("carid" => 8)));
	
	function f($b, $a){
		echo $a($b);
	}

	$mohit=11;

	f("mohit", function($saini) use($mohit) {
		return $mohit.$saini;
	});

}

closedb();
?>