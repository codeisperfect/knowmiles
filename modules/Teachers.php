<?php
class Teachers{
	function addsubject($data){
		$need=array('class','subject',"timer","price","topic");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$odata=Sqle::insertVal("subjects",array("timer"=>$data["timer"],"price"=>$data["price"],"topic"=>$data["topic"] , "tid"=>User::loginId(),'class'=>$data["class"],"subject"=>$data["subject"]));
			if($odata==0)
				$ec=-14;
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function addtiming($data){//Require teacher login
		$need=array('date','time');
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$timefilled=($data["date"]+$data["time"]);
			if($timefilled<time())
				$ec=-15;
			else{
				$odata=Sqle::insertVal("timing",array('tid'=>User::loginId(),'timeslot'=>$timefilled,'booked'=>'f'));
				if($odata==0)
					$ec=-14;
			}
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function addtimeslot($data){//bulk
		$need=array('num_timeslot','num_weekdays' );
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$tid=User::loginId();
			$weekdays=Fun::getmulinput($data,"weekdays",$data["num_weekdays"]);
			$timeslots=Fun::getmulinput($data,"timeslot",$data["num_timeslot"]);
			for($i=0;$i<count($weekdays);$i++)
				$weekdays[$i]=Fun::timeofnextxday($weekdays[$i]);
			$query="select * from ( select ".(0+$tid)." as tid,daystarttime,temp3.slot,0 as sid,'f' as conf from (select temp2.idd+temp1.id*7*3600*24 as daystarttime from  (".Fun::makeDummyTableQuery(Fun::oneton(50,0),"id").")temp1, (".Fun::makeDummyTableQuery($weekdays,"idd").")temp2  )temp11,(".Fun::makeDummyTableQuery($timeslots,"slot")." ) temp3 ) temp4 where concat(daystarttime,'_',slot) not in (select concat(daytime,'_',slot) from timeslot where tid=".(0+$tid)." ) ";

//			$query="select temp4.* from ( select ".(0+$tid)." as tid,daystarttime,temp3.slot,0 as sid,'f' as conf from (select temp2.id+temp1.id*7*3600*24 as daystarttime from  (".Fun::makeDummyTableQuery(array(0,1,2,3),"id").")temp1, (".Fun::makeDummyTableQuery($weekdays,"id").")temp2  )temp11,(".Fun::makeDummyTableQuery($timeslots,"slot").")temp3) temp4 left join timeslot on (timeslot.tid,timeslot.daytime,timeslot.slot)=(temp4.tid,temp4.daystarttime,temp4.slot) where timeslot.tid IS NULL";
			if(true || $data["ar"]=="a")
				$query="insert into timeslot (tid,daytime,slot,sid,conf) ".$query;
			else
				$query="delete from timeslot where (tid,daytime,slot) in ( select tid,daystarttime,slot from (".$query.") temp5 ) ";
			$odata=Sql::query($query);
		}
		return array('ec'=>$ec,'data'=>$odata);
	}

	function remtimeslot($data){//bulk
		$need=array('num_timeslot','num_weekdays' );
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data))
			$ec=-9;
		else{
			$tid=User::loginId();
			$weekdays=Fun::getmulinput($data,"weekdays",$data["num_weekdays"]);
			$timeslots=Fun::getmulinput($data,"timeslot",$data["num_timeslot"]);
			for($i=0;$i<count($weekdays);$i++)
				$weekdays[$i]=Fun::timeofnextxday($weekdays[$i]);
			$query="select * from ( select ".(0+$tid)." as tid,daystarttime,temp3.slot,0 as sid,'f' as conf from (select temp2.idd+temp1.id*7*3600*24 as daystarttime from  (".Fun::makeDummyTableQuery(Fun::oneton(50,0),"id").")temp1, (".Fun::makeDummyTableQuery($weekdays,"idd").")temp2  )temp11,(".Fun::makeDummyTableQuery($timeslots,"slot")." ) temp3 ) temp4  ";

//			$query="select temp4.* from ( select ".(0+$tid)." as tid,daystarttime,temp3.slot,0 as sid,'f' as conf from (select temp2.id+temp1.id*7*3600*24 as daystarttime from  (".Fun::makeDummyTableQuery(array(0,1,2,3),"id").")temp1, (".Fun::makeDummyTableQuery($weekdays,"id").")temp2  )temp11,(".Fun::makeDummyTableQuery($timeslots,"slot").")temp3) temp4 left join timeslot on (timeslot.tid,timeslot.daytime,timeslot.slot)=(temp4.tid,temp4.daystarttime,temp4.slot) where timeslot.tid IS NULL";
			if(false && $data["ar"]=="a")
				$query="insert into timeslot (tid,daytime,slot,sid,conf) ".$query;
			else
				$query="delete from timeslot where (tid,daytime,slot) in ( select tid,daystarttime,slot from (".$query.") temp5 ) AND sid=0 ";
//			echo $query;
			$odata=Sql::query($query);
		}
		return array('ec'=>$ec,'data'=>$odata);
	}


	function addremtimeslot($data){
		$need=array('daytime','slot',"ar");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data)){
			$ec=-9;
		}
		else{
			if($data["ar"]=="a"){
				if( $data["daytime"]+3600*($data["slot"]) > time() ){
					$odata=Sqle::insertVal("timeslot",array("tid"=>User::loginId(),"daytime"=>(0+$data["daytime"]),"slot"=>(0+$data["slot"]),"sid"=>0,"conf"=>"f"));
				}
				else
					$ec=-19;
			}
			else if($data["ar"]=="r"){
				$tid=User::loginId();
				$query="delete from timeslot where tid=? AND daytime=? AND slot=? AND sid=0 AND (daytime+3600*slot> ".(time())." )";
				$odata=Sql::query($query,"iii",array(&$tid,&$data["daytime"],&$data["slot"]));
			}
			else if($data["ar"]=="aall"){
				$tid=User::loginId();
				$query="insert into timeslot (tid,daytime,slot,sid,conf) select * from(select ".(0+$tid)." as tid,".(0+$data["daytime"])." as daytime,slot,0 as sid,'f' as conf from(".Fun::makeDummyTableQuery(Fun::oneton(23,0),"slot").")temp  ) temp1 where (daytime+3600*slot> ".(time())." ) AND (daytime,slot) not in (select daytime,slot from timeslot where tid=".(0+$tid)."  ) ";
				$odata=Sql::query($query);
			}
			else if($data["ar"]=="dall"){
				$tid=User::loginId();
				$query="delete from timeslot where tid=? AND daytime=? AND sid=0 AND (daytime+3600*slot> ".(time())." ) ";
				$odata=Sql::query($query, 'ii' ,array(&$tid,&$data["daytime"]) );
			}
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function delete_req($data){
		$need=array('topic','subject',"class");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data)){
			$ec=-9;
		}
		else{
			$tid=User::loginId();
			$odata=Sql::query("delete from subjects where class=? AND subject=? AND topic=? AND tid=?","sssi",array(&$data["class"],&$data["subject"],&$data["topic"],&$tid));
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function put_teachingurl($data){
		$need=array("apptime","sid");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data)){
			$ec=-9;
		}
		else{
			$url=BASE."?teachingurl=".rand(10000000,90000000);
			$odata=Sqle::updateVal("timeslot",array("url"=>$url),array("(daytime+3600*slot)"=> $data["apptime"],"tid"=>User::loginId(),"sid"=>$data["sid"] ) );
			if($odata){
				Fun::notf( $data["sid"],"php/notf/put_link.txt" , array("Teacher Name"=>User::name(User::loginId()),"time"=>Fun::timetostr($data["apptime"]) ) );
				$odata=$url;
			}
			else
				$ec=-20;
		}
		return array('ec'=>$ec,'data'=>$odata);
	}
	function update_marks($data){
		$need=array("daytime","slot","marks");
		$ec=1;
		$odata=0;
		if(!Fun::isAllSet($need,$data)){
			$ec=-9;
		}
		else{
			$odata=Sqle::updateVal("timeslot",array("marks"=>$data["marks"]),array("daytime"=>$data["daytime"],"slot"=>$data["slot"]));
		}
		return array('ec'=>$ec,'data'=>$odata);
	}

}