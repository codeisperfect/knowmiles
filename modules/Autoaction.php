<?php
class Autoaction{
	function profilereview($data) {
		$cid = Sqle::getR("select cid from company left join ".gtable("carmaps")." on carmaps.CarTypeID = {carTypeId} where city={cityId}", $data, "cid");
		return Fun::setifunset(Fun::getflds( array("content", "rating", "carTypeId"), $data), "cid", $cid);
	}
}
?>