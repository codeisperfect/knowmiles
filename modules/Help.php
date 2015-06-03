<?php
class Help  extends Sql{
	public static function addnotf($data){
		return Sqle::insertVal("notf", $data );
	}
	public static function mynotf($limit=-1){
		$uid=User::loginId();
		return Sql::getArray("select * from notf where uid=? order by time desc ".($limit==-1?'':"limit ".$limit) , 'i' , array(&$uid));
	}
	public static function num_unreadmsg(){
		$uid=User::loginId();
		$temp=Sql::getArray("select count(*) as num from notf where uid=? AND isr='0' ", 'i' , array(&$uid));
		return $temp[0]['num'];
	}
	public static function readnotf($nid){
		return Sqle::updateval('notf',array('isr'=>'1'),array('id'=>$nid,'uid'=>User::loginId()));
	}

	////Starting From Here.
	public static function myreviewlist($uid){
		global $_ginfo;
		$q6="select city.Name,cartypenamemap.Name as carname, cartypenamemap.TypeName,review.* from review left join (".$_ginfo["sql"]["cartypenamemap"].")cartypenamemap on cartypenamemap.CarTypeId=review.carId left join city on city.CityID=review.cityID where uid=? order by time desc";
		return Sql::getArray($q6,'i',array(&$uid));
	}
}
?>
