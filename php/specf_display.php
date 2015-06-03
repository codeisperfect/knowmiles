<?php
	function disp_sprofilename($inp){
		return "<a href='".HOST."sprofile.php?sid=".$inp["uid"]."' >".$inp["name"]."</a>";
	}
	function disp_rating($rating=5){
		opent("span");
		for($i=1;$i<=$rating;$i++){
?>
		<i class="fa fa-star"></i>
<?php
		}
		closet("span");
	}


?>