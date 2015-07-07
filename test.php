<?php
include "includes/app.php";



<<<<<<< HEAD
echo gtable("allreviews");

Disp::disp_table(Sqle::getA(gtable("allreviews", false), array("uid" => 3)));
=======

Disp::disp_table(Sqle::getA(gtable("carratings", false), array("uid" => 3)));
>>>>>>> 9c50ba08c43a7df8e2413cbddd77183c12270b86


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