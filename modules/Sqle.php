<?php
class Sqle extends Sql{
	public static function selectVal($table,$flds,$cnds=array(),$resultNo=-1){
		$selects=array();
		$params=array();
		$str="";
		$keys=array_keys($cnds);
		for($i=0;$i<count($keys);$i++){
			if(gettype($cnds[$keys[$i]])!='array'){
				$params[]=&$cnds[$keys[$i]];
				$val=$cnds[$keys[$i]];
				$sign='=';
			}
			else{
				$val=$cnds[$keys[$i]][0];
				$params[]=&$cnds[$keys[$i]][0];
				$sign=(count($cnds[$keys[$i]])>1 ? $cnds[$keys[$i]][1]:"=" );
			}
			$selects[]=$keys[$i].$sign." ? ";
			$str.=gettype($val)=='integer'?'i':'s';
		}
		$conds=join(" AND ",$selects);
		$query="select $flds from $table ".( $conds ===""? " ":" WHERE ").$conds." ".($resultNo!=-1 ? " LIMIT $resultNo ":" ");
		$temp=self::getArray($query,$str,$params);
		if($resultNo===1){
			if(count($temp)>0)
				return $temp[0];
			else
				return null;
		}
		else
			return $temp;
	}
	
	public static function insertVal($table,$data){
		$keys=array_keys($data);
		$params=array();
		$vars=array();
		$str="";
		for($i=0;$i<count($keys);$i++){
			$params[]=&$data[$keys[$i]];
			$vars[]='?';
			$str.=(gettype($data[$keys[$i]])=='string'?'s':'i');
		}
		$query="insert into $table (".join(",",$keys).") VALUES  (".join(",",$vars).")";
		// print_r($query);
		// print_r($str);
		// print_r($params);
		return self::query($query,$str,$params);
	}
	public static function updateVal($table,$sets,$cnds=array(),$limit=-1){
		$selects=array();
		$params=array();
		$str="";
		$keys=array_keys($sets);
		$setstr=array();
		for($i=0;$i<count($keys);$i++){
			$setstr[]= $keys[$i]."=?";
			$params[]=&$sets[$keys[$i]];
			$str.=gettype($sets[$keys[$i]])=='integer'?'i':'s';
		}
		$keys=array_keys($cnds);
		for($i=0;$i<count($keys);$i++){
			if(gettype($cnds[$keys[$i]])!='array'){
				$params[]=&$cnds[$keys[$i]];
				$val=$cnds[$keys[$i]];
				$sign='=';
			}
			else{
				$val=$cnds[$keys[$i]][0];
				$params[]=&$cnds[$keys[$i]][0];
				$sign=(count($cnds[$keys[$i]])>1 ? $cnds[$keys[$i]][1]:"=" );
			}
			$selects[]=$keys[$i].$sign." ? ";
			$str.=gettype($val)=='integer'?'i':'s';
		}
		$conds=join(" AND ",$selects);
		$query="update $table set ".join(',',$setstr).( $conds ===""? " ":" WHERE ").$conds." ".($limit!=-1 ? " LIMIT $limit ":" ");
		return self::query($query,$str,$params);
	}
	public static function getRow($query,$param_string="",$param_array=array(),$directnull=false){
		if($directnull)
			return null;
		$qoutp=Sql::getArray($query,$param_string,$param_array);
		if(count($qoutp)>0)
			return $qoutp[0];
		else
			return null;
	}
	public static function loadtables($query,$key,$limit=-1,$min=0,$max=0,$isnewer=true,$sorttext=''){
		$min=0+$min;
		$max=0+$max;
		$limit=0+$limit;
		$max_constrain=(($max>0 && $isnewer)  ? $key.">".$max:"true");
		$min_constrain=(($min>0 && !$isnewer)  ? $key."<".$min:"true");
		$limit_constrain=($limit==-1 ? "":"limit ".$limit);
		$uquery="select * from (select * from (".$query[0].") overflowtable where $max_constrain AND $min_constrain $limit_constrain ) overflowtable_extend $sorttext ";
		$qoutp=Sql::getArray($uquery,$query[1],$query[2]);

		if(count($qoutp)==0){
		}
		else{
			$e1=$qoutp[0][$key];
			$e2=$qoutp[count($qoutp)-1][$key];
			$mino=min($e1,$e2);
			$maxo=max($e1,$e2);
		}
		return array("qoutp"=>$qoutp,"min"=>$min,"max"=>$max);
	}
}
?>
