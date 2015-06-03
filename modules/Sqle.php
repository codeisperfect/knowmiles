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
}
?>
