<?php
class Autoscroll{
	function loadchat($inp){
		foreach($inp["qresult"] as $i=>$row ){
			$row["isleft"]=($row["aid"]==$row["sid"]);

			$inp["qresult"][$i]=$row;
		}
		return $inp;
	}
	function reviewprintable($inp) {
		$reviews=$inp["qresult"];
		foreach( $reviews as $i=>$row) {
			$reviews[$i]=Fun::mergeifunset($row,array(
				'timepassed'=>Fun::timepassed_t2(time()-$row["time"]),
				'timepassed_t2'=>Fun::timepassed(time()-$row["time"]),
				'smilymsg'=>Fun::smilymsg($row["content"])
				));
		}
		$inp["qresult"]=$reviews;
		return $inp;
	}

}
?>