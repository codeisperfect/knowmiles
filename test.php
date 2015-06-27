<?php
include "includes/app.php";


Disp::disp_table(Sql::getArray(gtable("carmaps", false)));


if(0){
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