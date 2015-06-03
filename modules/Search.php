<?php
abstract class Search{
	public static function sortl_timeslot($tl){
		$timeslots=Fun::myexplode("-",$tl);
		foreach($timeslots as $key=>$val){
			$timeslots[$key]=(0+$val)-1;
		}
		$replace_arr=array();
		$replace_arr["timeslots"]=Fun::makeDummyTableQuery($timeslots,"timeslots");
		$query="select tid from timeslot where slot in ( {timeslots} )  and  (daytime+slot*3600) > ? group by tid";
		$query=Fun::rquery($query,$replace_arr);
		return $query;
	}
	public static function constrain_or($num_list,$arr){
		$outp=array();
		$num_list_arr=Fun::myexplode("-",$num_list);
		foreach($num_list_arr as $i=>$val){
			$outp[]="(".$arr[(0+$val)-1].")";
		}
		if(count($outp)==0)
			return "false";
		else
			return implode(" OR ",$outp);
	}

	public static function sortl_subjects($inp){
		$arr_replace=array();
		$arr_replace["sortl_timeslot"]=Search::sortl_timeslot($inp["timeslot"]);
		$arr_replace["timer_constrain"]=Search::constrain_or($inp["timetaken"],Fun::get_key_values(timetaken()));
		$arr_replace["price_constrain"]=Search::constrain_or($inp["priceperhour"],Fun::get_key_values(priceperhour()));
		$query="select * from subjects where class=? and subject=? and topic=? and tid in ({sortl_timeslot}) AND ({price_constrain}) AND  ({timer_constrain}) ";
		$query=Fun::rquery($query,$arr_replace);
		return $query;
	}
	public static function search_res($inp){
		if(Fun::isAllSet(array("timetaken","priceperhour","lang","timeslot","search","sort","course","subject","topic"),$inp)){
			$arr_replace=array();
			Search::sortl_subjects($inp);
			$arr_replace["sortl_teachers"]="(".(Search::sortl_subjects($inp)).")sortl_teachers ";
			$query="select users.name,users.profilepic,sortl_teachers.*,teachers.* from {sortl_teachers} left join users on users.id=sortl_teachers.tid left join teachers on teachers.tid=sortl_teachers.tid  where teachers.isselected='t' order by users.create_time desc";
			$query=Fun::rquery($query,$arr_replace);
			$timenow=time();
			return Sql::getArray($query,"sssi",array(&$inp["course"],&$inp["subject"],&$inp["topic"],&$timenow));
		}
		else{
			return false;
		}
	}
	public static function sortl_srch($inp){
		$arr_replace=array();
		$arr_replace["sortl_timeslot"]=Search::sortl_timeslot($inp["timeslot"]);
		$arr_replace["timer_constrain"]=Search::constrain_or($inp["timetaken"],Fun::get_key_values(timetaken()));
		$arr_replace["price_constrain"]=Search::constrain_or($inp["priceperhour"],Fun::get_key_values(priceperhour()));
		$query="select *,avg(price) as aprice,avg(timer) as atimer from (select tid,concat(users.name,'-',class,':',subject,':',topic) as searchp,timer,price from subjects left join users on users.id=subjects.tid )subjects1 where searchp like concat('%',?,'%')  AND tid in ({sortl_timeslot}) AND ({price_constrain}) AND  ({timer_constrain}) group by tid ";
		$query=Fun::rquery($query,$arr_replace);
		return $query;
	}
	public static function search_res1($inp){
		if(Fun::isAllSet(array("timetaken","priceperhour","lang","timeslot","search","sort"),$inp)){
			$arr_replace=array();
			Search::sortl_subjects($inp);
			$arr_replace["sortl_teachers"]="(".(Search::sortl_srch($inp)).")sortl_teachers ";
			$query="select users.name,users.profilepic,sortl_teachers.*,teachers.* from {sortl_teachers} left join users on users.id=sortl_teachers.tid left join teachers on teachers.tid=sortl_teachers.tid  where teachers.isselected='t' order by users.create_time desc";
			$query=Fun::rquery($query,$arr_replace);
//			echo $query;
			$timenow=time();
			return Sql::getArray($query,"si",array(&$inp["search"],&$timenow));
		}
		else{
			return false;
		}
	}
}

?>